<?php
// ============================================================================
// File:    PlaylistVideoTableSeeder.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Database\Seeders;


class PlaylistVideoTableSeeder extends Seeder
{
    // --------------------------------------------------------------------------
    // CONSTANTS
    // --------------------------------------------------------------------------

    public const COUNT = PlaylistTableSeeder::COUNT * VideoTableSeeder::COUNT;

    // --------------------------------------------------------------------------
    // CONFIG
    // --------------------------------------------------------------------------

    protected string $table = "playlist_video";
    protected string $primaryKey = "id";
    protected string $model = "";

    // --------------------------------------------------------------------------
    // UP
    // --------------------------------------------------------------------------

    public function Up()
    {
        // İlişkileri Rastgele Oluştur
        $lists = $this->generateRandomRelations(PlaylistTableSeeder::COUNT, VideoTableSeeder::COUNT);

        // Playlistlerin Video Adetleri
        $positions = array_fill(1, PlaylistTableSeeder::COUNT, 1);

        // Verileri Oluştur
        foreach ($lists as $list) {
            $this->create([
                "playlist_id" => $list[0],
                "video_id" => $list[1],
                "position" => $positions[$list[0]]++,
            ]);
        }
    }

    // --------------------------------------------------------------------------
    // DOWN
    // --------------------------------------------------------------------------

    public function Down() {}
}
