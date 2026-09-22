<?php
// ============================================================================
// File:    CategoryController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Category;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\ICategoryService;

use App\Http\Schemas\Category\Index\HomePageSchema;
use App\Http\Schemas\Category\Index\IndexPageSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Category\HomePageViewModel;
use App\Support\ViewModels\Category\IndexPageViewModel;


#[Prefix("/categories")]
class CategoryController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected ICategoryService $categoryService,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);

        // Servisi çağır
        $result = $this->categoryService->getCategories($page);

        // View model döndür
        return $response->view("/categories/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                categories: $result->categories,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/{categoryCode}")]
    #[Schema(HomePageSchema::class)]
    public function HomePage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $code = $request->param("categoryCode", "");
        $page = $request->query("page", 1);

        // Servisi çağır
        $result = $this->categoryService->getCategoryPage($code, $page);

        // View model döndür
        return $response->view("/categories/[id]/index", [
            "model" => new HomePageViewModel(
                context: $this->viewContextFactory->app(),
                header: $result->header,
                videos: $result->videos,
                pagination: $result->pagination,
            )
        ]);
    }
}
