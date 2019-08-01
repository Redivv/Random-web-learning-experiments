<?php

require __DIR__ . "/../src/Repository/GameRepository.php";

$request_body = json_decode(file_get_contents('php://input'), true);

$clean = array();

$clean['user'] = filter_var($request_body['user'], FILTER_SANITIZE_NUMBER_INT);

$repo = new GameRepository;
$games = $repo->findByUserId((int)$clean['user']);

$data = array();
foreach ($games as $game) {
    $data[] = $game->toArray();
}

header('Content-type: application/json');
echo json_encode([
    'data' => $data,
]);