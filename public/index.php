<?php
// ============================================================================
// File:    index.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

require_once(dirname(__DIR__) . "/vendor/autoload.php");


use Seymenkonuk\Framework\Http\Request\Request;


$app = require dirname(__DIR__) . "/bootstrap/app.php";

$app->run(Request::capture());
