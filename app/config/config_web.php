<?php

use Adoptify\Entities\User;
use function DI\object;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use League\CLImate\Util\Writer\StdOut;
use Monolog\ErrorHandler;
use Psecio\Gatekeeper\Gatekeeper;
use SitePoint\Rauth;
use Tamtamchik\SimpleFlash\Flash;
use Tamtamchik\SimpleFlash\TemplateFactory;
use Tamtamchik\SimpleFlash\Templates;
use Psr\Log\LoggerInterface as Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\BrowserConsoleHandler;

Gatekeeper::init(__DIR__ . '/../../');
Gatekeeper::disableThrottle();

$user = null;
if (isset($_SESSION['user'])) {
    $user = Gatekeeper::findUserByUsername($_SESSION['user']);
    if (!$user) {
        session_destroy();
        unset($_SESSION['user']);
        header('Location: /');
        die();
    }
}

$shared = require_once __DIR__ . '/shared/root.php';
$shared['user'] = $user;
require_once __DIR__ . '/connections/default.php';
require_once __DIR__ . '/connections/users.php';

return [

    'mailgun-config' => $shared['mailgun-config'],
    'site-config' => $shared['site'],

    // Configure Twig
    Twig_Environment::class => function (Flash $flash) use ($shared) {
        $loader = new Twig_Loader_Filesystem(
            [
                __DIR__ . '/../../src/Standard/Views',
                __DIR__ . '/../../src/Adoptify/Views',
            ]
        );

        $te = new Twig_Environment($loader);

        $te->addGlobal('site', $shared['site']);

        if ($shared['user']) {
            $te->addGlobal('username', $shared['user']->username);
        }

        if (isset($_SESSION['superuser'])) {
            $te->addGlobal('super', $_SESSION['superuser']);
        }

        if ($flash->hasMessages()) {
            $te->addGlobal('flashes', $flash->display());
        }

        // Configure menu
        $leftMenu = [
            '/' => 'Home',
            '/find' => 'Find a buddy',
            '/post' => 'Post an ad',
            '/about' => 'About / FAQ',
        ];

        if ($shared['user']) {
            $rightMenu = [
                '/account' => 'My Account',
                '/logout' => 'Log out',
            ];
        } else {
            $rightMenu = [
                '/auth' => 'Log in / Sign up',
            ];
        }
        $te->addGlobal(
            'menus', [
                "left" => $leftMenu,
                "right" => $rightMenu,
                'active' => $_SERVER['REQUEST_URI'] ?? '/',
            ]
        );

        // End configure menu
        return $te;
    },

    'glide' => require_once __DIR__ . '/shared/glide.php',

    'titleGenerator' => require_once __DIR__ . '/shared/titlegen.php',

    ClientInterface::class => function () {
        $client = new Client();

        return $client;
    },

    Flash::class => function () {
        return new Flash(TemplateFactory::create(Templates::SEMANTIC_2));
    },

    User::class => function () use ($shared) {
        return ($shared['user']) ? new User($shared['user']) : null;
    },

    'rauth' => function () {
        $rauth = new Rauth();

        // Add cache at some point
        return $rauth;
    },

    Logger::class => function () use ($shared) {
        $logger = new \Monolog\Logger('nofwlog');

        $logger->pushHandler(
            new StreamHandler($shared['site']['logFolder'] . '/all.log')
        );
        $logger->pushHandler(
            new StreamHandler(
                $shared['site']['logFolder'] . '/error.log',
                \Monolog\Logger::NOTICE
            )
        );
        if ($shared['site']['env'] == 'dev') {
            $logger->pushHandler(new BrowserConsoleHandler());
        }

        ErrorHandler::register($logger);

        $logger->info('Logging set up');

        return $logger;
    },
];