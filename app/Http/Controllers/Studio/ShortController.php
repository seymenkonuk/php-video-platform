<?php
// ============================================================================
// File:    ShortController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Studio;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/studio/shorts")]
class ShortController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/")]
    public function IndexPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/new")]
    public function CreatePage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/new")]
    public function Create(): Response
    {
        return $this->response->redirect("/");
    }

    #[Get("/{shortCode}/edit")]
    public function EditPage(string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{shortCode}/edit")]
    public function Edit(string $shortCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{shortCode}/delete")]
    public function Delete(string $shortCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{shortCode}/change-thumbnail")]
    public function ChangeThumbnail(string $shortCode): Response
    {
        return $this->response->redirect("/");
    }
}
