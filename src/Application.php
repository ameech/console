<?php

namespace Equip\Console;

use Auryn\Injector;
use Equip\Console\Command\CommandSet;
use Symfony\Component\Console\Application as ConsoleApplication;

class Application
{
    /**
     * Create a new console application
     * 
     * @param Injector|null $injector
     * @param CommandSet|null $commands
     * @param ConsoleApplication|null $application
     * 
     * @return static
     */
    public static function build(
        Injector $injector = null,
        CommandSet $commands = null,
        ConsoleApplication $application = null
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
     * @var ConsoleApplication
     */
    private $application;

    /**
     * @param Injector|null $injector
     * @param CommandSet|null $commands
     * @param ConsoleApplication|null $application
     */
    public function __construct(
        Injector $injector = null,
        CommandSet $commands = null,
        ConsoleApplication $application = null
    ) {
        $this->injector = $injector ?: new Injector;
        $this->commands = $commands ?: new CommandSet;
        $this->application = $application ?: new ConsoleApplication;
    }

    /**
     * Set commands
     * 
     * @param array $commands
     * 
     * @return $this
     */
    public function setCommands(array $commands)
    {
        $this->commands = $this->commands->withValues($commands);
        return $this;
    }

    /**
     * Start the console application
     * 
     * @return int 0 if everything went fine, or an error code
     */
    public function run()
    {
        $this->application->addCommands($this->commands->toArray());
        
        return $this->application->run();
    }
}
