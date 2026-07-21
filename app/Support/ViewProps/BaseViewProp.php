<?php
// ============================================================================
// File:    BaseViewProp.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\ViewProps;


abstract readonly class BaseViewProp
{
    /** @return array<mixed> */
    final public function values(): array
    {
        return get_object_vars($this);
    }
}
