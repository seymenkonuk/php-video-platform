<?php
// ============================================================================
// File:    PlaylistController.php
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


#[Prefix("/studio/playlists")]
class PlaylistController extends Controller
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

    #[Get("/{playlistCode}/edit")]
    public function EditPage(string $playlistCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{playlistCode}/edit")]
    public function Edit(string $playlistCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{playlistCode}/delete")]
    public function Delete(string $playlistCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{playlistCode}/change-banner")]
    public function ChangeBanner(string $playlistCode): Response
    {
        return $this->response->redirect("/");
    }
}
