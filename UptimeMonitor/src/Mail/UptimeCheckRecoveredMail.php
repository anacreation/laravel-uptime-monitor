<?php

namespace Spatie\UptimeMonitor\Mail;

use App\Models\Monitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\UptimeMonitor\Events\UptimeCheckRecovered;
use Spatie\UptimeMonitor\Events\UptimeCheckSucceeded;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;

class UptimeCheckRecoveredMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public UptimeCheckRecovered $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UptimeCheckRecovered $event)
    {

        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('uptime-monitor::emails.uptime-check-recovered')
            ->subject($this->event->monitor->url.' is recovered');
    }
}
