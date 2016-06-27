<?php

require __DIR__ . '/vendor/autoload.php';

Equip\Console\Console::build()
->setCommands([
    new Equip\Console\Command\Hello,
])
->run();
