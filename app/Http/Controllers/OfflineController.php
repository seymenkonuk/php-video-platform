<?php
// ============================================================================
// File:    OfflineController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Schemas\Offline\IndexPageSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Offline\IndexPageViewModel;


#[Prefix("/offline")]
class OfflineController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IResponse $response): IResponse
    {
        return $response->view("/offline/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
            ),
        ]);
    }
}
