<?php
// ============================================================================
// File:    UserController.php
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

use App\Http\Schemas\Studio\User\EditPageSchema;
use App\Http\Schemas\Studio\User\EditSchema;
use App\Http\Schemas\Studio\User\DeleteSchema;
use App\Http\Schemas\Studio\User\ChangePasswordPageSchema;
use App\Http\Schemas\Studio\User\ChangePasswordSchema;
use App\Http\Schemas\Studio\User\ChangeActiveChannelSchema;

use App\Support\ViewModels\Studio\User\EditPageViewModel;
use App\Support\ViewModels\Studio\User\ChangePasswordPageViewModel;


#[Prefix("/studio/users")]
class UserController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/{userCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(string $userCode): Response
    {
        return $this->response->view("/studio/users/[id]/edit/index", [
            "model" => new EditPageViewModel("/studio/users/1/delete", [], []),
        ]);
    }

    #[Post("/{userCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(string $userCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{userCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(string $userCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Get("/{userCode}/change-password")]
    #[Schema(ChangePasswordPageSchema::class)]
    public function ChangePasswordPage(string $userCode): Response
    {
        return $this->response->view("/studio/users/[id]/change-password/index", [
            "model" => new ChangePasswordPageViewModel([], []),
        ]);
    }

    #[Post("/{userCode}/change-password")]
    #[Schema(ChangePasswordSchema::class)]
    public function ChangePassword(string $userCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{userCode}/active-channel")]
    #[Schema(ChangeActiveChannelSchema::class)]
    public function ChangeActiveChannel(string $userCode): Response
    {
        return $this->response->redirect("/");
    }
}
