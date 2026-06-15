<?php
// ============================================================================
// File:    CategoryController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Category;


use App\Http\Schemas\Category\Index\IndexPageSchema;
use App\Http\Schemas\Category\Index\HomePageSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/categories")]
class CategoryController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/{categoryCode}")]
    #[Schema(HomePageSchema::class)]
    public function HomePage(string $categoryCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
