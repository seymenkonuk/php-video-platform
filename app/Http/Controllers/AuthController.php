<?php
// ============================================================================
// File:    AuthController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use App\Http\Schemas\Auth\RegisterPageSchema;
use App\Http\Schemas\Auth\RegisterSchema;
use App\Http\Schemas\Auth\LoginPageSchema;
use App\Http\Schemas\Auth\LoginSchema;
use App\Http\Schemas\Auth\LogoutSchema;

use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;


class AuthController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/register")]
    #[Schema(RegisterPageSchema::class)]
    public function RegisterPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/register")]
    #[Schema(RegisterSchema::class)]
    public function Register(): Response
    {
        return $this->response->redirect("/register");
    }

    #[Get("/login")]
    #[Schema(LoginPageSchema::class)]
    public function LoginPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/login")]
    #[Schema(LoginSchema::class)]
    public function Login(): Response
    {
        return $this->response->redirect("/login");
    }

    #[Post("/logout")]
    #[Schema(LogoutSchema::class)]
    public function Logout(): Response
    {
        return $this->response->redirect("/");
    }
}
