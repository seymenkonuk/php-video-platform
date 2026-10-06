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
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Domain\Services\Abstract\IAuthService;
use App\Domain\Services\Abstract\IStudioService;

use App\Http\Schemas\Studio\User\ChangeActiveChannelSchema;
use App\Http\Schemas\Studio\User\ChangePasswordPageSchema;
use App\Http\Schemas\Studio\User\ChangePasswordSchema;
use App\Http\Schemas\Studio\User\DeleteSchema;
use App\Http\Schemas\Studio\User\EditPageSchema;
use App\Http\Schemas\Studio\User\EditSchema;

use App\Support\DTOs\User\EditDTO;
use App\Support\Factories\ViewContextFactory;
use App\Support\Providers\FormOptionsProvider;
use App\Support\ViewModels\Studio\User\ChangePasswordPageViewModel;
use App\Support\ViewModels\Studio\User\EditPageViewModel;


#[Prefix("/studio/users")]
#[Authenticated]
class UserController extends Controller
{
    // --------------------------------------------------------------------------
    // DEPENDENCIES
    // --------------------------------------------------------------------------

    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected FormOptionsProvider $formOptionsProvider,
        protected IAuthService $authService,
        protected IStudioService $studioService,
        protected IFlash $flash,
    ) {}

    // --------------------------------------------------------------------------
    // ACTIONS
    // --------------------------------------------------------------------------

    #[Get("/{userCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $userCode = $request->param("userCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $user = $this->studioService->getUserEdit($userCode, $auth);

        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // Kullanıcı verilerini varsayılan değer olarak al, önceki form değerlerini koru
        $values["body"] = array_merge($user, $values["body"] ?? []); // @phpstan-ignore nullCoalesce.offset

        // View döndür
        return $response->view("/studio/users/[id]/edit/index", [
            "model" => new EditPageViewModel(
                context: $this->viewContextFactory->studio(),
                options: $this->formOptionsProvider->countries(),
                deleteUrl: "/studio/users/{$userCode}/delete",
                errorMessages: $errors,
                defaultValues: $values,
            ),
        ]);
    }

    #[Post("/{userCode}/edit")]
    #[Schema(EditSchema::class)]
    public function Edit(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $userCode = $request->param("userCode", "");
        $name = $request->post("name", "");
        $surname = $request->post("surname", "");
        $country = $request->post("country", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Kullanıcıyı al (mevcutluk kontrolü ve yetki kontrolü)
        $user = $this->studioService->getUserEdit($userCode, $auth);

        // Kullanıcıyı güncelle
        $this->studioService->updateUser($userCode, new EditDTO(
            name: $name,
            surname: $surname,
            username: $user["username"], // @phpstan-ignore argument.type
            email: $user["email"], // @phpstan-ignore argument.type
            country: $country,
        ), $auth);

        // Yönlendir
        return $response->redirect("/studio");
    }

    #[Post("/{userCode}/delete")]
    #[Schema(DeleteSchema::class)]
    public function Delete(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $userCode = $request->param("userCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $this->studioService->deleteUser($userCode, $auth);
        $this->authService->logout();

        // Ana sayfaya yönlendir
        return $response->redirect("/");
    }

    #[Get("/{userCode}/change-password")]
    #[Schema(ChangePasswordPageSchema::class)]
    public function ChangePasswordPage(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $userCode = $request->param("userCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $user = $this->studioService->getUserEdit($userCode, $auth);

        // Bir önceki istekten kalan hata mesajlarını ve otomatik tamamlamaları al
        $errors = $this->flash->get("errors", []);
        $values = $this->flash->get("values", []);

        // Kullanıcı verilerini varsayılan değer olarak al, önceki form değerlerini koru
        $values["body"] = array_merge($user, $values["body"] ?? []); // @phpstan-ignore nullCoalesce.offset

        // View döndür
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
    public function ChangePassword(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $userCode = $request->param("userCode", "");
        $oldPassword = $request->post("oldPassword", "");
        $newPassword = $request->post("newPassword", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Kullanıcıyı al (mevcutluk kontrolü ve yetki kontrolü)
        $this->studioService->getUserEdit($userCode, $auth);

        // Kullanıcıyı güncelle
        $this->studioService->changeUserPassword($userCode, $oldPassword, $newPassword, $auth);

        // Yönlendir
        return $response->redirect("/studio");
    }

    #[Post("/active-channel")]
    #[Schema(ChangeActiveChannelSchema::class)]
    public function ChangeActiveChannel(IRequest $request, IResponse $response): IResponse
    {
        // İsteği al
        $channelCode = $request->post("channelCode", "");

        // Auth bilgisini al
        $auth = $this->authService->auth();
        assert($auth !== null); // authenticated endpoint, null olamaz

        // Servisi çağır
        $this->studioService->changeActiveChannel($channelCode, $auth);

        // Yönlendir
        return $response->redirect("/studio/channels");
    }
}
