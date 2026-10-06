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
}
