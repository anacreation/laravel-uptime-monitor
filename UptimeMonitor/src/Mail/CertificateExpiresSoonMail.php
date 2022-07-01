<?php

namespace Spatie\UptimeMonitor\Mail;

use App\Models\Monitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Spatie\UptimeMonitor\Events\CertificateCheckFailed;
use Spatie\UptimeMonitor\Events\CertificateCheckSucceeded;
use Spatie\UptimeMonitor\Events\CertificateExpiresSoon;
use Spatie\UptimeMonitor\Events\UptimeCheckSucceeded;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;

class CertificateExpiresSoonMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public CertificateExpiresSoon $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CertificateExpiresSoon $event)
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
        return $this->view('uptime-monitor::emails.certificate-expires-soon')
            ->subject($this->event->monitor->url.' certificate expires soon');
    }
}
