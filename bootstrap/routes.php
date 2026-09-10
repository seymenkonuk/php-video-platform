<?php
// ============================================================================
// File:    routes.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


use Seymenkonuk\Framework\Application;

use Routes\WebRoutes;


return function (Application $app) {
    $app->withRouting(WebRoutes::class);
};
