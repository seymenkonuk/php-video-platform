<?php
// ============================================================================
// File:    PlaylistToEditDtoMapper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Mappers;


use App\Domain\Enums\ViewType;
use App\Domain\Models\Playlist;

use App\Support\DTOs\Playlist\EditDTO;


readonly class PlaylistToEditDtoMapper
{
    public function map(Playlist $playlist): EditDTO
    {
        return new EditDTO(
            title: $playlist->title,
            description: $playlist->description,
            viewType: ViewType::from($playlist->view_type),
        );
    }

    /** @return array<string, mixed> */
    public function toArray(Playlist $playlist): array
    {
        return [
            "title" => $playlist->title,
            "description" => $playlist->description,
            "viewType" => $playlist->view_type,
        ];
    }

    /** @return array<string, mixed> */
    public function toModelArray(EditDTO $playlist): array
    {
        return [
            "title" => $playlist->title,
            "description" => $playlist->description,
            "view_type" => $playlist->viewType->value,
        ];
    }
}
