<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use ReflectionMethod;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $service;

    protected function callPrivate(string $method, $parameters)
    {
        $reflectionMethod = new ReflectionMethod(get_class($this->service), $method);
        $reflectionMethod->setAccessible(true);

        return $reflectionMethod->invoke($this->service, $parameters);
    }
}
