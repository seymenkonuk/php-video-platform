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
use Seymenkonuk\Framework\Session;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;

use App\Http\Schemas\Studio\Short\IndexPageSchema;
use App\Http\Schemas\Studio\Short\CreatePageSchema;
use App\Http\Schemas\Studio\Short\CreateSchema;
use App\Http\Schemas\Studio\Short\EditPageSchema;
use App\Http\Schemas\Studio\Short\EditSchema;
use App\Http\Schemas\Studio\Short\DeleteSchema;
use App\Http\Schemas\Studio\Short\ChangeThumbnailSchema;

use App\Support\DTOs\UI\PaginationDTO;

use App\Support\Factories\ViewContextFactory;

use App\Support\Providers\FormOptionsProvider;

use App\Support\ViewModels\Studio\Short\IndexPageViewModel;
use App\Support\ViewModels\Studio\Short\CreatePageViewModel;
use App\Support\ViewModels\Studio\Short\EditPageViewModel;


#[Prefix("/studio/shorts")]
class ShortController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected FormOptionsProvider $formOptionsProvider,
        protected Session $session,
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->view("/studio/shorts/index", [
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
    public function CreatePage(): Response
    {
        /** @var array{
         *     body?: array<string, mixed>,
         *     query?: array<string, mixed>,
         *     params?: array<string, mixed>,
         *     files?: array<string, mixed>,
         * } $errors */
        $errors = $this->session->getFlash("errors", []);
        /** @var array{
         *     body?: array<string, mixed>,
         *     query?: array<string, mixed>,
         *     params?: array<string, mixed>,
         *     files?: array<string, mixed>,
         * } $values */
        $values = $this->session->getFlash("values", []);

        return $this->response->view("/studio/shorts/new/index", [
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
    public function Create(): Response
    {
        return $this->response->redirect("/");
    }

    #[Get("/{shortCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(string $shortCode): Response
    {
        /** @var array{
         *     body?: array<string, mixed>,
         *     query?: array<string, mixed>,
         *     params?: array<string, mixed>,
         *     files?: array<string, mixed>,
         * } $errors */
        $errors = $this->session->getFlash("errors", []);
        /** @var array{
         *     body?: array<string, mixed>,
         *     query?: array<string, mixed>,
         *     params?: array<string, mixed>,
         *     files?: array<string, mixed>,
         * } $values */
        $values = $this->session->getFlash("values", []);

        return $this->response->view("/studio/shorts/[id]/edit/index", [
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
