<?php

namespace Equip\Console;

use Auryn\Injector;
use Equip\Console\Command\CommandSet;
use Symfony\Component\Console\Application;

class Console
{
    /**
     * Create a new console application
     *
     * @param Injector|null $injector
     * @param CommandSet|null $commands
     * @param Application|null $application
     *
     * @return static
     */
    public static function build(
        Injector $injector =  null,
        CommandSet $commands = null,
        Application $application = null
    ) {
        return new static(
            $injector,
            $commands,
            $application
        );
    }

    /**
     * @var Injector
     */
    private $injector;

    /**
     * @var CommandSet
     */
    private $commands;

    /**
     * @var Application
     */
    private $application;

    /**
     * @param Injector|null $injector
     * @param CommandSet|null $commands
     * @param Application|null $application
     */
    public function __construct(
        Injector $injector = null,
        CommandSet $commands = null,
        Application $application = null
    ) {
        $this->injector = $injector ?: new Injector;
        $this->commands = $commands ?: new CommandSet;
        $this->application = $application ?: new Application;
    }

    /**
     * Change command values
     *
     * @param array $commands
     *
     * @return self
     */
    public function setCommands($commands)
    {
        $this->commands = $this->commands->withValues($commands);
        return $this;
    }

    /**
     * Run the console application
     */
    public function run()
    {
        $this->application->addCommands($this->commands->toArray());
        return $this->application->run();
    }
}
