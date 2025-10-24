<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * مسیرهایی که از بررسی CSRF مستثنی هستند.
     *
     * @var array<int, string>
     */
    protected $except = [
        // مسیرهای API یا webhook که نمی‌خواهی CSRF بررسی شوند را اینجا بنویس
        'api/*',
        'invoice/*',
    ];
}
