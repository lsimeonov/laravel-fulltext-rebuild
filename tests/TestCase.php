<?php

namespace Ucaka\Tests\FullTextRebuild;


use GrahamCampbell\TestBench\AbstractPackageTestCase;

class TestCase extends AbstractPackageTestCase
{


    /**
     * Setup the application environment.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app->config->set('app.key', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');

        $app->config->set('cache.driver', 'array');

        $app->config->set('database.default', 'mysql');
        $app->config->set('database.connections.mysql', [
            'driver'   => 'mysql',
            'database' => 'testdb',
            'prefix'   => '',
        ]);

        $app->config->set('mail.driver', 'log');

        $app->config->set('session.driver', 'array');
    }

    public function tearDown()
    {
        \Mockery::close();
    }
}