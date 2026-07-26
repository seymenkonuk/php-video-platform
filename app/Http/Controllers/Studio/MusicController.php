<?php
// ============================================================================
// File:    MusicController.php
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

use App\Http\Schemas\Studio\Music\IndexPageSchema;
use App\Http\Schemas\Studio\Music\CreatePageSchema;
use App\Http\Schemas\Studio\Music\CreateSchema;
use App\Http\Schemas\Studio\Music\EditPageSchema;
use App\Http\Schemas\Studio\Music\EditSchema;
use App\Http\Schemas\Studio\Music\DeleteSchema;
use App\Http\Schemas\Studio\Music\ChangeThumbnailSchema;

use App\Support\DTOs\UI\PaginationDTO;

use App\Support\Factories\ViewContextFactory;

use App\Support\Providers\FormOptionsProvider;

use App\Support\ViewModels\Studio\Music\IndexPageViewModel;
use App\Support\ViewModels\Studio\Music\CreatePageViewModel;
use App\Support\ViewModels\Studio\Music\EditPageViewModel;


#[Prefix("/studio/musics")]
class MusicController extends Controller
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
        return $this->response->view("/studio/musics/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                musics: (function () {
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

        return $this->response->view("/studio/musics/new/index", [
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

    #[Get("/{musicCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(string $musicCode): Response
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

        return $this->response->view("/studio/musics/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->media(),
                deleteUrl: "/studio/musics/1/delete",
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{musicCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(string $musicCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{musicCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(string $musicCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{musicCode}/change-thumbnail")]
    #[Schema(ChangeThumbnailSchema::class)]
    public function ChangeThumbnail(string $musicCode): Response
    {
        return $this->response->redirect("/");
    }
}
