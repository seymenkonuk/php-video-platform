<?php
// ============================================================================
// File:    MusicController.php
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

use App\Domain\Enums\CommentType;
use App\Domain\Enums\ViewType;
use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IStudioService;

use App\Http\Schemas\Studio\Music\ChangeThumbnailSchema;
use App\Http\Schemas\Studio\Music\CreatePageSchema;
use App\Http\Schemas\Studio\Music\CreateSchema;
use App\Http\Schemas\Studio\Music\DeleteSchema;
use App\Http\Schemas\Studio\Music\EditPageSchema;
use App\Http\Schemas\Studio\Music\EditSchema;
use App\Http\Schemas\Studio\Music\IndexPageSchema;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Music\EditDTO;
use App\Support\Factories\ViewContextFactory;
use App\Support\Providers\FormOptionsProvider;
use App\Support\ViewModels\Studio\Music\CreatePageViewModel;
use App\Support\ViewModels\Studio\Music\EditPageViewModel;
use App\Support\ViewModels\Studio\Music\IndexPageViewModel;


#[Prefix("/studio/musics")]
#[Authenticated]
class MusicController extends Controller
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected FormOptionsProvider $formOptionsProvider,
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
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $result = $this->studioService->getMusicsPage($auth, $page);

        // View model döndür
        return $response->view("/studio/musics/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                musics: $result->musics,
                pagination: $result->pagination,
            )
        ]);
    }

    #[Get("/new")]
    #[Schema(CreatePageSchema::class)]
    public function CreatePage(IResponse $response): IResponse
    {
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        return $response->view("/studio/musics/new/index", [
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

    #[Get("/{musicCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $musicCode = $request->param("musicCode", "");
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $music = $this->studioService->getMusicEdit($musicCode, $auth);

        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // Müzik verilerini varsayılan değer olarak al, önceki form değerlerini koru
        $values["body"] = array_merge($music, $values["body"] ?? []); // @phpstan-ignore nullCoalesce.offset

        // View döndür
        return $response->view("/studio/musics/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->media(),
                deleteUrl: "/studio/musics/{$musicCode}/delete",
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{musicCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $musicCode = $request->param("musicCode", "");
        $title = $request->post("title", "");
        $description = $request->post("description", "");
        $viewType = $request->post("viewType", "");
        $commentType = $request->post("commentType", "");
        $transcript = $request->post("transcript", "");
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Müziği al (mevcutluk kontrolü ve yetki kontrolü)
        $this->studioService->getMusicEdit($musicCode, $auth);

        // Müziği güncelle
        $this->studioService->updateMusic($musicCode, new EditDTO(
            title: $title,
            description: $description,
            viewType: ViewType::from($viewType),
            commentType: CommentType::from($commentType),
            transcript: $transcript,
        ), $auth);

        // Yönlendir
        return $response->redirect("/studio/musics");
    }

    #[Post("/{musicCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $musicCode = $request->param("musicCode", "");
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $this->studioService->deleteMusic($musicCode, $auth);

        // Müziklerim sayfasına geri yönlendir
        return $response->redirect("/studio/musics");
    }

    #[Post("/{musicCode}/change-thumbnail")]
    #[Schema(ChangeThumbnailSchema::class)]
    public function ChangeThumbnail(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }
}
