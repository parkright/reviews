<?php


namespace Parkright\Reviews\Tests;


use Illuminate\Database\Eloquent\Factories\Factory;
use Parkright\Reviews\ReviewServiceProvider;


class TestCase extends \Orchestra\Testbench\TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        // additional setup

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->artisan('migrate', ['--database' => 'testing'])->run();
        $this->loadLaravelMigrations();
    }

    protected function getPackageProviders($app)
    {
        return [
            ReviewServiceProvider::class,
        ];
    }

}
