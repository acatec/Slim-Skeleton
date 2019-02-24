<?php


$container[\eduslim\domain\user\UserManager::class] = function (\Psr\Container\ContainerInterface $c) {
    return new \eduslim\domain\user\UserManager(
        $c->get('logger'),
        $c->get(\Atlas\Pdo\Connection::class)
    );
};
