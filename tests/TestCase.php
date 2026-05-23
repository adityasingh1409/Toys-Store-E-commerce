<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    // Refresh SQLite in-memory DB before every test
    // This runs all migrations so tables exist
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Bypass CSRF token validation in all tests
        // This fixes HTTP 419 errors on POST requests
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }
}
