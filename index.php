<?php 
    echo("Request starting...");
    $lat = $_GET["lat"];
    $lng = $_GET["lng"];
    $radius = $_GET["radius"];
    $sort = $_GET["sort"];
    $type = $_GET["type"];

    echo("Got request with: " + $lat + ", " + $lng + ", " + $radius + ", " + $sort, + ", " + $type);
    
    $json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
        ."?lat=$lat"     // geographische Breite
        ."&lng=$lng"     //               Länge
        ."&rad=$radius"  // Suchradius in km
        ."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
        ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
        ."&apikey=00000000-0000-0000-0000-000000000002");   // Demo-Key ersetzen!
    $data = json_decode($json);
    display($data);
    echo($json);
    var_dump($data);

    

?>