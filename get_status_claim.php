<?php
require 'config.php';
if($_POST['id_claim']){
    $get_status=$db->prepare("SELECT request.status FROM request
                              WHERE request.id=:id");
    $get_status->bindParam('id',$_POST['id_claim'],PDO::PARAM_STR);
    $get_status->execute();
    $id=$get_status->fetchColumn();
    echo $id;
}
?>