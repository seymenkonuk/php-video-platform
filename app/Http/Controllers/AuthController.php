<?php
// ============================================================================
// File:    AuthController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;


class AuthController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/register")]
    public function RegisterPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/register")]
    public function Register(): Response
    {
        return $this->response->redirect("/register");
    }

    #[Get("/login")]
    public function LoginPage(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }

    #[Post("/login")]
    public function Login(): Response
    {
        return $this->response->redirect("/login");
    }

    #[Post("/logout")]
    public function Logout(): Response
    {
        return $this->response->redirect("/");
    }
}
