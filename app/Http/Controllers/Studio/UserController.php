<?php
// ============================================================================
// File:    UserController.php
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
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Schemas\Studio\User\ChangeActiveChannelSchema;
use App\Http\Schemas\Studio\User\ChangePasswordPageSchema;
use App\Http\Schemas\Studio\User\ChangePasswordSchema;
use App\Http\Schemas\Studio\User\DeleteSchema;
use App\Http\Schemas\Studio\User\EditPageSchema;
use App\Http\Schemas\Studio\User\EditSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\Providers\FormOptionsProvider;
use App\Support\ViewModels\Studio\User\ChangePasswordPageViewModel;
use App\Support\ViewModels\Studio\User\EditPageViewModel;


#[Prefix("/studio/users")]
#[Authenticated]
class UserController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected FormOptionsProvider $formOptionsProvider,
        protected IFlash $flash,
    ) {}

    #[Get("/{userCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(IResponse $response): IResponse
    {
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        return $response->view("/studio/users/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->countries(),
                deleteUrl: "/studio/users/1/delete",
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{userCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }

    #[Post("/{userCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }

    #[Get("/{userCode}/change-password")]
    #[Schema(ChangePasswordPageSchema::class)]
    public function ChangePasswordPage(IResponse $response): IResponse
    {
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        return $response->view("/studio/users/[id]/change-password/index", [
            "model" => new ChangePasswordPageViewModel(
                context: $this->viewContextFactory->studio(),
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{userCode}/change-password")]
    #[Schema(ChangePasswordSchema::class)]
    public function ChangePassword(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }

    #[Post("/{userCode}/active-channel")]
    #[Schema(ChangeActiveChannelSchema::class)]
    public function ChangeActiveChannel(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }
}
