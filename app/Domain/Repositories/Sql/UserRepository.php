<?php
// ============================================================================
// File:    UserRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Models\User;
use App\Domain\Repositories\Abstract\IUserRepository;


/** @extends SqlRepository<User> */
class UserRepository extends SqlRepository implements IUserRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "user";
    protected string $primaryKey = "code";
    protected string $model = User::class;

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    public function existsByCode(string $code): bool
    {
        return $this->exists($code);
    }

    public function existsByUsername(string $username): bool
    {
        return $this->existsBy("username", $username);
    }

    public function existsByEmail(string $email): bool
    {
        return $this->existsBy("email", $email);
    }

    public function findByCode(string $code): ?User
    {
        return $this->where("code", $code);
    }

    public function findByUsername(string $username): ?User
    {
        return $this->where("username", $username);
    }

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    public function create(array $user): string|false
    {
        return parent::create($user);
    }

    public function update(int|string $code, array $user): bool
    {
        return parent::update($code, $user);
    }

    public function delete(int|string $code): bool
    {
        return parent::delete($code);
    }
}
