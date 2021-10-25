<?php 
    $thr_price = 1.5;

    echo("Request starting...");
    $lat = isset($_GET["lat"]) ? $_GET["lat"] : '47.937580';
    $lng = isset($_GET["lng"]) ? $_GET["lng"] : '10.235170';
    $radius = isset($_GET["price"]) ? $_GET["price"] : '10';
    $sort = isset($_GET["sort"]) ? $_GET["sort"] : 'price';
    $type = isset($_GET["type"]) ? $_GET["type"] : 'e5';

    echo("Got request with: " .$lat . ", " . $lng . ", " . $radius . ", " . $sort . ", " . $type);
    
    $json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
        ."?lat=$lat"     // geographische Breite
        ."&lng=$lng"     //               Länge
        ."&rad=$radius"  // Suchradius in km
        ."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
        ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
        ."&apikey=00000000-0000-0000-0000-000000000002");   // Demo-Key ersetzen!
    $data = json_decode($json);

    //echo($json);
    //var_dump($data);


    $filtered_stations = array();
    $final_stations = array();

    var_dump($data['stations']);
    foreach ($data['stations'] as $value) {
        if ($value['price'] <= $thr_price){
            array_push($filtered_stations, $value);
        }
    }
    $final_stations = $filtered_stations;
    if (sizeof($filtered_stations) < 3){
        //
    }

    if (sizeof($filtered_stations) > 0){
        mail("mail99@posteo.me","Tanke jetzt!","Nachrichten Infos: " . $json);
    }
    
?>