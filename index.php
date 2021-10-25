<?php 
    $thr_price = 1.7;

    echo("Request starting...");
    $lat = isset($_GET["lat"]) ? $_GET["lat"] : '47.937580';
    $lng = isset($_GET["lng"]) ? $_GET["lng"] : '10.235170';
    $radius = isset($_GET["radius"]) ? $_GET["radius"] : '10';
    $sort = isset($_GET["sort"]) ? $_GET["sort"] : 'price';
    $type = isset($_GET["type"]) ? $_GET["type"] : 'e5';

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
            array_push($final_stations, $data->stations[++$i]);
        }
    }

    if (sizeof($filtered_stations) > 0){
        mail("mail99@posteo.me","Tanke jetzt!","Nachrichten Infos: " . print_r($final_stations, true));

        echo "<pre>";
        var_dump($final_stations);
        echo "</pre>";
    }
    
?>