<?php

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Tools\Console\Command;
use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;

$dbParams = [
    "dbname" =>"doctrine",
    "user" => "root",
    "password" => "example",
    "host" => "db",
    "driver" =>"pdo_mysql"
];

$connection = DriverManager::getConnection($dbParams);

$em = new \App\System\Datebase\DoctrineManager();
$em = $em->getEntityManager();

$configuration = new Configuration($connection);
$configuration->setName('My Project Migrations');
$configuration->setMigrationsNamespace('Migrations');
$configuration->setMigrationsTableName('doctrine_migration_versions');
$configuration->setMigrationsColumnName('version');
$configuration->setMigrationsColumnLength(255);
$configuration->setMigrationsExecutedAtColumnName('executed_at');
$configuration->setMigrationsDirectory('data/migrations/');
$configuration->setAllOrNothing(true);
$configuration->setCheckDatabasePlatform(false);

$helperSet = Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($em);
$helperSet->set(new QuestionHelper(), 'question');
$helperSet->set(new ConnectionHelper($connection), 'db');
$helperSet->set(new ConfigurationHelper($connection, $configuration));

$cli = new Application('Doctrine Migrations');
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);

$cli->addCommands(array(
    new Command\DumpSchemaCommand(),
    new Command\ExecuteCommand(),
    new Command\GenerateCommand(),
    new Command\LatestCommand(),
    new Command\MigrateCommand(),
    new Command\RollupCommand(),
    new Command\StatusCommand(),
    new Command\VersionCommand(),
    new Command\DiffCommand()
));

$cli->run();