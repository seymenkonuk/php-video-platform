<?php
// ============================================================================
// File:    VideoRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Domain\Repositories\Sql;


use Generator;

use Seymenkonuk\Framework\Database\SqlRepository;

use App\Domain\Enums\VideoType;
use App\Domain\Models\Video;
use App\Domain\Models\VideoDetails;
use App\Domain\Repositories\Abstract\IVideoRepository;


/** @extends SqlRepository<Video> */
class VideoRepository extends SqlRepository implements IVideoRepository
{
    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "video";
    protected string $primaryKey = "code";
    protected string $model = Video::class;

    protected int $type = VideoType::VIDEO->value;

    // --------------------------------------------------------------------------
    // PUBLIC VIDEOS
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
    // CHANNEL VIDEOS
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
    // STUDIO VIDEOS
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

    public function findByCode(string $code): ?Video
    {
        return $this->database
            ->query("
                SELECT *
                FROM {$this->table}
                WHERE code = :code AND video_type = :type
                LIMIT 1
            ")
            ->execute([
                "code" => $code,
                "type" => $this->type,
            ])
            ->fetch($this->model);
    }

    public function findDetailsByCode(string $code, ?string $channelCode): ?VideoDetails
    {
        throw new \Exception('Not implemented');
    }

    // --------------------------------------------------------------------------
    // MUTATIONS
    // --------------------------------------------------------------------------

    public function create(array $video): string|false
    {
        $video["video_type"] = $this->type;
        return parent::create($video);
    }

    public function update(int|string $code, array $video): bool
    {
        return parent::update($code, $video);
    }

    public function delete(int|string $code): bool
    {
        return parent::delete($code);
    }
}
