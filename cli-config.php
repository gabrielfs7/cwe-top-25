<?php

$containerBuilder = include __DIR__ . '/bootstrap.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;

require_once 'bootstrap.php';

$em = $containerBuilder->get('doctrine.entity_manager');
$db = $em->getConnection();

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(
    [
        'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($db),
        'dialog' => new \Symfony\Component\Console\Helper\QuestionHelper(),
        'em' => new EntityManagerHelper($em)
    ]
);

$cli = new Application('Doctrine Command Line Interface', \Doctrine\ORM\Version::VERSION);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);

ConsoleRunner::addCommands($cli);

$cli->addCommands(
    [
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
    ]
);
$cli->run();
