<?php
// ============================================================================
// File:    VideoController.php
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

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IStudioService;

use App\Http\Schemas\Studio\Video\ChangeThumbnailSchema;
use App\Http\Schemas\Studio\Video\CreatePageSchema;
use App\Http\Schemas\Studio\Video\CreateSchema;
use App\Http\Schemas\Studio\Video\DeleteSchema;
use App\Http\Schemas\Studio\Video\EditPageSchema;
use App\Http\Schemas\Studio\Video\EditSchema;
use App\Http\Schemas\Studio\Video\IndexPageSchema;

use App\Support\DTOs\AuthDTO;
use App\Support\Factories\ViewContextFactory;
use App\Support\Providers\FormOptionsProvider;
use App\Support\ViewModels\Studio\Video\CreatePageViewModel;
use App\Support\ViewModels\Studio\Video\EditPageViewModel;
use App\Support\ViewModels\Studio\Video\IndexPageViewModel;


#[Prefix("/studio/videos")]
#[Authenticated]
class VideoController extends Controller
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
        $result = $this->studioService->getVideosPage($auth, $page);

        // View model döndür
        return $response->view("/studio/videos/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                videos: $result->videos,
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

        return $response->view("/studio/videos/new/index", [
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

    #[Get("/{videoCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(IResponse $response): IResponse
    {
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        return $response->view("/studio/videos/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->media(),
                deleteUrl: "/studio/videos/1/delete",
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{videoCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }

    #[Post("/{videoCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $videoCode = $request->param("videoCode", "");
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $this->studioService->deleteVideo($videoCode, $auth);

        // Videolarım sayfasına geri yönlendir
        return $response->redirect("/studio/videos");
    }

    #[Post("/{videoCode}/change-thumbnail")]
    #[Schema(ChangeThumbnailSchema::class)]
    public function ChangeThumbnail(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }
}
