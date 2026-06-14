<?php
// ============================================================================
// File:    NotificationController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Http\Controllers;


use Seymenkonuk\Framework\Controller;
use Seymenkonuk\Framework\Response;

use Seymenkonuk\Framework\Attribute\Prefix;
use Seymenkonuk\Framework\Attribute\Route\Get;


#[Prefix("/notifications")]
class NotificationController extends Controller
{
    public function __construct(
        protected Response $response,
    ) {}

    #[Get("/subscribe")]
    public function Subscribe(): Response
    {
        return $this->response->html("<p>VideoPlatform</p>");
    }
}
