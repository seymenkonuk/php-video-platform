<?php
// ============================================================================
// File:    VideoController.php
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


#[Prefix("/studio/videos")]
class VideoController extends Controller
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

    #[Get("/{videoCode}/edit")]
    public function EditPage(string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{videoCode}/edit")]
    public function Edit(string $videoCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{videoCode}/delete")]
    public function Delete(string $videoCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{videoCode}/change-thumbnail")]
    public function ChangeThumbnail(string $videoCode): Response
    {
        return $this->response->redirect("/");
    }
}
