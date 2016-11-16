<?php

namespace Spatie\UptimeMonitor\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\SslCertificate\SslCertificate;
use Spatie\UptimeMonitor\Models\Monitor;

class InvalidSslCertificateFound implements ShouldQueue
{
    /** @var \Spatie\UptimeMonitor\Models\Monitor */
    public $monitor;

    /** @var string */
    public $reason;

    /** @var \Spatie\SslCertificate\SslCertificate|null */
    public $certificate;

    public function __construct(Monitor $monitor, string $reason, SslCertificate $certificate = null)
    {
        $this->site = $monitor;

        $this->reason = $reason;

        $this->certificate = $certificate;
    }
}
