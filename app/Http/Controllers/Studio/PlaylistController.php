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
use Seymenkonuk\Framework\Session;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;

use App\Http\Schemas\Studio\Playlist\IndexPageSchema;
use App\Http\Schemas\Studio\Playlist\CreatePageSchema;
use App\Http\Schemas\Studio\Playlist\CreateSchema;
use App\Http\Schemas\Studio\Playlist\EditPageSchema;
use App\Http\Schemas\Studio\Playlist\EditSchema;
use App\Http\Schemas\Studio\Playlist\DeleteSchema;
use App\Http\Schemas\Studio\Playlist\ChangeBannerSchema;

use App\Support\DTOs\UI\PaginationDTO;

use App\Support\Factories\ViewContextFactory;

use App\Support\Providers\FormOptionsProvider;

use App\Support\ViewModels\Studio\Playlist\IndexPageViewModel;
use App\Support\ViewModels\Studio\Playlist\CreatePageViewModel;
use App\Support\ViewModels\Studio\Playlist\EditPageViewModel;


#[Prefix("/studio/playlists")]
class PlaylistController extends Controller
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
        return $this->response->view("/studio/playlists/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                playlists: (function () {
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

        return $this->response->view("/studio/playlists/new/index", [
            "model" => new CreatePageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->playlist(),
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

    #[Get("/{playlistCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(string $playlistCode): Response
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

        return $this->response->view("/studio/playlists/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->playlist(),
                deleteUrl: "/studio/playlists/1/delete",
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{playlistCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(string $playlistCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{playlistCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(string $playlistCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{playlistCode}/change-banner")]
    #[Schema(ChangeBannerSchema::class)]
    public function ChangeBanner(string $playlistCode): Response
    {
        return $this->response->redirect("/");
    }
}
