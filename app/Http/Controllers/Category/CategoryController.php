<?php
// ============================================================================
// File:    CategoryController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Category;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;

use App\Http\Schemas\Category\Index\IndexPageSchema;
use App\Http\Schemas\Category\Index\HomePageSchema;

use App\Support\DTOs\Category\HeaderDTO;
use App\Support\DTOs\UI\PaginationDTO;

use App\Support\Factories\ViewContextFactory;

use App\Support\ViewModels\Category\IndexPageViewModel;
use App\Support\ViewModels\Category\HomePageViewModel;


#[Prefix("/categories")]
class CategoryController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->view("/categories/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                categories: (function () {
                    yield from [];
                })(),
                pagination: new PaginationDTO(1, 1, 0, 0, 0)
            )
        ]);
    }

    #[Get("/{categoryCode}")]
    #[Schema(HomePageSchema::class)]
    public function HomePage(string $categoryCode): Response
    {
        return $this->response->view("/categories/[id]/index", [
            "model" => new HomePageViewModel(
                context: $this->viewContextFactory->app(),
                header: new HeaderDTO("Başlık", "Açıklama", "/uploads/categories/1/banners/1", 0, "0"),
                videos: (function () {
                    yield from [];
                })(),
                pagination: new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }
}
