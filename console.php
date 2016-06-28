<?php

require __DIR__ . '/vendor/autoload.php';

Equip\Console\Application::build()
->setCommands([
    new Equip\Console\Command\Hello,
])
->run();
