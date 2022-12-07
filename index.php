<?php

use Ratulsaqibkhan\DruidIngestionTaskAutomate\Actions\GenerateTaskAction;

require_once realpath(__DIR__ . '/vendor/autoload.php');

// Looing for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrive env variable
$protocol = $_ENV['DRUID_PROTOCOL'];
$user = $_ENV['DRUID_USER'];
$password = $_ENV['DRUID_PASSWORD'];
$host = $_ENV['DRUID_HOST_IP'];
$port = $_ENV['DRUID_OVERLORD_PORT'];
$timezone = $_ENV['TIMEZONE'] ?? 'Asia/Dhaka';

date_default_timezone_set($timezone);
(new GenerateTaskAction($protocol, $user, $password, $host, $port))->handle();
