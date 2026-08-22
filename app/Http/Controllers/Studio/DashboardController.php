<?php
// ============================================================================
// File:    DashboardController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Studio;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Schemas\Studio\Dashboard\IndexPageSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Studio\Dashboard\IndexPageViewModel;


#[Prefix("/studio")]
class DashboardController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IResponse $response): IResponse
    {
        return $response->view("/studio/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                editUrl: "/studio/users/1/edit",
                changePasswordUrl: "/studio/users/1/change-password",
                deleteUrl: "/studio/users/1/delete",
            ),
        ]);
    }
}
