<?php
// ============================================================================
// File:    DashboardController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Studio;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;

use App\Http\Schemas\Studio\Dashboard\IndexPageSchema;

use App\Support\Factories\ViewContextFactory;

use App\Support\ViewModels\Studio\Dashboard\IndexPageViewModel;


#[Prefix("/studio")]
class DashboardController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->view("/studio/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                editUrl: "/studio/users/1/edit",
                changePasswordUrl: "/studio/users/1/change-password",
                deleteUrl: "/studio/users/1/delete",
            ),
        ]);
    }
}
