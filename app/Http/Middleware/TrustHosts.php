<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string>
     */
    public function hosts()
    {
        return [
            '202.137.120.23',
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
