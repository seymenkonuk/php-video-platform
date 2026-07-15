<?php
// ============================================================================
// File:    BaseViewModel.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewModels;


class BaseViewModel
{
    public string $brandName;
    public string $csrfToken;
    public string $dateYear;

    public function __construct()
    {
        /** @phpstan-ignore-next-line */
        $this->brandName = getenv("APP_NAME");
        $this->csrfToken = "";    // Gerçek Değeri Al
        $this->dateYear = date("Y");
    }
}
