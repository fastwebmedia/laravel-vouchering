<?php

use League\FactoryMuffin\FactoryMuffin;
use League\FactoryMuffin\Faker\Facade as Faker;

abstract class AbstractFWMTestCase extends \PHPUnit_Framework_TestCase
{
    protected static $fm;

    public static function setupBeforeClass()
    {
        static::$fm = new FactoryMuffin();
        static::$fm->loadFactories(__DIR__.'/factories');
        Faker::setLocale('en_GB');
    }

    public static function tearDownAfterClass()
    {
        static::$fm->deleteSaved();
        static::$fm = new FactoryMuffin();
    }

    protected function reload()
    {
        static::tearDownAfterClass();
        static::setupBeforeClass();
    }
}