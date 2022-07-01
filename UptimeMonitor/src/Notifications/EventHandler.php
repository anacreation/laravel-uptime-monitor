<?php

namespace Spatie\UptimeMonitor\Notifications;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Spatie\UptimeMonitor\Events\CertificateCheckFailed;
use Spatie\UptimeMonitor\Events\CertificateCheckSucceeded;
use Spatie\UptimeMonitor\Events\CertificateExpiresSoon;
use Spatie\UptimeMonitor\Events\UptimeCheckFailed;
use Spatie\UptimeMonitor\Events\UptimeCheckRecovered;
use Spatie\UptimeMonitor\Events\UptimeCheckSucceeded;

class EventHandler
{
    /** @var \Illuminate\Config\Repository */
    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function subscribe(Dispatcher $events): void
    {

        $events->listen($this->allEventClasses(), function ($event) {

            if ($event->isStillRelevant() and
                ($mailable = $this->determineMailable($event))) {

                $emails = $event->monitor->emails()->active()->get()->map->address;

                Mail::to($emails)
                    ->send($mailable);
            }

        });
    }

    protected function determineMailable($event): ?Mailable
    {

        $mailableName = collect($this->config->get('uptime-monitor.notifications.mailables'))
            ->filter(fn(?string $mailableName) => !empty($mailableName))
            ->first(fn($mailableName, $eventClass) => $eventClass === $event::class);

        return $mailableName ?
            new $mailableName($event) :
            null;
    }

    protected function allEventClasses(): array
    {
        return [
            UptimeCheckFailed::class,
            UptimeCheckSucceeded::class,
            UptimeCheckRecovered::class,
            CertificateCheckSucceeded::class,
            CertificateCheckFailed::class,
            CertificateExpiresSoon::class,
        ];
    }
}
