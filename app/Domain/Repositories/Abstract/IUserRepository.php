<?php
// ============================================================================
// File:    IUserRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Abstract;


use App\Domain\Models\User;


interface IUserRepository
{    
    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen kullanıcı koduna ait kullanıcının mevcut olup olmadığını döndürür.
     *
     * @param string $code kontrol edilecek kullanıcı kodu.
     *
     * @return bool kullanıcı mevcutsa true, aksi halde false.
     */
    public function existsByCode(string $code): bool;

    /**
     * Belirtilen kullanıcı adına ait kullanıcının mevcut olup olmadığını döndürür.
     *
     * @param string $username kontrol edilecek kullanıcı adı.
     *
     * @return bool kullanıcı mevcutsa true, aksi halde false.
     */
    public function existsByUsername(string $username): bool;

    /**
     * Belirtilen e-posta adresine ait kullanıcının mevcut olup olmadığını döndürür.
     *
     * @param string $email kontrol edilecek e-posta adresi.
     *
     * @return bool kullanıcı mevcutsa true, aksi halde false.
     */
    public function existsByEmail(string $email): bool;

    /**
     * Belirtilen kullanıcı koduna ait kullanıcıyı döndürür.
     *
     * Kullanıcı bulunamazsa null döndürülür.
     *
     * @param string $code aranacak kullanıcı kodu.
     *
     * @return ?User bulunan kullanıcı veya null.
     */
    public function findByCode(string $code): ?User;

    /**
     * Belirtilen kullanıcı adına ait kullanıcıyı döndürür.
     *
     * Kullanıcı bulunamazsa null döndürülür.
     *
     * @param string $username aranacak kullanıcı adı.
     *
     * @return ?User bulunan kullanıcı veya null.
     */
    public function findByUsername(string $username): ?User;

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    /**
     * Belirtilen verilerle yeni bir kullanıcı oluşturur.
     *
     * @param array<string,mixed> $user oluşturulacak kullanıcı.
     *
     * @return string|false kullanıcı başarıyla oluşturulduysa kullanıcı kodu,
     * aksi halde false.
     */
    public function create(array $user): string|false;

    /**
     * Belirtilen kullanıcının değerlerini günceller.
     *
     * @param string $code güncellenecek kullanıcı kodu.
     * @param array<string,mixed> $user güncellenecek kullanıcı verileri.
     *
     * @return bool kullanıcı başarıyla güncellendiyse true, aksi halde false.
     */
    public function update(string $code, array $user): bool;

    /**
     * Belirtilen kullanıcıyı siler.
     *
     * @param string $code silinecek kullanıcı kodu.
     *
     * @return bool kullanıcı başarıyla silindiyse true, aksi halde false.
     */
    public function delete(string $code): bool;
}
