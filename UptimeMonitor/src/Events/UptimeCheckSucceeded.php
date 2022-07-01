<?php

namespace Spatie\UptimeMonitor\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;
use Spatie\UptimeMonitor\Models\Monitor;

class UptimeCheckSucceeded extends BaseEvent
{
    public Monitor $monitor;

    public function __construct(Monitor $monitor)
    {
        $this->monitor = $monitor;
    }

    public function isStillRelevant(): bool
    {
        return $this->getMonitor()->uptime_status != UptimeStatus::DOWN;
    }

}
