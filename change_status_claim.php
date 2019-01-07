<?php
require 'config.php';
if($_POST['id_claim']){
    $change_status_claim=$db->prepare("UPDATE request SET status=:claim_status
                                      WHERE  id=:id");
    $change_status_claim->bindParam('id',$_POST['id_claim'],PDO::PARAM_STR);
    $change_status_claim->bindParam('claim_status',$_POST['claim_status'],PDO::PARAM_STR);
    $change_status_claim->execute();
}
?>