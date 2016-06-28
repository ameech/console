<?php

namespace Equip\Console;

use Auryn\Injector;
use Equip\Console\Command\CommandSet;
use PHPUnit_Framework_TestCase as TestCase;
use ReflectionObject;
use Symfony\Component\Console\Application as ConsoleApplication;

class ApplicationTest extends TestCase
{
    private function assertApplication($app)
    {
        $app_object = new ReflectionObject($app);

        $props = [
            'injector' => Injector::class,
            'commands' => CommandSet::class,
            'application' => ConsoleApplication::class,
        ];

        foreach ($props as $name => $expected) {
            $prop = $app_object->getProperty($name);
            $prop->setAccessible(true);
            $value = $prop->getValue($app);

            if ($expected) {
                $this->assertInstanceOf($expected, $value, $name);
            }
        }
    }

    public function testBuild()
    {
        $app = Application::build();

        $this->assertApplication($app);
    }

    public function testCreate()
    {
        $injector = $this->createMock(Injector::class);
        $commands = $this->createMock(CommandSet::class);
        $application = $this->createMock(ConsoleApplication::class);

        $app = new Application($injector, $commands, $application);

        $this->assertApplication($app);
    }
}
