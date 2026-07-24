<?php
// ============================================================================
// File:    HomeController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Route\Get;

use App\Http\Schemas\Home\IndexPageSchema;

use App\Support\Factories\ViewContextFactory;

use App\Support\ViewModels\Home\IndexPageViewModel;


class HomeController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->view("/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
            ),
        ]);
    }
}
