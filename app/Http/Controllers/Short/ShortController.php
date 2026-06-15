<?php
// ============================================================================
// File:    ShortController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Short;


use App\Http\Schemas\Short\Index\IndexPageSchema;
use App\Http\Schemas\Short\Index\WatchPageSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/shorts")]
class ShortController extends Controller
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

    #[Get("/{shortCode}")]
    #[Schema(WatchPageSchema::class)]
    public function WatchPage(string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
