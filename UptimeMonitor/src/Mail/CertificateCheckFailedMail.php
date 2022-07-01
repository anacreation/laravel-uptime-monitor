<?php

namespace Spatie\UptimeMonitor\Mail;

use App\Models\Monitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\UptimeMonitor\Events\CertificateCheckFailed;
use Spatie\UptimeMonitor\Events\CertificateCheckSucceeded;
use Spatie\UptimeMonitor\Events\UptimeCheckSucceeded;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;

class CertificateCheckFailedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public CertificateCheckFailed $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CertificateCheckFailed $event)
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
        return $this->view('uptime-monitor::emails.certificate-check-failed')
            ->subject($this->event->monitor->url.' certificate check is failed');
    }
}
