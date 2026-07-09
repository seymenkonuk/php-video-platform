<?php
// ============================================================================
// File:    BaseViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


use App\Support\DTOs\AuthDTO;


class BaseViewModel
{
    public string $brandName;
    public string $csrfToken;
    public string $dateYear;
    public ?AuthDTO $auth;

    public function __construct()
    {
        $brandName = getenv("APP_NAME");
        $csrfToken = "";    // Gerçek Değeri Al
        $dateYear = date("Y");
        $auth = null;       // Gerçek Değeri Al
    }
}
