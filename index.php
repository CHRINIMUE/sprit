<?php 

    include 'env.php';

    echo("Welcome to sprit.chrinimue.de<br><br>
    Request Parameters are: lat, lng, radius, type (e5, e10, diesel, all), price (eg. 1.50), mail (eg. mail@mail.com), name, check_is_open (true, false)<br><br>");
    echo("Request starting...<br>");
    $lat = isset($_GET["lat"]) ? $_GET["lat"] : '47.937580';
    $lng = isset($_GET["lng"]) ? $_GET["lng"] : '10.235170';
    $radius = isset($_GET["radius"]) ? $_GET["radius"] : '10';
    $sort = 'price';
    $type = isset($_GET["type"]) ? $_GET["type"] : 'e5';
    $thr_price = isset($_GET["price"]) ? $_GET["price"] : '1.6';
    $mail = isset($_GET["mail"]) ? $_GET["mail"] : 'n/a';
    $name = isset($_GET["name"]) ? $_GET["name"] : 'Stranger';
    $check_is_open = isset($_GET["check_is_open"]) ? $_GET["check_is_open"] : 'true'; // allow true or false

    if ($radius > 25) {
        $radius = 25;
    } else if ($radius < 1) {
        $radius = 1;
    }

    echo("Got request with: Lat: " .$lat . ", Lon: " . $lng . ", Radius: " . $radius . ", Sorting: " . $sort . ", Type: " . $type . ", Price: " . $thr_price . ", Mail: " . $mail . ", Name: " . $name . "<br>");
    if ($mail == "n/a") {
        echo("No email provided!<br>An Email adress is necessary.<br>Programm stopped.");
        exit();
    }
    $json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
        ."?lat=$lat"     // geographische Breite
        ."&lng=$lng"     //               Länge
        ."&rad=$radius"  // Suchradius in km
        ."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
        ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
        ."&apikey=".$_ENV['API_TANKERKOENING']);   
    $data = json_decode($json);

    $filtered_stations = array();
    $final_stations = array();

    foreach ($data->stations as $value) {
        if ($value->price <= $thr_price && $value->price >= 0.1) // check if price is greater than 0.1 to filter out stations which dont have a price in the api
        {
            if ($_GET != "false") {
                if ($value->isOpen == true) {
                    array_push($filtered_stations, $value);
                }   
            } else {
                array_push($filtered_stations, $value);
            }
            
        }
    }
    
    $final_stations = $filtered_stations;


    if (sizeof($filtered_stations) < 3){
    
        for ($i = sizeof($filtered_stations); $i < 3; $i++){
            array_push($final_stations, $data->stations[$i+1]);
        }
    }

     echo("Amount of Filtered Stations: " . sizeof($filtered_stations) . "<br>");
     echo("Amount of Final Stations: " . sizeof($final_stations) . "<br>");





    $header = '<!DOCTYPE html>
    <html style="font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <header>
            <div style="padding-top: 5px; padding-bottom: 5px; padding: auto; border: solid 1px #264653; border-radius: 1rem; color: white; margin: 3px; background-color: #03574d; font-size: x-large; text-align: center; font-weight: 600; box-shadow: 1px 11px 17px 1px rgba(0,0,0,0.23);">
                <p>GAS STATIONS</p>
            </div>
        </header>';

    $first_station = '
    <body>   
        <div style="margin: 3px; margin-bottom: 1rem;margin-top: 1rem; padding: 1rem; border: solid 1px #264653; border-radius: 1rem; font-size: medium; text-align: center; font-weight: 600; box-shadow: 1px 11px 17px 1px rgba(0,0,0,0.23);">
            <div style="width: 100%; height:auto; padding-right: 5px; padding-left: 5px;">
                <a href="http://maps.google.com/maps?q=loc:' .  $final_stations[0]->lat . ',' . $final_stations[0]->lng . '" style="display:block;border: solid 2px #f4a261; border-radius: 10px;padding: 10px; background-color: #e9c46a; margin: auto;text-decoration: none;color:white">1 - '. substr($final_stations[0]->name, 0, 20) .'</a>
                </div> 
                <div>
                     <p style="margin: 0px; margin-top: 16px;">'.$final_stations[0]->price.'&euro; | '.$final_stations[0]->dist.' km</p>
                     </div> 
                  </div>';




              function get_static_image($stations, $lat, $lng, $radius){

                $url = 'https://api.mapbox.com/styles/v1/mapbox/outdoors-v11/static/';
                
                $zoom = 10;
                if ($radius < 5){
                    $zoom = 12;
                } else if ($radius < 10){
                    $zoom = 11;
                }
                
                $reverse_stations = array_reverse($stations);
                

                $i = sizeof($reverse_stations);
                foreach ($reverse_stations as $station) {
                    if ($i == sizeof($reverse_stations)){
                        $url .= 'pin-s-'.$i.'+285A98('.$station->lng.','.$station->lat.')';
                    }
                    else if($i == 1){
                        $url .= ',pin-s-'.$i.'+ff8000('.$station->lng.','.$station->lat.')';
                    } else {
                        $url .= ',pin-s-'.$i.'+285A98('.$station->lng.','.$station->lat.')';
                    }
                    $i--;                
                }
    
                $url .= '/'.$lng.','.$lat.','.$zoom.',0/600x600@2x?access_token='.$_ENV['API_MAPBOX'];
            
                return '
                <div style="margin: 3px; margin-bottom: 1rem;">
                <div style="border: solid 1px #264653; border-radius: 1rem; overflow: hidden; box-shadow: 1px 11px 17px 1px rgba(0,0,0,0.23);">
                <img style="width: 100%; transform: scale(1.03);" src="'.$url.'" alt="">
                  </div>
                  </div>';
                }

        
        function single_station($name, $price, $distance, $lat, $lng, $number) {
            return '
            <div style="margin: 3px; margin-bottom: 1rem; padding: 1rem; border: solid 1px #264653; border-radius: 1rem; font-size: medium; text-align: center; font-weight: 600; box-shadow: 1px 11px 17px 1px rgba(0,0,0,0.23);">
            <div style="width: 100%; height:auto; padding-right: 5px; padding-left: 5px;">
            <a href="http://maps.google.com/maps?q=loc:' . $lat . ',' . $lng . '" style="display:block;border: solid 2px #f4a261; border-radius: 10px;padding: 10px; background-color: #e9c46a; margin: auto;text-decoration: none;color:white">'.$number.' - ' . substr($name, 0, 20) . '</a>
            </div> 
            <div>
            <p style="margin: 0px; margin-top: 16px;">'. $price.' &euro; | '. $distance.'km</p>
                </div> 
              </div>';
            }

            $end = '
            </body>
        </html>';
  

    if (sizeof($filtered_stations) > 0){
        echo("Try to send mail<br>");
        $to = $mail;
        $subject = 'Tanke jetzt oder nie '. $name .'!';
        $from = 'no-reply@sprit.chrinimue.de';
        
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $message = $header . $first_station;
        $message .= get_static_image($final_stations, $lat, $lng, $radius);
        
        $first = true;
        $for_i = 1;
        foreach ($final_stations as $station) {
            if ($first){
                $first = false;
            }
            else {
                $message .= single_station($station->name, $station->price, $station->dist, $station->lat, $station->lng, $for_i);
            }
            $for_i++;
        }

        $message .= $end;
        
        if (mail($to , $subject, $message, $headers)){
            echo("Mail send");
        }
        else {
            echo("Error: Mail not send");
        }
    } else {
     echo("Mail will not be send!<br>");
    }
    
?>
