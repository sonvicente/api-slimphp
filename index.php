<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'config.php';
require 'DB.php';
require 'bootstrap.php';

/**
 * Get usuario list
 */
$app->get('/usuario', function (Request $request, Response $response) use ($app) {
    include_once "classes/Usuario.php";
    $usuario = new Usuario();
    $data = $usuario->get();

    $return = $response->withHeader('Content-type', 'application/json');
        /* ->withAddedHeader('Access-Control-Allow-Origin', '*'); */
    return $return->withJson($data, 201);
});
/**
 * Get usuario by ID
 */
$app->get('/usuario/{id}', function (Request $request, Response $response) use ($app) {
    include_once "classes/Usuario.php";
    
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');
    
    $usuario = new Usuario();
    $data = $usuario->getOne($id);
    
    $return = $response->withHeader('Content-type', 'application/json');
        /* ->withAddedHeader('Access-Control-Allow-Origin', '*'); */
    return $return->withJson($data, 200);
});
/**
 * Insert usuario 
 */
$app->post('/usuario', function (Request $request, Response $response) use ($app) {
    include_once "classes/Usuario.php";
    $params = (object) $request->getParams();
    
    $usuario = new Usuario();
    $data = $usuario->insertUser($params);
    
    $return = $response->withHeader('Content-type', 'application/json');
        /* ->withAddedHeader('Access-Control-Allow-Origin', '*'); */
    return $return->withJson($data, 201);
});
/**
 * Update usuario by ID
 */
$app->put('/usuario/{id}', function (Request $request, Response $response) use ($app) {
    include_once "classes/Usuario.php";
    $params = (object) $request->getParams();
    
    $usuario = new Usuario();
    $data = $usuario->updateUser($params);
    
    $return = $response->withHeader('Content-type', 'application/json');
        /* ->withAddedHeader('Access-Control-Allow-Origin', '*'); */
    return $return->withJson($data, 200);
});
/**
 * Delete usuario by ID
 */
$app->delete('/usuario/{id}', function ($request, $response) {
    include_once "classes/Usuario.php";
    
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $usuario = new Usuario();
    $data = $usuario->deleteUser($id);

    $return = $response->withHeader('Content-type', 'application/json');
    return $return->withJson('', 200);
});
/* 
$app->delete('/usuario/{id}', function (Request $request, Response $response){
    include_once "classes/Usuario.php";
    $params = (object) $request->getParams();
    
    $usuario = new Usuario();
    $data = $usuario->deleteUser($params);
    
    $return = $response->withHeader('Content-type', 'application/json');
    return $return->withJson($data, 200);
}); */

$app->run();