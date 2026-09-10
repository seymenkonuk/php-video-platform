<?php
// ============================================================================
// File:    exceptions.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


use Seymenkonuk\Framework\Application;
use Seymenkonuk\Framework\Exception\AlreadyAuthenticatedException;
use Seymenkonuk\Framework\Exception\AuthenticationRequiredException;
use Seymenkonuk\Framework\Exception\FileNotFoundException;
use Seymenkonuk\Framework\Exception\RouteNotFoundException;
use Seymenkonuk\Framework\Exception\ValidationException;
use Seymenkonuk\Framework\Flash\IFlash;
use Seymenkonuk\Framework\Http\Exception\AuthorizationException;
use Seymenkonuk\Framework\Http\Exception\NotFoundException;
use Seymenkonuk\Framework\Http\Request\IRequest;
use Seymenkonuk\Framework\Http\Response\IResponse;

use App\Support\Factories\ErrorViewModelFactory;


return function (Application $app) {
    // Authentication Exceptions
    $app->withException(function (AuthenticationRequiredException $exception, IRequest $request, IResponse $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(401, [
            "model" => $errorViewModelFactory->unauthorized(),
        ])->redirect("/login?redirectUri=" . $request->path());
    });
    $app->withException(function (AlreadyAuthenticatedException $exception, IRequest $request, IResponse $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->badRequest()->redirect("/");
    });
    // Authorization Exceptions
    $app->withException(function (AuthorizationException $exception, IResponse $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(403, [
            "model" => $errorViewModelFactory->forbidden(),
        ]);
    });
    // Not Found Exceptions
    $app->withException(function (NotFoundException|RouteNotFoundException|FileNotFoundException $exception, IResponse $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(404, [
            "model" => $errorViewModelFactory->notFound(),
        ]);
    });
    // Validation Exceptions
    $app->withException(function (ValidationException $exception, IRequest $request, IFlash $flash, IResponse $response, ErrorViewModelFactory $errorViewModelFactory) {
        // POST isteklerinde; 
        // Hataları Flash'a Ekle
        // GET sayfasına yönlendir (PRG: Post Redirect Get)
        if ($request->method() === "POST") {
            $flash->set("errors", $exception->errors());
            $flash->set("values", $request->all());
            $response->redirect($request->path());
        }
        // Tüm İsteklerde Abort 400
        return $response->abort(400, [
            "model" => $errorViewModelFactory->badRequest(),
        ]);
    });
    // Other Exceptions
    $app->withException(function (Throwable $exception, IResponse $response, ErrorViewModelFactory $errorViewModelFactory) {
        return $response->abort(500, [
            "model" => $errorViewModelFactory->serverError(),
        ]);
    });
};
