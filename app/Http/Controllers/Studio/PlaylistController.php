<?php
// ============================================================================
// File:    PlaylistController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Studio;


use Seymenkonuk\Framework\Attribute\Auth\Authenticated;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Flash\IFlash;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Enums\ViewType;
use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IStudioService;

use App\Http\Schemas\Studio\Playlist\ChangeBannerSchema;
use App\Http\Schemas\Studio\Playlist\CreatePageSchema;
use App\Http\Schemas\Studio\Playlist\CreateSchema;
use App\Http\Schemas\Studio\Playlist\DeleteSchema;
use App\Http\Schemas\Studio\Playlist\EditPageSchema;
use App\Http\Schemas\Studio\Playlist\EditSchema;
use App\Http\Schemas\Studio\Playlist\IndexPageSchema;

use App\Support\DTOs\Playlist\CreateDTO;
use App\Support\DTOs\Playlist\EditDTO;
use App\Support\Factories\ViewContextFactory;
use App\Support\Helpers\UploadHelper;
use App\Support\Providers\FormOptionsProvider;
use App\Support\ViewModels\Studio\Playlist\CreatePageViewModel;
use App\Support\ViewModels\Studio\Playlist\EditPageViewModel;
use App\Support\ViewModels\Studio\Playlist\IndexPageViewModel;


#[Prefix("/studio/playlists")]
#[Authenticated]
class PlaylistController extends Controller
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected FormOptionsProvider $formOptionsProvider,
        protected UploadHelper $uploadHelper,
        protected IAuthService $authService,
        protected IStudioService $studioService,
        protected IFlash $flash,
    ) {}

    // --------------------------------------------------------------------------
    // ACTIONS
    // --------------------------------------------------------------------------

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $page = $request->query("page", 1);

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $result = $this->studioService->getPlaylistsPage($auth, $page);

        // View model döndür
        return $response->view("/studio/playlists/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                playlists: $result->playlists,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/new")]
    #[Schema(CreatePageSchema::class)]
    public function CreatePage(IResponse $response): IResponse
    {
        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // View döndür
        return $response->view("/studio/playlists/new/index", [
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
    public function Create(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $title = $request->post("title", "");
        $description = $request->post("description", "");
        $viewType = $request->post("viewType", "");

        // Dosyaları al
        $banner = $request->file("banner");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Timestamp bilgisini al
        $timestamp = time();

        // Dosyaları taşı
        $bannerPath = $banner
            ? $this->uploadHelper->move($banner, $auth->channel->code, "playlist", "banner_{$timestamp}.{$banner->extension()}")
            : null;

        // Servisi çağır
        $this->studioService->createPlaylist(new CreateDTO(
            title: $title,
            description: $description,
            viewType: ViewType::from($viewType),
            bannerPath: $bannerPath,
        ), $auth);

        // Oynatma listelerim sayfasına geri yönlendir
        return $response->redirect("/studio/playlists");
    }

    #[Get("/{playlistCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $playlistCode = $request->param("playlistCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $playlist = $this->studioService->getPlaylistEdit($playlistCode, $auth);

        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // Oynatma listesi verilerini varsayılan değer olarak al, önceki form değerlerini koru
        $values["body"] = array_merge($playlist, $values["body"] ?? []); // @phpstan-ignore nullCoalesce.offset

        // View döndür
        return $response->view("/studio/playlists/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->playlist(),
                deleteUrl: "/studio/playlists/{$playlistCode}/delete",
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{playlistCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $playlistCode = $request->param("playlistCode", "");
        $title = $request->post("title", "");
        $description = $request->post("description", "");
        $viewType = $request->post("viewType", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Oynatma listesini al (mevcutluk kontrolü ve yetki kontrolü)
        $this->studioService->getPlaylistEdit($playlistCode, $auth);

        // Oynatma listesini güncelle
        $this->studioService->updatePlaylist($playlistCode, new EditDTO(
            title: $title,
            description: $description,
            viewType: ViewType::from($viewType),
        ), $auth);

        // Yönlendir
        return $response->redirect("/studio/playlists");
    }

    #[Post("/{playlistCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $playlistCode = $request->param("playlistCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $this->studioService->deletePlaylist($playlistCode, $auth);

        // Oynatma listelerim sayfasına geri yönlendir
        return $response->redirect("/studio/playlists");
    }

    #[Post("/{playlistCode}/change-banner")]
    #[Schema(ChangeBannerSchema::class)]
    public function ChangeBanner(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }
}
