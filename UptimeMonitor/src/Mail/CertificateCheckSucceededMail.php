<?php

namespace Spatie\UptimeMonitor\Mail;

use App\Models\Monitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\UptimeMonitor\Events\CertificateCheckSucceeded;
use Spatie\UptimeMonitor\Events\UptimeCheckSucceeded;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;

class CertificateCheckSucceededMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public CertificateCheckSucceeded $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CertificateCheckSucceeded $event)
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
        return $this->view('uptime-monitor::emails.certificate-check-succeeded')
            ->subject($this->event->monitor->url.' certificate is good');
    }
}
