<?php
// ============================================================================
// File:    app.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================


use Seymenkonuk\Framework\Application;


$app = new Application();

(require __DIR__ . "/container.php")($app);
(require __DIR__ . "/exceptions.php")($app);
(require __DIR__ . "/routes.php")($app);

return $app;
