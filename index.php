<?php 

    echo("Request starting...");
    $lat = isset($_GET["lat"]) ? $_GET["lat"] : '47.937580';
    $lng = isset($_GET["lng"]) ? $_GET["lng"] : '10.235170';
    $radius = isset($_GET["radius"]) ? $_GET["radius"] : '10';
    $sort = isset($_GET["sort"]) ? $_GET["sort"] : 'price';
    $type = isset($_GET["type"]) ? $_GET["type"] : 'e5';
    $thr_price = isset($_GET["price"]) ? $_GET["price"] : '1.6';
    $mail = isset($_GET["mail"]) ? $_GET["mail"] : 'mail99@posteo.me';
    $name = isset($_GET["name"]) ? $_GET["name"] : 'Stranger';

    echo("Got request with: " .$lat . ", " . $lng . ", " . $radius . ", " . $sort . ", " . $type);
    
    $json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
        ."?lat=$lat"     // geographische Breite
        ."&lng=$lng"     //               Länge
        ."&rad=$radius"  // Suchradius in km
        ."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
        ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
        ."&apikey=f371369a-f2bc-3e0c-06da-5c3c92ede92c");   // Demo-Key ersetzen!
    $data = json_decode($json);

    $filtered_stations = array();
    $final_stations = array();

    foreach ($data->stations as $value) {
        if ($value->price <= $thr_price && $value->isOpen == true){
            array_push($filtered_stations, $value);
        }
    }
    
    $final_stations = $filtered_stations;


    if (sizeof($filtered_stations) < 3){
    
        for ($i = sizeof($filtered_stations); $i < 3; $i++){
            array_push($final_stations, $data->stations[$i+1]);
        }
    }

    if (sizeof($filtered_stations) > 0){
        $to = $mail;
        $subject = 'Tanke jetzt oder nie!';
        $from = 'no-reply@sprit.chrinimue.de';
        
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<h1 style="color:#f40;">Hi '.$name.'</h1>';
        $message .= '<p style="color:#080;font-size:18px;">Tanke jetzt!</p>';
        $message .= '<p style="color:#080;font-size:18px;background-color: #808080;"><a href="geo:' . $final_stations[0]["lat"] . ',' . $final_stations[0]["lng"] . '">Losfahren!</></p>';
        $message .= print_r($final_stations, true);
        $message .= '</body></html>';
        
        if (mail($to , $subject, $message, $headers)){
            echo("Mail send");
        }
        else {
            echo("Error: Mail not send");
        }
    }
    
?>