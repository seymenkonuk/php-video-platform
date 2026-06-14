<?php
// ============================================================================
// File:    SearchController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Route\Get;


class SearchController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/search")]
    public function IndexPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
