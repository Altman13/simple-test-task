<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тестовое задание</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<?php
require_once 'config.php';
$get_request=$db->prepare("SELECT * from request");
$get_request->execute();
$get_all_claim=$get_request->fetchAll();
?>
<script>
    $(function () {
        $('#id_request').change(function () {
         var id_claim=$(this).val();
         $.post('get_claim.php',{
                 id_claim: id_claim
         },
             function (data) {
                 $('#text_body').text(data);
                 var id_claim=$('#id_request>option:selected').val();
                 console.log(id_claim);
                 $.post('get_status_claim.php',{
                         id_claim: id_claim
                 },
                 function (data) {
                     $("#select_claim_status").val(data);
                 });
             });
     });
     $('.btn').click(function() {
         var id_claim=$('#id_request>option:selected').val();
         var claim_status=$('#select_claim_status>option:selected').val();
         $.post('change_status_claim.php',{
                id_claim: id_claim,
                claim_status: claim_status
         },
             function (data) {
             alert('изменен статус заявки!');
             location.reload();
             })
         });
     $('.add_claim').click(function () {
         var text_claim=$('#text_body_add').val();
        $.post('add_claim.php',
         {
             text_claim: text_claim
         },function (data) {
                $('#text_body_add').val('');
                alert('заявка добавлена!');
                location.reload();
            });
     });
    });
    $( document ).ready(function() {
        var id_claim=$('#id_request>option:selected').val();
        console.log(id_claim);
        $.post('get_status_claim.php',{
                id_claim: id_claim
            },
            function (data) {
                $("#select_claim_status").val(data);
            });
    });
</script>
<div class="row" style="margin-left: 5px; margin-right: 10px;">
<div class="col-lg-3" style="border-style: solid; margin-left: 5px; ">
    <label style="margin-top: 10px; margin-left: 30%;">Подать заявку:</label>
    <textarea id="text_body_add" rows="10" style="width: 100%;"></textarea>

    <button type="button" class="add_claim btn btn-success btn-sm" style="margin-top: 10px; margin-bottom: 10px;">Добавить заявку</button>
</div>
<div class="col-lg-3" style="border-style: solid; margin-left: 5px;">
    <label for="id_request" style="margin-top: 10px;">Выбрать заявку:</label>
    <?php echo '<select id="id_request">';
    foreach ($get_all_claim as $claim) {
        echo '<option value='.$claim['id'].'>'.$claim['id'].'</option>';
    }
    echo '</select>';
    ?>
    <textarea id="text_body" rows="10" style="width: 100%;"><?php echo $get_all_claim[0]['body'];?></textarea>
    <br>
    <select id="select_claim_status" style="margin-top: 10px;">
        <option value="Заявка новая">Заявка новая</option>
        <option value="Заявка активна">Заявка активна</option>
        <option value="Заявка закрыта">Заявка закрыта</option>
        <option value="Заявка в архиве">Заявка в архиве</option>
    </select>
    <br>
<button type="button" class="btn btn-primary btn-sm" style="margin-top: 10px; margin-bottom: 10px;">Изменить статус заявки</button>
</div>
</div>
</body>
</html>