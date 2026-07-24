<?php
// ============================================================================
// File:    ChannelController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers\Studio;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;

use App\Http\Schemas\Studio\Channel\IndexPageSchema;
use App\Http\Schemas\Studio\Channel\CreatePageSchema;
use App\Http\Schemas\Studio\Channel\CreateSchema;
use App\Http\Schemas\Studio\Channel\EditPageSchema;
use App\Http\Schemas\Studio\Channel\EditSchema;
use App\Http\Schemas\Studio\Channel\DeleteSchema;
use App\Http\Schemas\Studio\Channel\ChangeAvatarSchema;
use App\Http\Schemas\Studio\Channel\ChangeBannerSchema;

use App\Support\DTOs\UI\PaginationDTO;

use App\Support\Factories\ViewContextFactory;

use App\Support\ViewModels\Studio\Channel\IndexPageViewModel;
use App\Support\ViewModels\Studio\Channel\CreatePageViewModel;
use App\Support\ViewModels\Studio\Channel\EditPageViewModel;


#[Prefix("/studio/channels")]
class ChannelController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected Response $response,
    ) {}

    #[Get("/")]
    #[Schema(IndexPageSchema::class)]
    public function IndexPage(): Response
    {
        return $this->response->view("/studio/channels/index", [
            "model" => new IndexPageViewModel(
                context: $this->viewContextFactory->studio(),
                channels: (function () {
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
        return $this->response->view("/studio/channels/new/index", [
            "model" => new CreatePageViewModel(
                context: $this->viewContextFactory->studio(),
                errorMessages: [],
                defaultValues: [],
            ),
        ]);
    }

    #[Post("/new")]
    #[Schema(CreateSchema::class)]
    public function Create(): Response
    {
        return $this->response->redirect("/");
    }

    #[Get("/{channelCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(string $channelCode): Response
    {
        return $this->response->view("/studio/channels/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                channelCode: "1",
                deleteUrl: "/studio/channels/1/delete",
                changeActiveChannelUrl: "/studio/users/1/active-channel",
                isActive: true,
                errorMessages: [],
                defaultValues: [],
            ),
        ]);
    }

    #[Post("/{channelCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(string $channelCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{channelCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(string $channelCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{channelCode}/change-avatar")]
    #[Schema(ChangeAvatarSchema::class)]
    public function ChangeAvatar(string $channelCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{channelCode}/change-banner")]
    #[Schema(ChangeBannerSchema::class)]
    public function ChangeBanner(string $channelCode): Response
    {
        return $this->response->redirect("/");
    }
}
