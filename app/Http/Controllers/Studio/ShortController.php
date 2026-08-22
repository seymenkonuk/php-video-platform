<?php
// ============================================================================
// File:    ShortController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Studio;


use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Flash\IFlash;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Schemas\Studio\Short\ChangeThumbnailSchema;
use App\Http\Schemas\Studio\Short\CreatePageSchema;
use App\Http\Schemas\Studio\Short\CreateSchema;
use App\Http\Schemas\Studio\Short\DeleteSchema;
use App\Http\Schemas\Studio\Short\EditPageSchema;
use App\Http\Schemas\Studio\Short\EditSchema;
use App\Http\Schemas\Studio\Short\IndexPageSchema;

use App\Support\DTOs\UI\PaginationDTO;
use App\Support\Factories\ViewContextFactory;
use App\Support\Providers\FormOptionsProvider;
use App\Support\ViewModels\Studio\Short\CreatePageViewModel;
use App\Support\ViewModels\Studio\Short\EditPageViewModel;
use App\Support\ViewModels\Studio\Short\IndexPageViewModel;


#[Prefix("/studio/shorts")]
class ShortController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected FormOptionsProvider $formOptionsProvider,
        protected IFlash $flash,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IResponse $response): IResponse
    {
        return $response->view("/studio/shorts/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                shorts: (function () {
                    yield from [];
                })(),
                pagination: new PaginationDTO(1, 1, 0, 0, 0),
            )
        ]);
    }

    #[Get("/new")]
    #[Schema(CreatePageSchema::class)]
    public function CreatePage(IResponse $response): IResponse
    {
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        return $response->view("/studio/shorts/new/index", [
            "model" => new CreatePageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->media(),
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/new")]
    #[Schema(CreateSchema::class)]
    public function Create(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }

    #[Get("/{shortCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(IResponse $response): IResponse
    {
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        return $response->view("/studio/shorts/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->media(),
                deleteUrl: "/studio/shorts/1/delete",
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{shortCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }

    #[Post("/{shortCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }

    #[Post("/{shortCode}/change-thumbnail")]
    #[Schema(ChangeThumbnailSchema::class)]
    public function ChangeThumbnail(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }
}
