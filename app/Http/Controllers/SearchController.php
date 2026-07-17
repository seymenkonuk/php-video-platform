<?php
// ============================================================================
// File:    SearchController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use App\Http\Schemas\Search\IndexPageSchema;

use App\Support\ViewModels\Search\IndexPageViewModel;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Request;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/search")]
class SearchController extends Controller
{
    public function __construct(
        protected Request $request,
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        /** @var string $search */
        $search = $this->request->query("q", "");

        return $this->response->view("/search/index", [
            "model" => new IndexPageViewModel($search),
        ]);
    }
}
