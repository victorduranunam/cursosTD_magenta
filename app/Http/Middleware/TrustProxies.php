<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */

      protected $proxies = '**';
       // protected $proxies = [
       //     'IP_DEL_PROXY_DE_UNAM', // Si conoces la IP exacta
            // O si no la conoces y estás seguro de que tu aplicación solo recibe tráfico a través de ese proxy
            // (Usar con extrema precaución, ya que confiaría en cualquier proxy)
            // '**',
       // ];

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}









