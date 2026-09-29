<?php
// ============================================================================
// File:    AuthService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use Seymenkonuk\Framework\Exception\ValidationException;
use Seymenkonuk\Framework\Flash\IFlash;
use Seymenkonuk\Framework\Session\ISession;

use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\IUserRepository;
use App\Domain\Services\Abstract\IAuthService;

use App\Support\DTOs\AuthDTO;
use App\Support\Mappers\ChannelToDtoMapper;


class AuthService implements IAuthService
{
    // --------------------------------------------------------------------------
    // CACHES
    // --------------------------------------------------------------------------

    private ?AuthDTO $cachedAuth = null;

    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected ISession $session,
        protected IFlash $flash,
        protected IUserRepository $userRepository,
        protected IChannelRepository $channelRepository,
        protected ChannelToDtoMapper $channelDtoMapper,
    ) {}

    // --------------------------------------------------------------------------
    // METHODS
    // --------------------------------------------------------------------------

    public function authenticated(): bool
    {
        return $this->auth() !== null;
    }

    public function auth(): ?AuthDTO
    {
        // Cache'de Varsa Onu Döndür
        if ($this->cachedAuth !== null) {
            return $this->cachedAuth;
        }

        // Auth Bilgisini Al
        /** @var string */
        $userCode = $this->session->get("auth", "");
        if (!$userCode) {
            $this->session->remove("auth");
            return null;
        }

        // Kullanıcı Bilgisini Al
        $user = $this->userRepository->findByCode($userCode);
        if (!$user || !$user->active_channel_id) {
            $this->session->remove("auth");
            return null;
        }

        // Aktif Kanal Bilgisini Al
        $channel = $this->channelRepository->findById($user->active_channel_id);
        if (!$channel) {
            $this->session->remove("auth");
            return null;
        }

        // DTO'ya Dönüştür
        // Bir daha istendiğinde vt'ye gitmemek için cache'le
        $this->cachedAuth = new AuthDTO(
            $user,
            $this->channelDtoMapper->map($channel->code, $channel->title, $channel->avatar_path),
        );

        return $this->cachedAuth;
    }

    public function login(string $username, string $password): void
    {
        $user = $this->userRepository->findByUsername($username);
        // Kullanıcı Bulunamadı veya Parola Hatalı
        if (!$user || !password_verify($password, $user->password_hash)) {
            throw new ValidationException([
                "body" => [
                    "username" => "Kullanıcı adı veya parola hatalı!",
                    "password" => "Kullanıcı adı veya parola hatalı!",
                ]
            ]);
        }
        $this->session->set("auth", $user->code);
    }

    public function logout(): void
    {
        $this->session->remove("auth");
    }
}
