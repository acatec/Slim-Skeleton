<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);


$app->add(function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response, callable $next) {
    // Sample log message

    $response = $next($request, $response);

    $this->logger->info($request->getMethod() . ' ' . $response->getStatusCode() . ' ' . $request->getServerParams()['REQUEST_URI'] ?? $request->getUri());

    return $response;
});
