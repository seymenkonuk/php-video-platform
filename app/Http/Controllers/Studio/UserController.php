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

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;


#[Prefix("/studio/users")]
class UserController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/{userCode}/edit")]
    public function EditPage(string $userCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{userCode}/edit")]
    public function Edit(string $userCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{userCode}/delete")]
    public function Delete(string $userCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Get("/{userCode}/change-password")]
    public function ChangePasswordPage(string $userCode): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/{userCode}/change-password")]
    public function ChangePassword(string $userCode): Response
    {
        return $this->response->redirect("/");
    }

    #[Post("/{userCode}/active-channel")]
    public function ChangeActiveChannel(string $userCode): Response
    {
        return $this->response->redirect("/");
    }
}
