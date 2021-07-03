<?php
require('../Config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'post') {

    $id = filter_input(INPUT_POST, 'id');
    $title = filter_input(INPUT_POST, 'title');
    $created_at = filter_input(INPUT_POST, 'created_at');
    $updated_at = filter_input(INPUT_POST, 'updated_at');
    $is_active = filter_input(INPUT_POST, 'is_active');

    $sql = $pdo->prepare("INSERT INTO tasks (id, title, created_at, updated_at, is_active)  VALUES
                         (:id, :title, :created_at, :updated_at, :is_active)");
    $sql->bindValue(':id', $id);
    $sql->bindValue(':title', $title);
    $sql->bindValue(':created_at', $created_at);
    $sql->bindValue(':updated_at', $updated_at);
    $sql->bindValue(':is_active', $is_active);
    $sql->execute();

    $array['result'] = [
        'id' => $id,
        'title' => $title,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
        'is_active' => $is_active
    ];


} else {
    $array['error'] = 'Metodo inválido. Apenas é permitido metodo POST';
}

require('../return.php');