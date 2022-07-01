<?php

namespace Spatie\UptimeMonitor\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\UptimeMonitor\Events\UptimeCheckFailed;

class UptimeCheckFailedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public UptimeCheckFailed $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UptimeCheckFailed $event)
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
        return $this->view('uptime-monitor::emails.uptime-check-failed')
            ->subject($this->event->monitor->url.' is down');
    }
}
