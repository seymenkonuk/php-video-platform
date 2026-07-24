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
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;

use App\Http\Schemas\Studio\Video\IndexPageSchema;
use App\Http\Schemas\Studio\Video\CreatePageSchema;
use App\Http\Schemas\Studio\Video\CreateSchema;
use App\Http\Schemas\Studio\Video\EditPageSchema;
use App\Http\Schemas\Studio\Video\EditSchema;
use App\Http\Schemas\Studio\Video\DeleteSchema;
use App\Http\Schemas\Studio\Video\ChangeThumbnailSchema;

use App\Support\DTOs\UI\PaginationDTO;

use App\Support\ViewModels\Studio\Video\IndexPageViewModel;
use App\Support\ViewModels\Studio\Video\CreatePageViewModel;
use App\Support\ViewModels\Studio\Video\EditPageViewModel;


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
        return $this->response->view("/studio/videos/index", [
            "model" => new IndexPageViewModel((function () {
                yield from [];
            })(), new PaginationDTO(1, 1, 0, 0, 0))
        ]);
    }

    #[Get("/new")]
    #[Schema(CreatePageSchema::class)]
    public function CreatePage(): Response
    {
        return $this->response->view("/studio/videos/new/index", [
            "model" => new CreatePageViewModel([], []),
        ]);
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
        return $this->response->view("/studio/videos/[id]/edit/index", [
            "model" => new EditPageViewModel("/studio/videos/1/delete", [], []),
        ]);
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
