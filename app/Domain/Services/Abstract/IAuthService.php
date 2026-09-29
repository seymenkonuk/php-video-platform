<?php
// ============================================================================
// File:    IAuthService.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Services\Abstract;


use Seymenkonuk\Framework\Auth\IAuthService as IFrameworkAuthService;
use Seymenkonuk\Framework\Exception\ValidationException;

use App\Support\DTOs\AuthDTO;


interface IAuthService extends IFrameworkAuthService
{
    /**
     * Kimliği doğrulanmış kullanıcıya ait kimlik bilgilerini döndürür.
     *
     * @return ?AuthDTO
     */
    public function auth(): ?AuthDTO;

    /**
     * Kullanıcı girişi yapar ve oturum oluşturur.
     *
     * @param string $username kullanıcı adı.
     * @param string $password kullanıcı parolası.
     * 
     * @throws ValidationException kullanıcı adı veya parola hatalıysa.
     *
     * @return void
     */
    public function login(string $username, string $password): void;

    /**
     * Kullanıcı oturumunu sonlandırır.
     * 
     * @return void
     */
    public function logout(): void;
}
