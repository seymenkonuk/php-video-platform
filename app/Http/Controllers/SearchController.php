<?php
// ============================================================================
// File:    SearchController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Schemas\Search\IndexPageSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Search\IndexPageViewModel;


#[Prefix("/search")]
class SearchController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IRequest $request, IResponse $response): IResponse
    {
        $search = $request->query("q", "");

        return $response->view("/search/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->app(),
                search: $search,
            ),
        ]);
    }
}
