<?php
// ============================================================================
// File:    NumberHelperTest.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Tests;


use PHPUnit\Framework\TestCase;

use App\Support\Helpers\NumberHelper;


class NumberHelperTest extends TestCase
{

    public function test_truncate_number(): void
    {
        $numberHelper = new NumberHelper();

        $this->assertEquals(3.14, $numberHelper->truncate(3.1459, 2));
        $this->assertEquals(12.89, $numberHelper->truncate(12.8999, 2));
        $this->assertEquals(5.5, $numberHelper->truncate(5.555, 1));
        $this->assertEquals(1.9, $numberHelper->truncate(1.99, 1));
        $this->assertEquals(4.0, $numberHelper->truncate(4.99, 0));
        $this->assertEquals(2.5, $numberHelper->truncate(2.5, 2));
    }

    public function test_format_number(): void
    {
        $numberHelper = new NumberHelper();

        $this->assertSame('1Mlr', $numberHelper->formatNumber(1000000000));
        $this->assertSame('1Mlr', $numberHelper->formatNumber(1110000000, 0));
        $this->assertSame('1.1Mlr', $numberHelper->formatNumber(1110000000, 1));

        $this->assertSame('1Mn', $numberHelper->formatNumber(1000001, 0));
        $this->assertSame('1Mn', $numberHelper->formatNumber(1000001, 1));
        $this->assertSame('1Mn', $numberHelper->formatNumber(1100001, 0));
        $this->assertSame('1.1Mn', $numberHelper->formatNumber(1100001, 1));
        $this->assertSame('999Mn', $numberHelper->formatNumber(999999999, 0));
        $this->assertSame('999.9Mn', $numberHelper->formatNumber(999999999, 1));

        $this->assertSame('1B', $numberHelper->formatNumber(1001, 0));
        $this->assertSame('1B', $numberHelper->formatNumber(1001, 1));
        $this->assertSame('1B', $numberHelper->formatNumber(1101, 0));
        $this->assertSame('1.1B', $numberHelper->formatNumber(1101, 1));
        $this->assertSame('999B', $numberHelper->formatNumber(999999, 0));
        $this->assertSame('999.9B', $numberHelper->formatNumber(999999, 1));

        $this->assertSame('178', $numberHelper->formatNumber(178, 0));
    }
}
