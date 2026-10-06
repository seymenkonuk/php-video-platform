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

use App\Domain\Services\Abstract\IAuthService;

use App\Http\Schemas\Auth\LoginPageSchema;
use App\Http\Schemas\Auth\LoginSchema;
use App\Http\Schemas\Auth\LogoutSchema;
use App\Http\Schemas\Auth\RegisterPageSchema;
use App\Http\Schemas\Auth\RegisterSchema;

use App\Support\DTOs\User\CreateDTO;
use App\Support\Factories\ViewContextFactory;
use App\Support\Providers\FormOptionsProvider;
use App\Support\ViewModels\Auth\LoginPageViewModel;
use App\Support\ViewModels\Auth\RegisterPageViewModel;


#[AnonymousOnly]
class AuthController extends Controller
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected FormOptionsProvider $formOptionsProvider,
        protected IAuthService $authService,
        protected IFlash $flash,
    ) {}

    // --------------------------------------------------------------------------
    // ACTIONS
    // --------------------------------------------------------------------------

    #[Get("/register")]
    #[Schema(RegisterPageSchema::class)]
    public function RegisterPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        /** @var string */
        $redirectUri = $request->query("redirectUri") ?? "";

        // Redirect uri'leri hesapla
        $loginUri = $redirectUri !== "" ? "/login?redirectUri=$redirectUri" : "/login";
        $registerUri = $redirectUri !== "" ? "/register?redirectUri=$redirectUri" : "/register";

        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // View döndür
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
    public function Register(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $name = $request->post("name", "");
        $surname = $request->post("surname", "");
        $username = $request->post("username", "");
        $email = $request->post("email", "");
        $password = $request->post("password", "");
        $country = $request->post("country", "");

        // Servisi çağır
        $this->authService->register(new CreateDTO(
            name: $name,
            surname: $surname,
            username: $username,
            email: $email,
            password: $password,
            country: $country,
        ));

        // Kullanıcı adını otomatik doldur
        $this->flash->set("values", [
            "body" => [
                "username" => $username,
            ]
        ]);

        // Yönlendir
        /** @var string */
        $redirectUri = $request->query("redirectUri") ?? "";
        $loginUri = $redirectUri !== "" ? "/login?redirectUri=$redirectUri" : "/login";
        return $response->redirect($loginUri);
    }

    #[Get("/login")]
    #[Schema(LoginPageSchema::class)]
    public function LoginPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        /** @var string */
        $redirectUri = $request->query("redirectUri") ?? "";

        // Redirect uri'leri hesapla
        $loginUri = $redirectUri !== "" ? "/login?redirectUri=$redirectUri" : "/login";
        $registerUri = $redirectUri !== "" ? "/register?redirectUri=$redirectUri" : "/register";

        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // View döndür
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
    public function Login(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $username = $request->post("username", "");
        $password = $request->post("password", "");

        // Servisi çağır
        $this->authService->login($username, $password);

        // Yönlendir
        /** @var string */
        $redirectUri = $request->query("redirectUri", null) ?? "/";
        return $response->redirect($redirectUri);
    }

    #[Post("/logout")]
    #[Schema(LogoutSchema::class)]
    #[Authenticated]
    public function Logout(IResponse $response): IResponse
    {
        // Servisi çağır
        $this->authService->logout();

        // Ana sayfaya yönlendir
        return $response->redirect("/");
    }
}
