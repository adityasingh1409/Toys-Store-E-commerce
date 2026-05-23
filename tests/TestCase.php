<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    // Run all migrations before every test (creates SQLite in-memory tables)
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Bypass CSRF token validation in all tests
        // In Laravel 11/12, CSRF lives in the Illuminate framework namespace
        // (App\Http\Middleware\VerifyCsrfToken no longer exists)
        $this->withoutMiddleware([
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
        ]);
    }
}
