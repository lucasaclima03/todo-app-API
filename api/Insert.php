<?php
require('../Config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'post') {

    $title = filter_input(INPUT_POST, 'title');
    

    $sql = $pdo->prepare("INSERT INTO tasks (title, created_at, updated_at, is_active)  VALUES
                         (:title, :created_at, :updated_at, :is_active)");
    
    $now = date('Y-m-d H:i:s');
    $is_active = 0;

    $sql->bindValue(':title', $title);
    $sql->bindValue(':created_at', $now);
    $sql->bindValue(':updated_at', $now);
    $sql->bindValue(':is_active', $is_active);
    $sql->execute();

    $id = $pdo->lastInsertId();

    $array['result'] = [
        'id' => $id,
        'title' => $title,
        'created_at' => $now,
        'updated_at' => $now,
        'is_active' => $is_active
    ];


} else {
    $array['error'] = 'Metodo inválido. Apenas é permitido metodo POST';
}

require('../return.php');