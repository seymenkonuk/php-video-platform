<?php
// ============================================================================
// File:    TimeHelperTest.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Tests\Unit\Support;


use DateTime;

use PHPUnit\Framework\TestCase;

use App\Support\Helpers\TimeHelper;


class TimeHelperTest extends TestCase
{

    public function test_format_duration(): void
    {
        $timeHelper = new TimeHelper();

        $this->assertSame('0sn', $timeHelper->formatDuration(0));
        $this->assertSame('59sn', $timeHelper->formatDuration(59));
        $this->assertSame('1dk', $timeHelper->formatDuration(60));
        $this->assertSame('1dk 1sn', $timeHelper->formatDuration(61));
        $this->assertSame('1s', $timeHelper->formatDuration(3600));
        $this->assertSame('1s 1sn', $timeHelper->formatDuration(3601));
        $this->assertSame('1s 1dk 1sn', $timeHelper->formatDuration(3661));
    }

    public function test_format_timer(): void
    {
        $timeHelper = new TimeHelper();

        $this->assertSame('00:00', $timeHelper->formatTimer(0));
        $this->assertSame('00:59', $timeHelper->formatTimer(59));
        $this->assertSame('01:00', $timeHelper->formatTimer(60));
        $this->assertSame('01:01', $timeHelper->formatTimer(61));
        $this->assertSame('59:59', $timeHelper->formatTimer(3599));
        $this->assertSame('01:00:00', $timeHelper->formatTimer(3600));
        $this->assertSame('01:01:01', $timeHelper->formatTimer(3661));
    }

    public function test_time_ago_accepts_datetime(): void
    {
        $date = new DateTime('-5 minutes');

        $timeHelper = new TimeHelper();
        $result = $timeHelper->timeAgo($date);

        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }

    public function test_time_ago_accepts_string(): void
    {
        $date = date('Y-m-d H:i:s', strtotime('-2 hours'));

        $timeHelper = new TimeHelper();
        $result = $timeHelper->timeAgo($date);

        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }
}
