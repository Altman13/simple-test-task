<?php
require 'config.php';
//добавить параметр: номер заявки
if($_POST['id_claim']) {
    $take_request = $db->prepare("SELECT * FROM request WHERE request.id=:id");
    $take_request->bindParam(':id',$_POST['id_claim'],PDO::PARAM_STR);
    $take_request->execute();
    $take_req = $take_request->fetch();
    echo $take_req['body'];
}
?>