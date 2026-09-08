<?php
// ============================================================================
// File:    AuthController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Attribute\Auth\AnonymousOnly;
use Seymenkonuk\Framework\Attribute\Auth\Authenticated;
use Seymenkonuk\Framework\Attribute\Route\Get;
use Seymenkonuk\Framework\Attribute\Route\Post;
use Seymenkonuk\Framework\Attribute\Schema;
use Seymenkonuk\Framework\Flash\IFlash;
use Seymenkonuk\Framework\Http\Controller;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Http\Schemas\Auth\LoginPageSchema;
use App\Http\Schemas\Auth\LoginSchema;
use App\Http\Schemas\Auth\LogoutSchema;
use App\Http\Schemas\Auth\RegisterPageSchema;
use App\Http\Schemas\Auth\RegisterSchema;

use App\Support\Factories\ViewContextFactory;
use App\Support\Providers\FormOptionsProvider;
use App\Support\ViewModels\Auth\LoginPageViewModel;
use App\Support\ViewModels\Auth\RegisterPageViewModel;


#[AnonymousOnly]
class AuthController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected FormOptionsProvider $formOptionsProvider,
        protected IFlash $flash,
    ) {}

    #[Get("/register")]
    #[Schema(RegisterPageSchema::class)]
    public function RegisterPage(IRequest $request, IResponse $response): IResponse
    {
        /** @var string */
        $redirectUri = $request->query("redirectUri") ?? "";
        $loginUri = $redirectUri !== "" ? "/login?redirectUri=$redirectUri" : "/login";
        $registerUri = $redirectUri !== "" ? "/register?redirectUri=$redirectUri" : "/register";

        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        return $response->view("/register/index", [
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
    public function Register(IResponse $response): IResponse
    {
        return $response->redirect("/register");
    }

    #[Get("/login")]
    #[Schema(LoginPageSchema::class)]
    public function LoginPage(IRequest $request, IResponse $response): IResponse
    {
        /** @var string */
        $redirectUri = $request->query("redirectUri") ?? "";
        $loginUri = $redirectUri !== "" ? "/login?redirectUri=$redirectUri" : "/login";
        $registerUri = $redirectUri !== "" ? "/register?redirectUri=$redirectUri" : "/register";

        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        return $response->view("/login/index", [
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
    public function Login(IResponse $response): IResponse
    {
        return $response->redirect("/login");
    }

    #[Post("/logout")]
    #[Schema(LogoutSchema::class)]
    #[Authenticated]
    public function Logout(IResponse $response): IResponse
    {
        return $response->redirect("/");
    }
}
