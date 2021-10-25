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





    $header = '<!DOCTYPE html><html xmlns:v=3D"urn:schemas-microsoft-com:vml" xmlns:o=3D"urn:schemas-microsoft-com:office:office" lang=3D"en"><head><title></title><meta charset=3D"UTF-8"><meta name=3D"viewport" content=3D"width=3Ddevice-width,initial-scale=3D1"><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><!--[if !mso]><!--><link href=3D"https://fonts.googleapis.com/css?family=3DMerriweather" rel=3D"stylesheet" type=3D"text/css"><link href=3D"https://fonts.googleapis.com/css?family=3DMontserrat" rel=3D"stylesheet" type=3D"text/css"><!--<![endif]--><style> *{ box-sizing:border-box}body{margin:0;padding:0}th.column{padding:0}a[x-apple-data-detectors]{color:inherit!important;text-decoration:inherit!important}#MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}@media (max-width:620px){.icons-inner{text-align:center}.icons-inner td{margin:0 auto}.row-content{width:100%!important}.image_block img.big{width:auto!important}.stack .column{width:100%;display:block}}</style></head>'

    $first_station = '
    <body style=3D"background-color:#e1e4e9;margin:0;padd=ing:0;-webkit-text-size-adjust:none;text-size-adjust:none">
        <table class=3D"nl-container" width=3D"100%" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0;background-color:#e1e4e9">
            <tbody>
                <tr>
                    <td>
                    <table class=3D"row r
    ow-1" align=3D"center" width=3D"100%" border=3D"0" cellpadding=3D"0" ce
    llspacing=3D"0" role=3D"presentation" style=3D"mso-table-lspace:0;mso-t
    able-rspace:0"><tbody><tr><td><table class=3D"row-content" align=3D"cen
    ter" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"presentat
    ion" style=3D"mso-table-lspace:0;mso-table-rspace:0;background-color:#f
    ff" width=3D"600"><tbody><tr><th class=3D"column" width=3D"100%" style=3D
    "mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;
    vertical-align:top;padding-top:0;padding-bottom:0"><table class=3D"empt
    y_block" width=3D"100%" border=3D"0" cellpadding=3D"0" cellspacing=3D"0
    " role=3D"presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0"
    ><tr><td><div></div> </td></tr></table></th></tr></tbody></table></td><
    /tr></tbody></table><table class=3D"row row-2" align=3D"center" width=3D
    "100%" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"present
    ation" style=3D"mso-table-lspace:0;mso-table-rspace:0"><tbody><tr><td><
    table class=3D"row-content stack" align=3D"center" border=3D"0" cellpad
    ding=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso-table-l
    space:0;mso-table-rspace:0;background-color:#0377ea" width=3D"600"><tbo
    dy><tr><th class=3D"column" width=3D"100%" style=3D"mso-table-lspace:0;
    mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;p
    adding-top:10px;padding-bottom:10px"><table class=3D"text_block" width=3D
    "100%" border=3D"0" cellpadding=3D"10" cellspacing=3D"0" role=3D"presen
    tation" style=3D"mso-table-lspace:0;mso-table-rspace:0;word-break:break
    -word"><tr><td><div style=3D"font-family:serif"><div style=3D"font-size
    :14px;font-family:Merriwheater,Georgia,serif;color:#fff;line-height:1.2
    "><p style=3D"margin:0;font-size:14px;text-align:center"><span style=3D
    "font-size:30px">Best Price here:<br></span></p></div></div></td></tr><
    /table></th></tr></tbody></table></td></tr></tbody></table><table class
    =3D"row row-3" align=3D"center" width=3D"100%" border=3D"0" cellpadding
    =3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso-table-lspac
    e:0;mso-table-rspace:0"><tbody><tr><td><table class=3D"row-content" ali
    gn=3D"center" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"
    presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0;background
    -color:#fff" width=3D"600"> <tbody><tr><th class=3D"column" width=3D"33
    .333333333333336%" style=3D"mso-table-lspace:0;mso-table-rspace:0;font-
    weight:400;text-align:left;vertical-align:top;padding-left:10px"><table
     class=3D"text_block" width=3D"100%" border=3D"0" cellpadding=3D"0" cel
    lspacing=3D"0" role=3D"presentation" style=3D"mso-table-lspace:0;mso-ta
    ble-rspace:0;word-break:break-word"><tr><td style=3D"padding-bottom:20p
    x;padding-left:10px;padding-right:10px;padding-top:30px"><div style=3D"
    font-family:sans-serif"><div style=3D"font-size:12px;color:#00255b;line
    -height:1.2;font-family:Arial,Helvetica Neue,Helvetica,sans-serif"><p s
    tyle=3D"margin:0;font-size:12px;text-align:center"><span style=3D"font-
    size:22px"><strong>Station Name<br></strong></span></p></div></div></td
    ></tr></table></th><th class=3D"column" width=3D"41.666666666666664%" s
    tyle=3D"mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-alig
    n:left;vertical-align:top"><table class=3D"button_block" width=3D"100%"
     border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"presentation"
     style=3D"mso-table-lspace:0;mso-table-rspace:0"><tr><td style=3D"text-
    align:center;padding-top:30px;padding-right:10px;padding-bottom:25px;pa
    dding-left:10px"><div align=3D"center"> <!--[if mso]><v:roundrect xmlns
    :v=3D"urn:schemas-microsoft-com:vml" xmlns:w=3D"urn:schemas-microsoft-c
    om:office:word" style=3D"height:42px;width:108px;v-text-anchor:middle;"
     arcsize=3D"10%" stroke=3D"false" fillcolor=3D"#ffdb29"><w:anchorlock/>
    <v:textbox inset=3D"0px,0px,0px,0px"><center style=3D"color:#ffffff; fo
    nt-family:Arial, sans-serif; font-size:16px"><![endif]--><div style=3D"
    text-decoration:none;display:inline-block;color:#fff;background-color:#
    ffdb29;border-radius:4px;width:auto;border-top:1px solid #ffdb29;border
    -right:1px solid #ffdb29;border-bottom:1px solid #ffdb29;border-left:1p
    x solid #ffdb29;padding-top:5px;padding-bottom:5px;font-family:Arial,He
    lvetica Neue,Helvetica,sans-serif;text-align:center;mso-border-alt:none
    ;word-break:keep-all"><span style=3D"padding-left:20px;padding-right:20
    px;font-size:16px;display:inline-block;letter-spacing:normal"><span sty
    le=3D"font-size:16px;line-height:2;word-break:break-word;mso-line-heigh
    t-alt:32px">drive now</span></span></div><!--[if mso]></center></v:text
    box></v:roundrect><![endif]--></div></td></tr></table></th><th class=3D
    "column" width=3D"25%" style=3D"mso-table-lspace:0;mso-table-rspace:0;f
    ont-weight:400;text-align:left;vertical-align:top;padding-right:10px"><
    table class=3D"text_block" width=3D"100%" border=3D"0" cellpadding=3D"0
    " cellspacing=3D"0" role=3D"presentation" style=3D"mso-table-lspace:0;m
    so-table-rspace:0;word-break:break-word"><tr><td style=3D"padding-botto
    m:10px;padding-left:10px;padding-right:10px;padding-top:30px"><div styl
    e=3D"font-family:sans-serif"><div style=3D"font-size:12px;color:#00255b
    ;line-height:1.2;font-family:Arial,Helvetica Neue,Helvetica,sans-serif"
    ><p style=3D"margin:0;font-size:12px"><span style=3D"font-size:22px"><s
    trong><span style=3D"">Price</span></strong></span></p></div></div></td
    ></tr></table><table class=3D"text_block" width=3D"100%" border=3D"0" c
    ellpadding=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso-t
    able-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td style=3D
    "padding-left:10px;padding-right:10px;padding-bottom:10px"><div style=3D
    "font-family:sans-serif"><div style=3D"font-size:12px;color:#00255b;lin
    e-height:1.2;font-family:Arial,Helvetica Neue,Helvetica,sans-serif">dis
    tance<p style=3D"margin:0;font-size:12px;mso-line-height-alt:14.3999999
    99999999px">&nbsp;</p></div></div></td></tr></table></th></tr></tbody> 
    </table></td></tr></tbody></table><table class=3D"row row-4" align=3D"c
    enter" width=3D"100%" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" 
    role=3D"presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0"><
    tbody><tr><td><table class=3D"row-content stack" align=3D"center" borde
    r=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"presentation" style
    =3D"mso-table-lspace:0;mso-table-rspace:0;background-color:#fff" width=3D
    "600"><tbody><tr><th class=3D"column" width=3D"100%" style=3D"mso-table
    -lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-a
    lign:top;padding-top:0;padding-bottom:0"><table class=3D"image_block" w
    idth=3D"100%" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"
    presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0"><tr><td s
    tyle=3D"width:100%;padding-right:0;padding-left:0"><div align=3D"center
    " style=3D"line-height:10px"><img class=3D"big" src=3D"https://d1oco4z2
    z1fhwp.cloudfront.net/templates/default/4456/Airplane_fIRST_Image_.png"
     style=3D"display:block;height:auto;border:0;width:600px;max-width:100%
    " width=3D"600" alt=3D"Karte" title=3D"Karte"></div></td></tr></table><
    /th></tr></tbody></table></td></tr></tbody></table><table class=3D"row 
    row-5" align=3D"center" width=3D"100%" border=3D"0" cellpadding=3D"0" c
    ellspacing=3D"0" role=3D"presentation" style=3D"mso-table-lspace:0;mso-
    table-rspace:0"><tbody><tr><td><table class=3D"row-content stack" align
    =3D"center" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"pr
    esentation" style=3D"mso-table-lspace:0;mso-table-rspace:0;background-c
    olor:#0377ea" width=3D"600"><tbody><tr><th class=3D"column" width=3D"10
    0%" style=3D"mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text
    -align:left;vertical-align:top;padding-left:15px;padding-right:15px;pad
    ding-top:20px;padding-bottom:5px"><table class=3D"text_block" width=3D"
    100%" border=3D"0" cellpadding=3D"10" cellspacing=3D"0" role=3D"present
    ation" style=3D"mso-table-lspace:0;mso-table-rspace:0;word-break:break-
    word"><tr><td><div style=3D"font-family:serif"><div style=3D"font-size:
    14px;font-family:Merriwheater,Georgia,serif;color:#fff;line-height:1.2"
    ><p style=3D"margin:0;font-size:14px;text-align:center"><span style=3D"
    font-size:30px">Lowest prices at this stations<br></span></p></div></di
    v></td></tr></table><table class=3D"text_block" width=3D"100%" border=3D
    "0" cellpadding=3D"10" cellspacing=3D"0" role=3D"presentation" style=3D
    "mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td><
    div style=3D"font-family:sans-serif"><div style=3D"font-size:14px;color
    :#fff;line-height:1.2;font-family:Arial,Helvetica Neue,Helvetica,sans-s
    erif"><p style=3D"margin:0;font-size:14px;text-align:center">This stati=
    ons are also lower than your threnshold (or a litle bit higher)</p></di=
    v></div></td></tr></table></th></tr></tbody></table></td></tr></tbody><=
    /table><table class=3D"row row-6" align=3D"center" width=3D"100%" borde=
    r=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"presentation" style=
    =3D"mso-table-lspace:0;mso-table-rspace:0"><tbody><tr><td><table class=3D=
    "row-content" align=3D"center" border=3D"0" cellpadding=3D"0" cellspaci=
    ng=3D"0" role=3D"presentation" style=3D"mso-table-lspace:0;mso-table-rs=
    pace:0;background-color:#0377ea" width=3D"600"><tbody><tr><th class=3D"=
    column" width=3D"33.333333333333336%" style=3D"mso-table-lspace:0;mso-t=
    able-rspace:0;font-weight:400;text-align:left;vertical-align:top;paddin=
    g-left:10px"><table class=3D"text_block" width=3D"100%" border=3D"0" ce=
    llpadding=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso-ta=
    ble-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td style=3D=
    "padding-bottom:20px;padding-left:10px;padding-right:10px;padding-top:2=
    0px"><div style=3D"font-family:sans-serif"><div style=3D"font-size:12px=
    ;color:#fff;line-height:1.2;font-family:Arial,Helvetica Neue,Helvetica,=
    sans-serif"><p style=3D"margin:0;font-size:12px;text-align:center"><spa=
    n style=3D"font-size:22px"><strong>Name of Station long version<br></st=
    rong></span></p></div></div></td></tr></table></th><th class=3D"column"=
     width=3D"41.666666666666664%" style=3D"mso-table-lspace:0;mso-table-rs=
    pace:0;font-weight:400;text-align:left;vertical-align:top"><table class=
    =3D"button_block" width=3D"100%" border=3D"0" cellpadding=3D"0" cellspa=
    cing=3D"0" role=3D"presentation" style=3D"mso-table-lspace:0;mso-table-=
    rspace:0"><tr><td style=3D"text-align:center;padding-top:20px;padding-r=
    ight:10px;padding-bottom:25px;padding-left:10px"><div align=3D"center">=
     <!--[if mso]><v:roundrect xmlns:v=3D"urn:schemas-microsoft-com:vml" xm=
    lns:w=3D"urn:schemas-microsoft-com:office:word" style=3D"height:42px;wi=
    dth:108px;v-text-anchor:middle;" arcsize=3D"10%" stroke=3D"false" fillc=
    olor=3D"#ffdb29"><w:anchorlock/><v:textbox inset=3D"0px,0px,0px,0px"><c=
    enter style=3D"color:#0377ea; font-family:Arial, sans-serif; font-size:=
    16px"><![endif]--><div style=3D"text-decoration:none;display:inline-blo=
    ck;color:#0377ea;background-color:#ffdb29;border-radius:4px;width:auto;=
    border-top:1px solid #ffdb29;border-right:1px solid #ffdb29;border-bott=
    om:1px solid #ffdb29;border-left:1px solid #ffdb29;padding-top:5px;padd=
    ing-bottom:5px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;te=
    xt-align:center;mso-border-alt:none;word-break:keep-all"><span style=3D=
    "padding-left:20px;padding-right:20px;font-size:16px;display:inline-blo=
    ck;letter-spacing:normal"> <span style=3D"font-size:16px;line-height:2;=
    word-break:break-word;mso-line-height-alt:32px">drive now</span></span>=
    </div><!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div=
    ></td></tr></table></th><th class=3D"column" width=3D"25%" style=3D"mso=
    -table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vert=
    ical-align:top;padding-right:10px"><table class=3D"text_block" width=3D=
    "100%" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"present=
    ation" style=3D"mso-table-lspace:0;mso-table-rspace:0;word-break:break-=
    word"><tr><td style=3D"padding-bottom:10px;padding-left:10px;padding-ri=
    ght:10px;padding-top:20px"><div style=3D"font-family:sans-serif"><div s=
    tyle=3D"font-size:12px;color:#fff;line-height:1.2;font-family:Arial,Hel=
    vetica Neue,Helvetica,sans-serif"><p style=3D"margin:0;font-size:12px">=
    <span style=3D"font-size:22px"><strong><span style=3D"">Price</span></s=
    trong></span></p></div></div></td></tr></table><table class=3D"text_blo=
    ck" width=3D"100%" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" rol=
    e=3D"presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0;word-=
    break:break-word"><tr><td style=3D"padding-left:10px;padding-right:10px=
    ;padding-bottom:10px"><div style=3D"font-family:sans-serif"><div style=3D=
    "font-size:12px;color:#fff;line-height:1.2;font-family:Arial,Helvetica =
    Neue,Helvetica,sans-serif"><p style=3D"margin:0;font-size:12px">disctan=
    ce</p></div></div></td></tr></table></th></tr></tbody></table></td></tr=
    ></tbody></table><table class=3D"row row-7" align=3D"center" width=3D"1=
    00%" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"presentat=
    ion" style=3D"mso-table-lspace:0;mso-table-rspace:0"><tbody><tr><td><ta=
    ble class=3D"row-content stack" align=3D"center" border=3D"0" cellpaddi=
    ng=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso-table-lsp=
    ace:0;mso-table-rspace:0;background-color:#0377ea" width=3D"600"><tbody=
    ><tr><th class=3D"column" width=3D"100%" style=3D"mso-table-lspace:0;ms=
    o-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;pad=
    ding-top:0;padding-bottom:0"><table class=3D"divider_block" width=3D"10=
    0%" border=3D"0" cellpadding=3D"5" cellspacing=3D"0" role=3D"presentati=
    on" style=3D"mso-table-lspace:0;mso-table-rspace:0"><tr><td><div align=3D=
    "center"><table border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D=
    "presentation" width=3D"90%" style=3D"mso-table-lspace:0;mso-table-rspa=
    ce:0"><tr><td class=3D"divider_inner" style=3D"font-size:1px;line-heigh=
    t:1px;border-top:1px solid #fff"><span></span></td></tr></table></div><=
    /td></tr></table></th></tr></tbody></table></td></tr></tbody></table><t=
    able class=3D"row row-8" align=3D"center" width=3D"100%" border=3D"0" c=
    ellpadding=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso-t=
    able-lspace:0;mso-table-rspace:0"><tbody><tr><td><table class=3D"row-co=
    ntent" align=3D"center" border=3D"0" cellpadding=3D"0" cellspacing=3D"0=
    " role=3D"presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0;=
    background-color:#0377ea" width=3D"600"><tbody><tr><th class=3D"column"=
     width=3D"33.333333333333336%" style=3D"mso-table-lspace:0;mso-table-rs=
    pace:0;font-weight:400;text-align:left;vertical-align:top;padding-left:=
    10px"><table class=3D"text_block" width=3D"100%" border=3D"0" cellpaddi=
    ng=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso-table-lsp=
    ace:0;mso-table-rspace:0;word-break:break-word"><tr><td style=3D"paddin=
    g-bottom:20px;padding-left:10px;padding-right:10px;padding-top:20px"><d=
    iv style=3D"font-family:sans-serif"><div style=3D"font-size:12px;color:=
    #fff;line-height:1.2;font-family:Arial,Helvetica Neue,Helvetica,sans-se=
    rif"><p style=3D"margin:0;font-size:12px;text-align:center"><span style=
    =3D"font-size:22px"><strong>Name of STatlino<br></strong></span></p></d=
    iv></div></td></tr></table></th><th class=3D"column" width=3D"41.666666=
    666666664%" style=3D"mso-table-lspace:0;mso-table-rspace:0;font-weight:=
    400;text-align:left;vertical-align:top"><table class=3D"button_block" w=
    idth=3D"100%" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"=
    presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0"><tr><td s=
    tyle=3D"text-align:center;padding-top:20px;padding-right:10px;padding-b=
    ottom:25px;padding-left:10px"><div align=3D"center"> <!--[if mso]><v:ro=
    undrect xmlns:v=3D"urn:schemas-microsoft-com:vml" xmlns:w=3D"urn:schema=
    s-microsoft-com:office:word" style=3D"height:42px;width:108px;v-text-an=
    chor:middle;" arcsize=3D"10%" stroke=3D"false" fillcolor=3D"#ffdb29"><w=
    :anchorlock/><v:textbox inset=3D"0px,0px,0px,0px"><center style=3D"colo=
    r:#0377ea; font-family:Arial, sans-serif; font-size:16px"><![endif]--><=
    div style=3D"text-decoration:none;display:inline-block;color:#0377ea;ba=
    ckground-color:#ffdb29;border-radius:4px;width:auto;border-top:1px soli=
    d #ffdb29;border-right:1px solid #ffdb29;border-bottom:1px solid #ffdb2=
    9;border-left:1px solid #ffdb29;padding-top:5px;padding-bottom:5px;font=
    -family:Arial,Helvetica Neue,Helvetica,sans-serif;text-align:center;mso=
    -border-alt:none;word-break:keep-all"><span style=3D"padding-left:20px;=
    padding-right:20px;font-size:16px;display:inline-block;letter-spacing:n=
    ormal"> <span style=3D"font-size:16px;line-height:2;word-break:break-wo=
    rd;mso-line-height-alt:32px">drive now</span></span></div><!--[if mso]>=
    </center></v:textbox></v:roundrect><![endif]--></div></td></tr></table>=
    </th><th class=3D"column" width=3D"25%" style=3D"mso-table-lspace:0;mso=
    -table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padd=
    ing-right:10px"><table class=3D"text_block" width=3D"100%" border=3D"0"=
     cellpadding=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso=
    -table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td style=
    =3D"padding-bottom:10px;padding-left:10px;padding-right:10px;padding-to=
    p:20px"><div style=3D"font-family:sans-serif"><div style=3D"font-size:1=
    2px;color:#fff;line-height:1.2;font-family:Arial,Helvetica Neue,Helveti=
    ca,sans-serif"><p style=3D"margin:0;font-size:12px"><span style=3D"font=
    -size:22px"><strong><span style=3D"">Price</span></strong></span></p></=
    div></div></td></tr></table><table class=3D"text_block" width=3D"100%" =
    border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"presentation" =
    style=3D"mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><=
    tr><td style=3D"padding-left:10px;padding-right:10px;padding-bottom:10p=
    x"><div style=3D"font-family:sans-serif"><div style=3D"font-size:12px;c=
    olor:#fff;line-height:1.2;font-family:Arial,Helvetica Neue,Helvetica,sa=
    ns-serif"><p style=3D"margin:0;font-size:12px">disctance</p></div></div=
    ></td></tr></table></th></tr></tbody></table></td></tr></tbody></table>=
    <table class=3D"row row-9" align=3D"center" width=3D"100%" border=3D"0"=
     cellpadding=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso=
    -table-lspace:0;mso-table-rspace:0"><tbody><tr><td><table class=3D"row-=
    content stack" align=3D"center" border=3D"0" cellpadding=3D"0" cellspac=
    ing=3D"0" role=3D"presentation" style=3D"mso-table-lspace:0;mso-table-r=
    space:0;background-color:#0377ea" width=3D"600"><tbody><tr><th class=3D=
    "column" width=3D"100%" style=3D"mso-table-lspace:0;mso-table-rspace:0;=
    font-weight:400;text-align:left;vertical-align:top;padding-top:0;paddin=
    g-bottom:0"><table class=3D"divider_block" width=3D"100%" border=3D"0" =
    cellpadding=3D"5" cellspacing=3D"0" role=3D"presentation" style=3D"mso-=
    table-lspace:0;mso-table-rspace:0"><tr><td><div align=3D"center"><table=
     border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D"presentation"=
     width=3D"90%" style=3D"mso-table-lspace:0;mso-table-rspace:0"><tr><td =
    class=3D"divider_inner" style=3D"font-size:1px;line-height:1px;border-t=
    op:1px solid #fff"><span></span></td></tr></table></div></td></tr></tab=
    le></th></tr></tbody></table></td></tr></tbody></table><table class=3D"=
    row row-10" align=3D"center" width=3D"100%" border=3D"0" cellpadding=3D=
    "0" cellspacing=3D"0" role=3D"presentation" style=3D"mso-table-lspace:0=
    ;mso-table-rspace:0"><tbody><tr><td><table class=3D"row-content stack" =
    align=3D"center" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" role=3D=
    "presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0;backgroun=
    d-color:#fff;background-image:url(https://d1oco4z2z1fhwp.cloudfront.net=
    /templates/default/4456/Blue_and_PaperPlane_Background.png);background-=
    position:center top;background-repeat:no-repeat" width=3D"600"><tbody><=
    tr><th class=3D"column" width=3D"100%" style=3D"mso-table-lspace:0;mso-=
    table-rspace:0;font-weight:400;text-align:left;vertical-align:top;paddi=
    ng-left:15px;padding-right:15px;padding-top:20px;padding-bottom:10px"><=
    div class=3D"spacer_block" style=3D"height:55px;line-height:55px">&#820=
    2;</div></th></tr></tbody></table></td></tr></tbody></table><table clas=
    s=3D"row row-11" align=3D"center" width=3D"100%" border=3D"0" cellpaddi=
    ng=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"mso-table-lsp=
    ace:0;mso-table-rspace:0"><tbody><tr><td><table class=3D"row-content st=
    ack" align=3D"center" border=3D"0" cellpadding=3D"0" cellspacing=3D"0" =
    role=3D"presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0" w=
    idth=3D"600"><tbody><tr><th class=3D"column" width=3D"100%" style=3D"ms=
    o-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;ver=
    tical-align:top;padding-top:5px;padding-bottom:5px"><table class=3D"ico=
    ns_block" width=3D"100%" border=3D"0" cellpadding=3D"0" cellspacing=3D"=
    0" role=3D"presentation" style=3D"mso-table-lspace:0;mso-table-rspace:0=
    "><tr><td style=3D"color:#9d9d9d;font-family:inherit;font-size:15px;pad=
    ding-bottom:5px;padding-top:5px;text-align:center"><table width=3D"100%=
    " cellpadding=3D"0" cellspacing=3D"0" role=3D"presentation" style=3D"ms=
    o-table-lspace:0;mso-table-rspace:0"><tr><td style=3D"text-align:center=
    "><!--[if vml]><table align=3D"left" cellpadding=3D"0" cellspacing=3D"0=
    " role=3D"presentation" style=3D"display:inline-block;padding-left:0px;=
    padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endi=
    f]--><!--[if !vml]><!--><table class=3D"icons-inner" style=3D"mso-table=
    -lspace:0;mso-table-rspace:0;display:inline-block;margin-right:-4px;pad=
    ding-left:0;padding-right:0" cellpadding=3D"0" cellspacing=3D"0" role=3D=
    "presentation"> <!--<![endif]--><tr><td style=3D"text-align:center;padd=
    ing-top:5px;padding-bottom:5px;padding-left:5px;padding-right:6px"><a h=
    ref=3D"https://www.designedwithbee.com/"><img class=3D"icon" alt=3D"Des=
    igned with BEE" src=3D"https://d15k2d11r6t6rl.cloudfront.net/public/use=
    rs/Integrators/BeeProAgency/53601_510656/Signature/bee.png" height=3D"3=
    2" width=3D"34" align=3D"center" style=3D"display:block;height:auto;bor=
    der:0"></a></td><td style=3D"font-family:Arial,Helvetica Neue,Helvetica=
    ,sans-serif;font-size:15px;color:#9d9d9d;vertical-align:middle;letter-s=
    pacing:undefined;text-align:center"><a href=3D"https://www.designedwith=
    bee.com/" style=3D"color:#9d9d9d;text-decoration:none">Designed with BE=
    E</a></td></tr></table></td></tr></table></td></tr></table></th></tr></=
    tbody></table></td></tr></tbody></table></td></tr></tbody></table><!-- =
    End --><table cellpadding=3D"0" cellspacing=3D"0" align=3D"center" widt=
    h=3D"100%" border=3D"0" style=3D"border-spacing: 0;border-collapse: col=
    lapse;vertical-align: top">
                    <tbody><tr style=3D"vertical-align: top">
                      <td style=3D"word-break: break-word; vertical-align: =
    top; background-color: rgb(147, 211, 237); border-collapse: collapse !i=
    mportant; width: 100%;">
                        
                        <!--[if gte mso 9]>
                        <table id=3D"outlookholder" border=3D"0" cellspacin=
    g=3D"0" cellpadding=3D"0" align=3D"center"><tr><td>
                        <![endif]-->
                        <!--[if (IE)]>
                        <table width=3D"700" align=3D"center" cellpadding=3D=
    "0" cellspacing=3D"0" border=3D"0">
                            <tr>
                                <td>
                        <![endif]-->
                        
                        <table cellpadding=3D"0" cellspacing=3D"0" align=3D=
    "center" width=3D"100%" border=3D"0" class=3D"container" style=3D"borde=
    r-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 7=
    00px;margin: 0 auto;text-align: inherit"><tbody><tr style=3D"vertical-a=
    lign: top"><td style=3D"word-break: break-word; vertical-align: top; bo=
    rder-collapse: collapse !important; width: 100%;"><table cellpadding=3D=
    "0" cellspacing=3D"0" width=3D"100%" class=3D"block-grid " style=3D"bor=
    der-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100=
    %;max-width: 700px;color: #000000;background-color: transparent"><tbody=
    ><tr style=3D"vertical-align: top"><td style=3D"word-break: break-word;=
    border-collapse: collapse !important;vertical-align: top;background-col=
    or: transparent;text-align: center;font-size: 0"><!--[if (gte mso 9)|(I=
    E)]><table width=3D"100%" align=3D"center" bgcolor=3D"transparent" cell=
    padding=3D"0" cellspacing=3D"0" border=3D"0"><tr><![endif]--><!--[if (g=
    te mso 9)|(IE)]><td valign=3D"top" width=3D"700" style=3D"width:700px;"=
    ><![endif]--><div class=3D"col num12" style=3D"display: inline-block;ve=
    rtical-align: top;width: 100%"><table cellpadding=3D"0" cellspacing=3D"=
    0" align=3D"center" width=3D"100%" border=3D"0" style=3D"border-spacing=
    : 0;border-collapse: collapse;vertical-align: top"><tbody><tr style=3D"=
    vertical-align: top"><td style=3D"word-break: break-word;border-collaps=
    e: collapse !important;vertical-align: top;background-color: transparen=
    t;padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left:=
     0px;border-top: 0px solid transparent;border-right: 0px solid transpar=
    ent;border-bottom: 4px solid #93D3ED;border-left: 0px solid transparent=
    "><table align=3D"center" width=3D"100%" border=3D"0" cellpadding=3D"0"=
     cellspacing=3D"0" style=3D"border-spacing: 0;border-collapse: collapse=
    ;vertical-align: top">
      <tbody><tr style=3D"vertical-align: top">
        <td align=3D"center" style=3D"word-break: break-word;border-collaps=
    e: collapse !important;vertical-align: top;padding-top: 0px;padding-rig=
    ht: 0px;padding-bottom: 0px;padding-left: 0px">
          <div style=3D"height: 0px;">
            <table align=3D"center" border=3D"0" cellspacing=3D"0" style=3D=
    "border-spacing: 0;border-collapse: collapse;vertical-align: top;border=
    -top: 0px solid transparent;width: 100%"><tbody><tr style=3D"vertical-a=
    lign: top"><td align=3D"center" style=3D"word-break: break-word;border-=
    collapse: collapse !important;vertical-align: top"></td></tr></tbody></=
    table>
          </div>
        </td>
      </tr>
    </tbody></table>
    </td></tr></tbody></table></div><!--[if (gte mso 9)|(IE)]></td><![endif=
    ]--><!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]--></td></tr><=
    /tbody></table></td></tr></tbody></table>
                        <!--[if mso]>
                        </td></tr></table>
                        <![endif]-->
                        <!--[if (IE)]>
                        </td></tr></table>
                        <![endif]-->
                        
                      </td>
                    </tr>
                  </tbody></table>
                  <table cellpadding=3D"0" cellspacing=3D"0" align=3D"cente=
    r" width=3D"100%" border=3D"0" style=3D"border-spacing: 0;border-collap=
    se: collapse;vertical-align: top">
                    <tbody><tr style=3D"vertical-align: top">
                      <td style=3D"word-break: break-word; vertical-align: =
    top; background-color: rgb(94, 94, 94); border-collapse: collapse !impo=
    rtant; width: 100%;">
                        
                        <!--[if gte mso 9]>
                        <table id=3D"outlookholder" border=3D"0" cellspacin=
    g=3D"0" cellpadding=3D"0" align=3D"center"><tr><td>
                        <![endif]-->
                        <!--[if (IE)]>
                        <table width=3D"700" align=3D"center" cellpadding=3D=
    "0" cellspacing=3D"0" border=3D"0">
                            <tr>
                                <td>
                        <![endif]-->
                        
                        <table cellpadding=3D"0" cellspacing=3D"0" align=3D=
    "center" width=3D"100%" border=3D"0" class=3D"container" style=3D"borde=
    r-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 7=
    00px;margin: 0 auto;text-align: inherit"><tbody><tr style=3D"vertical-a=
    lign: top"><td style=3D"word-break: break-word; vertical-align: top; bo=
    rder-collapse: collapse !important; width: 100%;"><table cellpadding=3D=
    "0" cellspacing=3D"0" width=3D"100%" class=3D"block-grid " style=3D"bor=
    der-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100=
    %;max-width: 700px;color: #000000;background-color: transparent"><tbody=
    ><tr style=3D"vertical-align: top"><td style=3D"word-break: break-word;=
    border-collapse: collapse !important;vertical-align: top;background-col=
    or: transparent;text-align: center;font-size: 0"><!--[if (gte mso 9)|(I=
    E)]><table width=3D"100%" align=3D"center" bgcolor=3D"transparent" cell=
    padding=3D"0" cellspacing=3D"0" border=3D"0"><tr><![endif]--><!--[if (g=
    te mso 9)|(IE)]><td valign=3D"top" width=3D"700" style=3D"width:700px;"=
    ><![endif]--><div class=3D"col num12" style=3D"display: inline-block;ve=
    rtical-align: top;width: 100%"><table cellpadding=3D"0" cellspacing=3D"=
    0" align=3D"center" width=3D"100%" border=3D"0" style=3D"border-spacing=
    : 0;border-collapse: collapse;vertical-align: top"><tbody><tr style=3D"=
    vertical-align: top"><td style=3D"word-break: break-word;border-collaps=
    e: collapse !important;vertical-align: top;background-color: transparen=
    t;padding-top: 5px;padding-right: 0px;padding-bottom: 5px;padding-left:=
     0px;border-top: 0px solid transparent;border-right: 0px solid transpar=
    ent;border-bottom: 0px solid transparent;border-left: 0px solid transpa=
    rent"><table cellpadding=3D"0" cellspacing=3D"0" width=3D"100%" style=3D=
    "border-spacing: 0;border-collapse: collapse;vertical-align: top">
      <tbody><tr style=3D"vertical-align: top">
        <td style=3D"word-break: break-word;border-collapse: collapse !impo=
    rtant;vertical-align: top;padding-top: 20px;padding-right: 15px;padding=
    -bottom: 20px;padding-left: 15px">
          <div style=3D"color:#93d3ed;line-height:180%;font-family: 'Lucida=
     Sans Unicode', 'Lucida Grande', 'Lucida Sans', Geneva, Verdana, sans-s=
    erif;">
          <div style=3D"font-size:12px;line-height:22px;color:#93d3ed;font-=
    family:'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Geneva, V=
    erdana, sans-serif;text-align:left;"><p style=3D"margin: 0;font-size: 1=
    2px;line-height: 22px;text-align: center">Test message sent using the '=
    Send a test' feature on&nbsp;<a style=3D"color:#93d3ed;text-decoration:=
     underline;" title=3D"beefree.io" href=3D"https://beefree.io/" target=3D=
    "_blank">beefree.io</a>, a free online email editor.</p><p style=3D"mar=
    gin: 0;font-size: 12px;line-height: 21px;text-align: center">If someone=
     is abusing our system and sending unsolicited messages to you, <a styl=
    e=3D"color:#93d3ed;text-decoration: underline;" href=3D"https://custome=
    r61127.musvc2.net/e/u?q=3D5%3dHV6TI%26G%3d6%26F%3dFa7ZE%26J%3d8THc0Y%26=
    t%3dV9VH6BUG-cA8E-Y07o-6jWJ-897GaCarVf7D%260%3dr3uGDa_4vXr_FeuG5OjG.y0%=
    26nK%3dGWEUH%26L%3dkSmWl.7y6nD53m6fK.hGy%269%3drM5QhT.z0y%26L%3d-Dd9UFZ=
    8ZL&mupckp=3DmupAtu4m8OiX0wt" target=3D"_blank">click here to unsubscri=
    be</a>. </p><p style=3D"margin: 0;font-size: 12px;line-height: 21px;tex=
    t-align: center">We will also be notified and go after them. &nbsp;</p>=
    </div>
          </div>
        </td>
      </tr>
    </tbody></table>
    </td></tr></tbody></table></div><!--[if (gte mso 9)|(IE)]></td><![endif=
    ]--><!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]--></td></tr><=
    /tbody></table></td></tr></tbody></table>
                        <!--[if mso]>
                        </td></tr></table>
                        <![endif]-->
                        <!--[if (IE)]>
                        </td></tr></table>
                        <![endif]-->
                        
                      </td>
                    </tr>
                  </tbody></table></body></html>'




































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
        $message .= '<p style="color:#080;font-size:18px;background-color: #808080;"><a href="http://maps.google.com/maps?q=loc:' . $final_stations[0]->lat . ',' . $final_stations[0]->lng . '">Losfahren!</a></p>';
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