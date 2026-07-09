<?php
// ============================================================================
// File:    TimeHelperTest.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Tests;


use DateTime;

use PHPUnit\Framework\TestCase;

use App\Support\Helpers\TimeHelper;


class TimeHelperTest extends TestCase
{

    public function test_format_duration(): void
    {
        $this->assertSame('0sn', TimeHelper::formatDuration(0));
        $this->assertSame('59sn', TimeHelper::formatDuration(59));
        $this->assertSame('1dk', TimeHelper::formatDuration(60));
        $this->assertSame('1dk 1sn', TimeHelper::formatDuration(61));
        $this->assertSame('1s', TimeHelper::formatDuration(3600));
        $this->assertSame('1s 1sn', TimeHelper::formatDuration(3601));
        $this->assertSame('1s 1dk 1sn', TimeHelper::formatDuration(3661));
    }

    public function test_format_timer(): void
    {
        $this->assertSame('00:00', TimeHelper::formatTimer(0));
        $this->assertSame('00:59', TimeHelper::formatTimer(59));
        $this->assertSame('01:00', TimeHelper::formatTimer(60));
        $this->assertSame('01:01', TimeHelper::formatTimer(61));
        $this->assertSame('59:59', TimeHelper::formatTimer(3599));
        $this->assertSame('01:00:00', TimeHelper::formatTimer(3600));
        $this->assertSame('01:01:01', TimeHelper::formatTimer(3661));
    }

    public function test_time_ago_accepts_datetime(): void
    {
        $date = new DateTime('-5 minutes');

        $result = TimeHelper::timeAgo($date);

        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }

    public function test_time_ago_accepts_string(): void
    {
        $date = date('Y-m-d H:i:s', strtotime('-2 hours'));

        $result = TimeHelper::timeAgo($date);

        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }
}
