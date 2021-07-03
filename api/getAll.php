<?php
require('../config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'get'){

    $sql = $pdo->query("SELECT * FROM tasks");
    if($sql->rowCount() > 0){
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($data as $item){
            $array['result'] [] = [
                'id'=> $item['id'],
                'title' => $item['title'],
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'is_active' => $item['is_active']
            ];
        }

    }

} else {
    $array['error'] = 'Método não permitido (apenas GET)';
}

require('../return.php');