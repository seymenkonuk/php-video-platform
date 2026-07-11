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
    public ?AuthDTO $auth = null;

    public function __construct()
    {
        $this->brandName = getenv("APP_NAME");
        $this->csrfToken = "";    // Gerçek Değeri Al
        $this->dateYear = date("Y");
        $this->auth = null;       // Gerçek Değeri Al
    }
}
