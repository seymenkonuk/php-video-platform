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
use Seymenkonuk\Framework\Session;
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

use App\Support\Factories\ViewContextFactory;

use App\Support\Providers\FormOptionsProvider;

use App\Support\ViewModels\Studio\User\EditPageViewModel;
use App\Support\ViewModels\Studio\User\ChangePasswordPageViewModel;


#[Prefix("/studio/users")]
class UserController extends Controller
{
    public function __construct(
        protected ViewContextFactory $viewContextFactory,
        protected FormOptionsProvider $formOptionsProvider,
        protected Session $session,
        protected Response $response,
    ) {}

    #[Get("/{userCode}/edit")]
    #[Schema(EditPageSchema::class)]
    public function EditPage(string $userCode): Response
    {
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

        return $this->response->view("/studio/users/[id]/edit/index", [
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

        return $this->response->view("/studio/users/[id]/change-password/index", [
            "model" => new ChangePasswordPageViewModel(
                context: $this->viewContextFactory->studio(),
                errorMessages: $errors,
                defaultValues: $values,
            ),
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
