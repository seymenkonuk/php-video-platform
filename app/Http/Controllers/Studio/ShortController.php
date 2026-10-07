<?php
// ============================================================================
// File:    ShortController.php
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

use App\Http\Schemas\Studio\Short\ChangeThumbnailSchema;
use App\Http\Schemas\Studio\Short\CreatePageSchema;
use App\Http\Schemas\Studio\Short\CreateSchema;
use App\Http\Schemas\Studio\Short\DeleteSchema;
use App\Http\Schemas\Studio\Short\EditPageSchema;
use App\Http\Schemas\Studio\Short\EditSchema;
use App\Http\Schemas\Studio\Short\IndexPageSchema;

use App\Support\DTOs\Short\CreateDTO;
use App\Support\DTOs\Short\EditDTO;
use App\Support\Factories\ViewContextFactory;
use App\Support\Helpers\UploadHelper;
use App\Support\Providers\FormOptionsProvider;
use App\Support\ViewModels\Studio\Short\CreatePageViewModel;
use App\Support\ViewModels\Studio\Short\EditPageViewModel;
use App\Support\ViewModels\Studio\Short\IndexPageViewModel;


#[Prefix("/studio/shorts")]
#[Authenticated]
class ShortController extends Controller
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
        $result = $this->studioService->getShortsPage($auth, $page);

        // View model döndür
        return $response->view("/studio/shorts/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                shorts: $result->shorts,
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
        $filePath = $this->uploadHelper->move($file, $auth->channel->code, "short", "file_{$timestamp}.{$file->extension()}");
        $thumbnailPath = $thumbnail
            ? $this->uploadHelper->move($thumbnail, $auth->channel->code, "short", "thumbnail_{$timestamp}.{$thumbnail->extension()}")
            : null;

        // Servisi çağır
        $this->studioService->createShort(new CreateDTO(
            title: $title,
            description: $description,
            viewType: ViewType::from($viewType),
            commentType: CommentType::from($commentType),
            filePath: $filePath,
            thumbnailPath: $thumbnailPath,
        ), $auth);

        // Kısa videolarım sayfasına geri yönlendir
        return $response->redirect("/studio/shorts");
    }

    #[Get("/{shortCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $shortCode = $request->param("shortCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $short = $this->studioService->getShortEdit($shortCode, $auth);

        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // Kısa video verilerini varsayılan değer olarak al, önceki form değerlerini koru
        $values["body"] = array_merge($short, $values["body"] ?? []); // @phpstan-ignore nullCoalesce.offset

        // View döndür
        return $response->view("/studio/shorts/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->media(),
                deleteUrl: "/studio/shorts/{$shortCode}/delete",
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{shortCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $shortCode = $request->param("shortCode", "");
        $title = $request->post("title", "");
        $description = $request->post("description", "");
        $viewType = $request->post("viewType", "");
        $commentType = $request->post("commentType", "");
        $transcript = $request->post("transcript", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Kısa videoyu güncelle
        $this->studioService->updateShort($shortCode, new EditDTO(
            title: $title,
            description: $description,
            viewType: ViewType::from($viewType),
            commentType: CommentType::from($commentType),
            transcript: $transcript,
        ), $auth);

        // Yönlendir
        return $response->redirect("/studio/shorts");
    }

    #[Post("/{shortCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $shortCode = $request->param("shortCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $this->studioService->deleteShort($shortCode, $auth);

        // Kısa videolarım sayfasına geri yönlendir
        return $response->redirect("/studio/shorts");
    }

    #[Post("/{shortCode}/change-thumbnail")]
    #[Schema(ChangeThumbnailSchema::class)]
    public function ChangeThumbnail(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $shortCode = $request->param("shortCode", "");

        // Dosyaları al
        $thumbnail = $request->file("thumbnail");
        assert($thumbnail !== null); // thumbnail zorunlu alan, null olamaz

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Timestamp bilgisini al
        $timestamp = time();

        // Dosyaları taşı
        $thumbnailPath = $this->uploadHelper->move($thumbnail, $auth->channel->code, "short", "thumbnail_{$timestamp}.{$thumbnail->extension()}");

        // Servisi çağır
        $this->studioService->changeVideoThumbnail($shortCode, $thumbnailPath, $auth);

        // Yönlendir
        return $response->redirect("/studio/shorts");
    }
}
