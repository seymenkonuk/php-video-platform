<?php
// ============================================================================
// File:    VideoController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Video;


use App\Http\Schemas\Video\Index\IndexPageSchema;
use App\Http\Schemas\Video\Index\WatchPageSchema;

use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewModels\Video\IndexPageViewModel;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/videos")]
class VideoController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->view("/videos/index", [
            "model" => new IndexPageViewModel((function () {
                yield from [];
            })(), new PaginationDTO(1, 1, 0, 0, 0))
        ]);
    }

    #[Get("/{videoCode}")]
    #[Schema(WatchPageSchema::class)]
    public function WatchPage(string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
