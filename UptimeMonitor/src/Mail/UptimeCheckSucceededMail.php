<?php

namespace Spatie\UptimeMonitor\Mail;

use App\Models\Monitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\UptimeMonitor\Events\UptimeCheckSucceeded;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;

class UptimeCheckSucceededMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public UptimeCheckSucceeded $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UptimeCheckSucceeded $event)
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
        return $this->view('uptime-monitor::emails.uptime-check-succeeded')
            ->subject($this->event->monitor->url.' is up');
    }
}
