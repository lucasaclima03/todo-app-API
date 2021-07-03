<?php

require('../Config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'get'){

    $id = filter_input(INPUT_GET, 'id');
 
     if($id){
 
         $sql = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
         $sql->bindValue(':id', $id);
         $sql->execute();
 
             if($sql->rowCount()>0) {
 
                  $data = $sql->fetch(PDO::FETCH_ASSOC);
 
                  $array['result'] = [
                      'id' => $data['id'],
                      'title' => $data['title'],
                      'created_at' => $data['created_at'],
                      'updated_at' => $data['updated_at'],
                      'is_active' => $data['is_active']
                      
                  ];
 
                 }  else {
                     $array['error'] = 'ID inexistente';
                   }   
 
        } else {
        $array['error'] = 'ID não enviado';
        }
 
     } else {
     $array['error'] = 'Método não permitido (apenas GET)';
     }
 
 require('../return.php');