<?php
// ============================================================================
// File:    AuthController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Request;
use Seymenkonuk\Framework\Session;
use Seymenkonuk\Framework\Response;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;

use App\Http\Schemas\Auth\RegisterPageSchema;
use App\Http\Schemas\Auth\RegisterSchema;
use App\Http\Schemas\Auth\LoginPageSchema;
use App\Http\Schemas\Auth\LoginSchema;
use App\Http\Schemas\Auth\LogoutSchema;

use App\Support\Factories\ViewContextFactory;

use App\Support\Providers\FormOptionsProvider;

use App\Support\ViewModels\Auth\RegisterPageViewModel;
use App\Support\ViewModels\Auth\LoginPageViewModel;


class AuthController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected FormOptionsProvider $formOptionsProvider,
        protected Request $request,
        protected Session $session,
        protected Response $response,
    ) {}

    #[Get("/register")]
    #[Schema(RegisterPageSchema::class)]
    public function RegisterPage(): Response
    {
        /** @var string $redirectUri */
        $redirectUri = $this->request->query("redirectUri", "");
        $loginUri = $redirectUri !== "" ? "/login?redirectUri=$redirectUri" : "/login";
        $registerUri = $redirectUri !== "" ? "/register?redirectUri=$redirectUri" : "/register";
        /** @var array{
         *     body?: array<string, mixed>,
         *     query?: array<string, mixed>,
         *     params?: array<string, mixed>,
         *     files?: array<string, mixed>,
         * } $errors */
        $errors = $this->session->getFlash("errors", []);
        /** @var array{
         *     body?: array<string, mixed>,
         *     query?: array<string, mixed>,
         *     params?: array<string, mixed>,
         *     files?: array<string, mixed>,
         * } $values */
        $values = $this->session->getFlash("values", []);

        return $this->response->view("/register/index", [
            "model" => new RegisterPageViewModel(
                context: $this->viewContextFactory->auth(),
                options: $this->formOptionsProvider->countries(),
                loginUri: $loginUri,
                registerUri: $registerUri,
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
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
        /** @var string $redirectUri */
        $redirectUri = $this->request->query("redirectUri", "");
        $loginUri = $redirectUri !== "" ? "/login?redirectUri=$redirectUri" : "/login";
        $registerUri = $redirectUri !== "" ? "/register?redirectUri=$redirectUri" : "/register";
        /** @var array{
         *     body?: array<string, mixed>,
         *     query?: array<string, mixed>,
         *     params?: array<string, mixed>,
         *     files?: array<string, mixed>,
         * } $errors */
        $errors = $this->session->getFlash("errors", []);
        /** @var array{
         *     body?: array<string, mixed>,
         *     query?: array<string, mixed>,
         *     params?: array<string, mixed>,
         *     files?: array<string, mixed>,
         * } $values */
        $values = $this->session->getFlash("values", []);

        return $this->response->view("/login/index", [
            "model" => new LoginPageViewModel(
                context: $this->viewContextFactory->auth(),
                loginUri: $loginUri,
                registerUri: $registerUri,
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
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
