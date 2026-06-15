<?php
// ============================================================================
// File:    VideoController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Studio;


use App\Http\Schemas\Studio\Video\IndexPageSchema;
use App\Http\Schemas\Studio\Video\CreatePageSchema;
use App\Http\Schemas\Studio\Video\CreateSchema;
use App\Http\Schemas\Studio\Video\EditPageSchema;
use App\Http\Schemas\Studio\Video\EditSchema;
use App\Http\Schemas\Studio\Video\DeleteSchema;
use App\Http\Schemas\Studio\Video\ChangeThumbnailSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
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
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Get("/new")]
    #[Schema(CreatePageSchema::class)]
    public function CreatePage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/new")]
    #[Schema(CreateSchema::class)]
    public function Create(): Response
    {
        return $this->response->redirect("/");
    }

    #[Get("/{videoCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(string $videoCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{videoCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(string $videoCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{videoCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(string $videoCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{videoCode}/change-thumbnail")]
    #[Schema(ChangeThumbnailSchema::class)]
    public function ChangeThumbnail(string $videoCode): Response
    {
        return $this->response->redirect("/");
    }
}
