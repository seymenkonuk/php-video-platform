<?php
// ============================================================================
// File:    PlaylistRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Models\Playlist;
use App\Domain\Models\PlaylistDetails;
use App\Domain\Repositories\Abstract\IPlaylistRepository;


/** @extends SqlRepository<Playlist> */
class PlaylistRepository extends SqlRepository implements IPlaylistRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "playlist";
    protected string $primaryKey = "code";
    protected string $model = Playlist::class;

    // --------------------------------------------------------------------------
    // PUBLIC PLAYLISTS
    // --------------------------------------------------------------------------

    public function countPublic(): int
    {
        throw new \Exception('Not implemented');
    }

    public function yieldPublic(int $offset, int $limit): Generator
    {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // CHANNEL PLAYLISTS
    // --------------------------------------------------------------------------

    public function countPublicByChannel(string $channelCode): int
    {
        throw new \Exception('Not implemented');
    }

    public function yieldPublicByChannel(string $channelCode, int $offset, int $limit): Generator
    {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // STUDIO PLAYLISTS
    // --------------------------------------------------------------------------

    public function countByChannel(string $channelCode): int
    {
        throw new \Exception('Not implemented');
    }

    public function yieldByChannel(string $channelCode, int $offset, int $limit): Generator
    {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // FINDERS
    // --------------------------------------------------------------------------

    public function findByCode(string $code): ?Playlist
    {
        return $this->find($code);
    }

    public function findDetailsByCode(string $code): ?PlaylistDetails
    {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    public function create(array $playlist): string|false
    {
        return parent::create($playlist);
    }

    public function update(int|string $code, array $playlist): bool
    {
        return parent::update($code, $playlist);
    }

    public function delete(int|string $code): bool
    {
        return parent::delete($code);
    }
}
