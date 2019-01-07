<?php
require 'config.php';
if($_POST['text_claim']){
$claim_add=$db->prepare("INSERT INTO `test`.`request` (body) VALUES (:text)");
$claim_add->bindParam('text',$_POST['text_claim'],PDO::PARAM_STR);
$claim_add->execute();
}
?>