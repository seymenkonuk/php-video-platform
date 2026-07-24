<?php
// ============================================================================
// File:    ShortController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Short;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;

use App\Http\Schemas\Short\Index\IndexPageSchema;
use App\Http\Schemas\Short\Index\WatchPageSchema;

use App\Support\DTOs\UI\PaginationDTO;

use App\Support\Factories\ViewContextFactory;

use App\Support\ViewModels\Short\IndexPageViewModel;


#[Prefix("/shorts")]
class ShortController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->view("/shorts/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                shorts: (function () {
                    yield from [];
                })(),
                pagination: new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/{shortCode}")]
    #[Schema(WatchPageSchema::class)]
    public function WatchPage(string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
