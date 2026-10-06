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

use App\Domain\Enums\CommentType;
use App\Domain\Enums\ViewType;
use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IStudioService;

use App\Http\Schemas\Studio\Video\ChangeThumbnailSchema;
use App\Http\Schemas\Studio\Video\CreatePageSchema;
use App\Http\Schemas\Studio\Video\CreateSchema;
use App\Http\Schemas\Studio\Video\DeleteSchema;
use App\Http\Schemas\Studio\Video\EditPageSchema;
use App\Http\Schemas\Studio\Video\EditSchema;
use App\Http\Schemas\Studio\Video\IndexPageSchema;

use App\Support\DTOs\Video\CreateDTO;
use App\Support\DTOs\Video\EditDTO;
use App\Support\Factories\ViewContextFactory;
use App\Support\Helpers\UploadHelper;
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
        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // View döndür
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
    public function Create(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $title = $request->post("title", "");
        $description = $request->post("description", "");
        $viewType = $request->post("viewType", "");
        $commentType = $request->post("commentType", "");

        // Dosyaları al
        $file = $request->file("file");
        $thumbnail = $request->file("thumbnail");
        assert($file !== null); // file zorunlu alan, null olamaz

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Timestamp bilgisini al
        $timestamp = time();

        // Dosyaları taşı
        $filePath = $this->uploadHelper->move($file, $auth->channel->code, "video", "file_{$timestamp}.{$file->extension()}");
        $thumbnailPath = $thumbnail
            ? $this->uploadHelper->move($thumbnail, $auth->channel->code, "video", "thumbnail_{$timestamp}.{$thumbnail->extension()}")
            : null;

        // Servisi çağır
        $this->studioService->createVideo(new CreateDTO(
            title: $title,
            description: $description,
            viewType: ViewType::from($viewType),
            commentType: CommentType::from($commentType),
            filePath: $filePath,
            thumbnailPath: $thumbnailPath,
        ), $auth);

        // Videolarım sayfasına geri yönlendir
        return $response->redirect("/studio/videos");
    }

    #[Get("/{videoCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $videoCode = $request->param("videoCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $video = $this->studioService->getVideoEdit($videoCode, $auth);

        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // Video verilerini varsayılan değer olarak al, önceki form değerlerini koru
        $values["body"] = array_merge($video, $values["body"] ?? []); // @phpstan-ignore nullCoalesce.offset

        // View döndür
        return $response->view("/studio/videos/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->media(),
                deleteUrl: "/studio/videos/{$videoCode}/delete",
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{videoCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $videoCode = $request->param("videoCode", "");
        $title = $request->post("title", "");
        $description = $request->post("description", "");
        $viewType = $request->post("viewType", "");
        $commentType = $request->post("commentType", "");
        $transcript = $request->post("transcript", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Videoyu al (mevcutluk kontrolü ve yetki kontrolü)
        $this->studioService->getVideoEdit($videoCode, $auth);

        // Videoyu güncelle
        $this->studioService->updateVideo($videoCode, new EditDTO(
            title: $title,
            description: $description,
            viewType: ViewType::from($viewType),
            commentType: CommentType::from($commentType),
            transcript: $transcript,
        ), $auth);

        // Yönlendir
        return $response->redirect("/studio/videos");
    }

    #[Post("/{videoCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $videoCode = $request->param("videoCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

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
