<?php


$container[\eduslim\application\controller\DemoController::class] = function (\Psr\Container\ContainerInterface $c) {
    return new \eduslim\application\controller\DemoController(
        $c->get('logger'),
        $c->get('renderer'),
        $c->get(\eduslim\domain\user\UserManager::class)
    );
};
