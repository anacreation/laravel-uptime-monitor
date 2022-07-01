<?php

namespace Spatie\UptimeMonitor\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\UptimeMonitor\Helpers\Period;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;
use Spatie\UptimeMonitor\Models\Monitor;

class UptimeCheckRecovered extends BaseEvent
{
    public Monitor $monitor;

    public Period $downtimePeriod;

    public function __construct(Monitor $monitor, Period $downtimePeriod)
    {
        $this->monitor = $monitor;

        $this->downtimePeriod = $downtimePeriod;
    }

    public function isStillRelevant(): bool
    {
        return $this->getMonitor()->uptime_status == UptimeStatus::UP;
    }
}
