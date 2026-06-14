<?php
// ============================================================================
// File:    ChannelController.php
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


#[Prefix("/studio/channels")]
class ChannelController extends Controller
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

    #[Get("/{channelCode}/edit")]
    public function EditPage(string $channelCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{channelCode}/edit")]
    public function Edit(string $channelCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{channelCode}/delete")]
    public function Delete(string $channelCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{channelCode}/change-avatar")]
    public function ChangeAvatar(string $channelCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{channelCode}/change-banner")]
    public function ChangeBanner(string $channelCode): Response
    {
        return $this->response->redirect("/");
    }
}
