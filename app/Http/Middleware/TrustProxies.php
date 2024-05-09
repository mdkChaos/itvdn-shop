<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected array $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected int $headers = Request::HEADER_X_FORWARDED_ALL;
}
