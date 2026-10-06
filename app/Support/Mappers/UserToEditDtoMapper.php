<?php
// ============================================================================
// File:    UserToEditDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Models\User;

use App\Support\DTOs\User\EditDTO;


readonly class UserToEditDtoMapper
{
    public function map(User $user): EditDTO
    {
        return new EditDTO(
            name: $user->name,
            surname: $user->surname,
            username: $user->username,
            email: $user->email,
            country: $user->country,
        );
    }

    /** @return array<string, mixed> */
    public function toArray(User $user): array
    {
        return [
            "name" => $user->name,
            "surname" => $user->surname,
            "username" => $user->username,
            "email" => $user->email,
            "country" => $user->country,
        ];
    }

    /** @return array<string, mixed> */
    public function toModelArray(EditDTO $user): array
    {
        return [
            "name" => $user->name,
            "surname" => $user->surname,
            "username" => $user->username,
            "email" => $user->email,
            "country" => $user->country,
        ];
    }
}
