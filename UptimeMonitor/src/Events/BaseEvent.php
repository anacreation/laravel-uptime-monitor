<?php

namespace Spatie\UptimeMonitor\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;
use Spatie\UptimeMonitor\Models\Monitor;

abstract class BaseEvent implements ShouldQueue
{
    public function getMonitor(): Monitor
    {
        return $this->monitor;
    }

    public function isStillRelevant(): bool
    {
        return true;
    }

}
