<?php
// ============================================================================
// File:    TestCase.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Tests\Feature;


use Seymenkonuk\Framework\Application;
use Seymenkonuk\Framework\Testing\TestCase as FrameworkTestCase;


class TestCase extends FrameworkTestCase
{
    protected function application(): Application
    {
        return require dirname(__DIR__, 2) . "/bootstrap/app.php";
    }
}
