<?php
// ============================================================================
// File:    ChannelController.php
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

use App\Http\Schemas\Studio\Channel\ChangeAvatarSchema;
use App\Http\Schemas\Studio\Channel\ChangeBannerSchema;
use App\Http\Schemas\Studio\Channel\CreatePageSchema;
use App\Http\Schemas\Studio\Channel\CreateSchema;
use App\Http\Schemas\Studio\Channel\DeleteSchema;
use App\Http\Schemas\Studio\Channel\EditPageSchema;
use App\Http\Schemas\Studio\Channel\EditSchema;
use App\Http\Schemas\Studio\Channel\IndexPageSchema;

use App\Support\DTOs\AuthDTO;
use App\Support\DTOs\Channel\EditDTO;
use App\Support\Factories\ViewContextFactory;
use App\Support\ViewModels\Studio\Channel\CreatePageViewModel;
use App\Support\ViewModels\Studio\Channel\EditPageViewModel;
use App\Support\ViewModels\Studio\Channel\IndexPageViewModel;


#[Prefix("/studio/channels")]
#[Authenticated]
class ChannelController extends Controller
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected ViewContextFactory $viewContextFactory,
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
        $result = $this->studioService->getChannelsPage($auth, $page);

        // View döndür
        return $response->view("/studio/channels/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                channels: $result->channels,
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

        return $response->view("/studio/channels/new/index", [
            "model" => new CreatePageViewModel(
                context: $this->viewContextFactory->studio(),
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

    #[Get("/{channelCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $channelCode = $request->param("channelCode", "");
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $channel = $this->studioService->getChannelEdit($channelCode, $auth);

        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // Kanal verilerini varsayılan değer olarak al, önceki form değerlerini koru
        $values["body"] = array_merge($channel, $values["body"] ?? []); // @phpstan-ignore nullCoalesce.offset

        // View döndür
        return $response->view("/studio/channels/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                channelCode: $channelCode,
                deleteUrl: "/studio/channels/{$channelCode}/delete",
                changeActiveChannelUrl: "/studio/users/{$auth->user->code}/active-channel",
                isActive: $auth->channel->code === $channelCode,
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{channelCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $channelCode = $request->param("channelCode", "");
        $name = $request->post("name", "");
        $title = $request->post("title", "");
        $description = $request->post("description", "");
        $twitterUrl = $request->post("twitterUrl", "");
        $instagramUrl = $request->post("instagramUrl", "");
        $facebookUrl = $request->post("facebookUrl", "");
        $linkedinUrl = $request->post("linkedinUrl", "");
        $githubUrl = $request->post("githubUrl", "");
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $this->studioService->updateChannel($channelCode, new EditDTO(
            name: $name,
            title: $title,
            description: $description,
            instagramUrl: $instagramUrl,
            twitterUrl: $twitterUrl,
            facebookUrl: $facebookUrl,
            linkedinUrl: $linkedinUrl,
            githubUrl: $githubUrl,
        ), $auth);

        // Yönlendir
        return $response->redirect("/studio/channels");
    }

    #[Post("/{channelCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $channelCode = $request->param("channelCode", "");
        /** @var AuthDTO */
        $auth = $this->authService->auth();

        // Servisi çağır
        $this->studioService->deleteChannel($channelCode, $auth);

        // Kanallarım sayfasına geri yönlendir
        return $response->redirect("/studio/channels");
    }

    #[Post("/{channelCode}/change-avatar")]
    #[Schema(ChangeAvatarSchema::class)]
    public function ChangeAvatar(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }

    #[Post("/{channelCode}/change-banner")]
    #[Schema(ChangeBannerSchema::class)]
    public function ChangeBanner(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }
}
