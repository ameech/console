<?php

require __DIR__ . '/vendor/autoload.php';

Equip\Console\Application::build()
->setConfiguration([
    Equip\Configuration\RedisConfiguration::class,
])
->setCommands([
    Equip\Console\Command\Hello::class,
])
->run();
