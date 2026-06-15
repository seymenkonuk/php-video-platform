<?php
// ============================================================================
// File:    ShortController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Studio;


use App\Http\Schemas\Studio\Short\IndexPageSchema;
use App\Http\Schemas\Studio\Short\CreatePageSchema;
use App\Http\Schemas\Studio\Short\CreateSchema;
use App\Http\Schemas\Studio\Short\EditPageSchema;
use App\Http\Schemas\Studio\Short\EditSchema;
use App\Http\Schemas\Studio\Short\DeleteSchema;
use App\Http\Schemas\Studio\Short\ChangeThumbnailSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
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

    #[Get("/{shortCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(string $shortCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{shortCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(string $shortCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{shortCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(string $shortCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{shortCode}/change-thumbnail")]
    #[Schema(ChangeThumbnailSchema::class)]
    public function ChangeThumbnail(string $shortCode): Response
    {
        return $this->response->redirect("/");
    }
}
