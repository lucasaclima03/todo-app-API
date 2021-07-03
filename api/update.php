<?php
require('../Config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'put'){

    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'] ?? null;
    $is_active = $input['is_active'] ?? null;

    $id = filter_var($id);
    $is_active = filter_var($is_active);
    
    if($id ) {
        $sql = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount()>0) {

            $now = date('Y-m-d H:m:s');

            $sql = $pdo->prepare("UPDATE tasks SET updated_at=:updated_at, is_active=:is_active WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':updated_at', $now);
            $sql->bindValue(':is_active', $is_active);
            $sql->execute();

            $array['result'] = [
                'id' => $id,
                'updated_at' => $now,
                'is_active' => $is_active
                ];

            } else {
                $array['error'] = 'ID inexistente';
            }
        } else {
        $array['error'] = 'dados não enviados';
        }

        

} else {
    $array['error'] = 'Método não permitido (apenas PUT)';
}

require('../return.php');