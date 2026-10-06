<?php
// ============================================================================
// File:    AuthService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Concrete;


use Seymenkonuk\Framework\Database\Connection\ISqlConnection;
use Seymenkonuk\Framework\Exception\ValidationException;
use Seymenkonuk\Framework\Flash\IFlash;
use Seymenkonuk\Framework\Session\ISession;

use App\Domain\Repositories\Abstract\IChannelRepository;
use App\Domain\Repositories\Abstract\IUserRepository;
use App\Domain\Services\Abstract\IAuthService;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\User\CreateDTO;
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
        protected IUserRepository $userRepository,
        protected IChannelRepository $channelRepository,
        protected ChannelToDtoMapper $channelDtoMapper,
        protected ISqlConnection $sqlConnection,
        protected IFlash $flash,
        protected ISession $session,
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
        // Session'ı Kaydet
        $this->session->set("auth", $user->code);
    }

    public function register(CreateDTO $user): void
    {
        // Kullanıcı Adı Mevcut
        if ($this->userRepository->existsByUsername($user->username)) {
            throw new ValidationException(["body" => [
                "username" => "Bu kullanıcı adı zaten kullanılıyor.",
            ]]);
        }
        // Email Mevcut
        if ($this->userRepository->existsByEmail($user->email)) {
            throw new ValidationException(["body" => [
                "email" => "Bu e-posta adresi zaten kullanılıyor.",
            ]]);
        }
        // Username ile bir kanal oluşturulacak
        // Dolayısıyla böyle bir kanal mevcut olmamalı
        $channelName = "@" . $user->username;
        if ($this->channelRepository->existsByName($channelName)) {
            throw new ValidationException(["body" => [
                "username" => "Bu kullanıcı adı kullanılamaz.",
            ]]);
        }
        // Transaction Başlat
        $this->sqlConnection->transaction(function () use ($user, $channelName) {
            // Kullanıcıyı Oluştur
            $this->userRepository->create([
                "name" => $user->name,
                "surname" => $user->surname,
                "username" => $user->username,
                "email" => $user->email,
                "password_hash" => password_hash($user->password, PASSWORD_DEFAULT),
                "country" => $user->country,
            ]);
            // Oluşturulan Kullanıcı Bilgilerini Al
            $user = $this->userRepository->findByUsername($user->username);
            assert($user !== null);
            // İlk Kanalını Oluştur
            $channelId = $this->channelRepository->create([
                "user_id" => $user->id,
                "name" => $channelName,
                "title" => $user->name . " " . $user->surname,
            ]);
            // Aktif kanal
            $this->userRepository->update($user->code, [
                "active_channel_id" => $channelId,
            ]);
        });
    }

    public function logout(): void
    {
        $this->session->remove("auth");
    }
}
