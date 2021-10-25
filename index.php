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





    $header = '<!DOCTYPE html>

    <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
    <title></title>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
    <!--<![endif]-->
    <style>
            * {
                box-sizing: border-box;
            }
    
            body {
                margin: 0;
                padding: 0;
            }
    
            th.column {
                padding: 0
            }
    
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: inherit !important;
            }
    
            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
            }
    
            p {
                line-height: inherit
            }
    
            @media (max-width:620px) {
                .icons-inner {
                    text-align: center;
                }
    
                .icons-inner td {
                    margin: 0 auto;
                }
    
                .row-content {
                    width: 100% !important;
                }
    
                .image_block img.big {
                    width: auto !important;
                }
    
                .stack .column {
                    width: 100%;
                    display: block;
                }
            }
        </style>
    </head>';

    $first_station = '
    <body
      style="
        background-color: #e1e4e9;
        margin: 0;
        padding: 0;
        -webkit-text-size-adjust: none;
        text-size-adjust: none;
      "
    >
      <table
        border="0"
        cellpadding="0"
        cellspacing="0"
        class="nl-container"
        role="presentation"
        style="
          mso-table-lspace: 0pt;
          mso-table-rspace: 0pt;
          background-color: #e1e4e9;
        "
        width="100%"
      >
        <tbody>
          <tr>
            <td>
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-1"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content"
                        role="presentation"
                        style="
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          background-color: #ffffff;
                        "
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-top: 0px;
                                padding-bottom: 0px;
                              "
                              width="100%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="empty_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td>
                                    <div></div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-2"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content stack"
                        role="presentation"
                        style="
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          background-color: #0377ea;
                        "
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-top: 10px;
                                padding-bottom: 10px;
                              "
                              width="100%"
                            >
                              <table
                                border="0"
                                cellpadding="10"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td>
                                    <div style="font-family: serif">
                                      <div
                                        style="
                                          font-size: 14px;
                                          font-family: \'Merriwheater\', \'Georgia\',
                                            serif;
                                          color: #ffffff;
                                          line-height: 1.2;
                                        "
                                      >
                                        <p
                                          style="
                                            margin: 0;
                                            font-size: 14px;
                                            text-align: center;
                                          "
                                        >
                                          <span style="font-size: 30px"
                                            >Best Price here:<br
                                          /></span>
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-3"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content"
                        role="presentation"
                        style="
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          background-color: #ffffff;
                        "
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-left: 10px;
                              "
                              width="33.333333333333336%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      padding-bottom: 20px;
                                      padding-left: 10px;
                                      padding-right: 10px;
                                      padding-top: 30px;
                                    "
                                  >
                                    <div style="font-family: sans-serif">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #00255b;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                        "
                                      >
                                        <p
                                          style="
                                            margin: 0;
                                            font-size: 12px;
                                            text-align: center;
                                          "
                                        >
                                          <span style="font-size: 22px"
                                            ><strong>Station Name<br /></strong
                                          ></span>
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                              "
                              width="41.666666666666664%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="button_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      text-align: center;
                                      padding-top: 30px;
                                      padding-right: 10px;
                                      padding-bottom: 25px;
                                      padding-left: 10px;
                                    "
                                  >
                                    <div align="center">
                                      <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" style="height:42px;width:108px;v-text-anchor:middle;" arcsize="10%" stroke="false" fillcolor="#ffdb29"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:16px"><![endif]-->
                                      <div
                                        style="
                                          text-decoration: none;
                                          display: inline-block;
                                          color: #ffffff;
                                          background-color: #ffdb29;
                                          border-radius: 4px;
                                          width: auto;
                                          border-top: 1px solid #ffdb29;
                                          border-right: 1px solid #ffdb29;
                                          border-bottom: 1px solid #ffdb29;
                                          border-left: 1px solid #ffdb29;
                                          padding-top: 5px;
                                          padding-bottom: 5px;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                          text-align: center;
                                          mso-border-alt: none;
                                          word-break: keep-all;
                                        "
                                      >
                                        <span
                                          style="
                                            padding-left: 20px;
                                            padding-right: 20px;
                                            font-size: 16px;
                                            display: inline-block;
                                            letter-spacing: normal;
                                          "
                                          ><span
                                            style="
                                              font-size: 16px;
                                              line-height: 2;
                                              word-break: break-word;
                                              mso-line-height-alt: 32px;
                                            "
                                            >drive now</span
                                          ></span
                                        >
                                      </div>
                                      <!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-right: 10px;
                              "
                              width="25%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      padding-bottom: 10px;
                                      padding-left: 10px;
                                      padding-right: 10px;
                                      padding-top: 30px;
                                    "
                                  >
                                    <div style="font-family: sans-serif">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #00255b;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                        "
                                      >
                                        <p style="margin: 0; font-size: 12px">
                                          <span style="font-size: 22px"
                                            ><strong
                                              ><span style="">Price</span></strong
                                            ></span
                                          >
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      padding-left: 10px;
                                      padding-right: 10px;
                                      padding-bottom: 10px;
                                    "
                                  >
                                    <div style="font-family: sans-serif">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #00255b;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                        "
                                      >
                                        distance
                                        <p
                                          style="
                                            margin: 0;
                                            font-size: 12px;
                                            mso-line-height-alt: 14.399999999999999px;
                                          "
                                        >
                                           
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>';

    $image = '
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-4"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content stack"
                        role="presentation"
                        style="
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          background-color: #ffffff;
                        "
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-top: 0px;
                                padding-bottom: 0px;
                              "
                              width="100%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="image_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      width: 100%;
                                      padding-right: 0px;
                                      padding-left: 0px;
                                    "
                                  >
                                    <div align="center" style="line-height: 10px">
                                      <img
                                        alt="Karte"
                                        class="big"
                                        src="images/Airplane_fIRST_Image_.png"
                                        style="
                                          display: block;
                                          height: auto;
                                          border: 0;
                                          width: 600px;
                                          max-width: 100%;
                                        "
                                        title="Karte"
                                        width="600"
                                      />
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>';
        $info = '
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-5"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content stack"
                        role="presentation"
                        style="
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          background-color: #0377ea;
                        "
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-left: 15px;
                                padding-right: 15px;
                                padding-top: 20px;
                                padding-bottom: 5px;
                              "
                              width="100%"
                            >
                              <table
                                border="0"
                                cellpadding="10"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td>
                                    <div style="font-family: serif">
                                      <div
                                        style="
                                          font-size: 14px;
                                          font-family: \'Merriwheater\', \'Georgia\',
                                            serif;
                                          color: #ffffff;
                                          line-height: 1.2;
                                        "
                                      >
                                        <p
                                          style="
                                            margin: 0;
                                            font-size: 14px;
                                            text-align: center;
                                          "
                                        >
                                          <span style="font-size: 30px"
                                            >Lowest prices at this stations<br
                                          /></span>
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                              <table
                                border="0"
                                cellpadding="10"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td>
                                    <div style="font-family: sans-serif">
                                      <div
                                        style="
                                          font-size: 14px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                        "
                                      >
                                        <p
                                          style="
                                            margin: 0;
                                            font-size: 14px;
                                            text-align: center;
                                          "
                                        >
                                          This stations are also lower than your
                                          threnshold (or a litle bit higher)
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>';

        $single_station = '
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-6"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content"
                        role="presentation"
                        style="
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          background-color: #0377ea;
                        "
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-left: 10px;
                              "
                              width="33.333333333333336%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      padding-bottom: 20px;
                                      padding-left: 10px;
                                      padding-right: 10px;
                                      padding-top: 20px;
                                    "
                                  >
                                    <div style="font-family: sans-serif">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                        "
                                      >
                                        <p
                                          style="
                                            margin: 0;
                                            font-size: 12px;
                                            text-align: center;
                                          "
                                        >
                                          <span style="font-size: 22px"
                                            ><strong
                                              >Name of Station long version<br /></strong
                                          ></span>
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                              "
                              width="41.666666666666664%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="button_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      text-align: center;
                                      padding-top: 20px;
                                      padding-right: 10px;
                                      padding-bottom: 25px;
                                      padding-left: 10px;
                                    "
                                  >
                                    <div align="center">
                                      <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" style="height:42px;width:108px;v-text-anchor:middle;" arcsize="10%" stroke="false" fillcolor="#ffdb29"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#0377ea; font-family:Arial, sans-serif; font-size:16px"><![endif]-->
                                      <div
                                        style="
                                          text-decoration: none;
                                          display: inline-block;
                                          color: #0377ea;
                                          background-color: #ffdb29;
                                          border-radius: 4px;
                                          width: auto;
                                          border-top: 1px solid #ffdb29;
                                          border-right: 1px solid #ffdb29;
                                          border-bottom: 1px solid #ffdb29;
                                          border-left: 1px solid #ffdb29;
                                          padding-top: 5px;
                                          padding-bottom: 5px;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                          text-align: center;
                                          mso-border-alt: none;
                                          word-break: keep-all;
                                        "
                                      >
                                        <span
                                          style="
                                            padding-left: 20px;
                                            padding-right: 20px;
                                            font-size: 16px;
                                            display: inline-block;
                                            letter-spacing: normal;
                                          "
                                          ><span
                                            style="
                                              font-size: 16px;
                                              line-height: 2;
                                              word-break: break-word;
                                              mso-line-height-alt: 32px;
                                            "
                                            >drive now</span
                                          ></span
                                        >
                                      </div>
                                      <!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-right: 10px;
                              "
                              width="25%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      padding-bottom: 10px;
                                      padding-left: 10px;
                                      padding-right: 10px;
                                      padding-top: 20px;
                                    "
                                  >
                                    <div style="font-family: sans-serif">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                        "
                                      >
                                        <p style="margin: 0; font-size: 12px">
                                          <span style="font-size: 22px"
                                            ><strong
                                              ><span style="">Price</span></strong
                                            ></span
                                          >
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      padding-left: 10px;
                                      padding-right: 10px;
                                      padding-bottom: 10px;
                                    "
                                  >
                                    <div style="font-family: sans-serif">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                        "
                                      >
                                        <p style="margin: 0; font-size: 12px">
                                          disctance
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>';

            $second_station = '
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-7"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content stack"
                        role="presentation"
                        style="
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          background-color: #0377ea;
                        "
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-top: 0px;
                                padding-bottom: 0px;
                              "
                              width="100%"
                            >
                              <table
                                border="0"
                                cellpadding="5"
                                cellspacing="0"
                                class="divider_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td>
                                    <div align="center">
                                      <table
                                        border="0"
                                        cellpadding="0"
                                        cellspacing="0"
                                        role="presentation"
                                        style="
                                          mso-table-lspace: 0pt;
                                          mso-table-rspace: 0pt;
                                        "
                                        width="90%"
                                      >
                                        <tr>
                                          <td
                                            class="divider_inner"
                                            style="
                                              font-size: 1px;
                                              line-height: 1px;
                                              border-top: 1px solid #ffffff;
                                            "
                                          >
                                            <span></span>
                                          </td>
                                        </tr>
                                      </table>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-8"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content"
                        role="presentation"
                        style="
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          background-color: #0377ea;
                        "
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-left: 10px;
                              "
                              width="33.333333333333336%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      padding-bottom: 20px;
                                      padding-left: 10px;
                                      padding-right: 10px;
                                      padding-top: 20px;
                                    "
                                  >
                                    <div style="font-family: sans-serif">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                        "
                                      >
                                        <p
                                          style="
                                            margin: 0;
                                            font-size: 12px;
                                            text-align: center;
                                          "
                                        >
                                          <span style="font-size: 22px"
                                            ><strong
                                              >Name of STatlino<br /></strong
                                          ></span>
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                              "
                              width="41.666666666666664%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="button_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      text-align: center;
                                      padding-top: 20px;
                                      padding-right: 10px;
                                      padding-bottom: 25px;
                                      padding-left: 10px;
                                    "
                                  >
                                    <div align="center">
                                      <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" style="height:42px;width:108px;v-text-anchor:middle;" arcsize="10%" stroke="false" fillcolor="#ffdb29"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#0377ea; font-family:Arial, sans-serif; font-size:16px"><![endif]-->
                                      <div
                                        style="
                                          text-decoration: none;
                                          display: inline-block;
                                          color: #0377ea;
                                          background-color: #ffdb29;
                                          border-radius: 4px;
                                          width: auto;
                                          border-top: 1px solid #ffdb29;
                                          border-right: 1px solid #ffdb29;
                                          border-bottom: 1px solid #ffdb29;
                                          border-left: 1px solid #ffdb29;
                                          padding-top: 5px;
                                          padding-bottom: 5px;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                          text-align: center;
                                          mso-border-alt: none;
                                          word-break: keep-all;
                                        "
                                      >
                                        <span
                                          style="
                                            padding-left: 20px;
                                            padding-right: 20px;
                                            font-size: 16px;
                                            display: inline-block;
                                            letter-spacing: normal;
                                          "
                                          ><span
                                            style="
                                              font-size: 16px;
                                              line-height: 2;
                                              word-break: break-word;
                                              mso-line-height-alt: 32px;
                                            "
                                            ><a href="href="http://maps.google.com/maps?q=loc:' . $final_stations[0]->lat . ',' . $final_stations[0]->lng . '"">Drive Now</a></span
                                          ></span
                                        >
                                      </div>
                                      <!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-right: 10px;
                              "
                              width="25%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      padding-bottom: 10px;
                                      padding-left: 10px;
                                      padding-right: 10px;
                                      padding-top: 20px;
                                    "
                                  >
                                    <div style="font-family: sans-serif">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                        "
                                      >
                                        <p style="margin: 0; font-size: 12px">
                                          <span style="font-size: 22px"
                                            ><strong
                                              ><span style="">Price</span></strong
                                            ></span
                                          >
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="text_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                  word-break: break-word;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      padding-left: 10px;
                                      padding-right: 10px;
                                      padding-bottom: 10px;
                                    "
                                  >
                                    <div style="font-family: sans-serif">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serif;
                                        "
                                      >
                                        <p style="margin: 0; font-size: 12px">
                                          disctance
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>';


            $end = '
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-9"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content stack"
                        role="presentation"
                        style="
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          background-color: #0377ea;
                        "
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-top: 0px;
                                padding-bottom: 0px;
                              "
                              width="100%"
                            >
                              <table
                                border="0"
                                cellpadding="5"
                                cellspacing="0"
                                class="divider_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td>
                                    <div align="center">
                                      <table
                                        border="0"
                                        cellpadding="0"
                                        cellspacing="0"
                                        role="presentation"
                                        style="
                                          mso-table-lspace: 0pt;
                                          mso-table-rspace: 0pt;
                                        "
                                        width="90%"
                                      >
                                        <tr>
                                          <td
                                            class="divider_inner"
                                            style="
                                              font-size: 1px;
                                              line-height: 1px;
                                              border-top: 1px solid #ffffff;
                                            "
                                          >
                                            <span></span>
                                          </td>
                                        </tr>
                                      </table>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-10"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content stack"
                        role="presentation"
                        style="
                          mso-table-lspace: 0pt;
                          mso-table-rspace: 0pt;
                          background-color: #ffffff;
                          background-image: url(\'images/Blue_and_PaperPlane_Background.png\');
                          background-position: center top;
                          background-repeat: no-repeat;
                        "
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-left: 15px;
                                padding-right: 15px;
                                padding-top: 20px;
                                padding-bottom: 10px;
                              "
                              width="100%"
                            >
                              <div
                                class="spacer_block"
                                style="height: 55px; line-height: 55px"
                              >
                                 
                              </div>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table
                align="center"
                border="0"
                cellpadding="0"
                cellspacing="0"
                class="row row-11"
                role="presentation"
                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                width="100%"
              >
                <tbody>
                  <tr>
                    <td>
                      <table
                        align="center"
                        border="0"
                        cellpadding="0"
                        cellspacing="0"
                        class="row-content stack"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
                        width="600"
                      >
                        <tbody>
                          <tr>
                            <th
                              class="column"
                              style="
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                                font-weight: 400;
                                text-align: left;
                                vertical-align: top;
                                padding-top: 5px;
                                padding-bottom: 5px;
                              "
                              width="100%"
                            >
                              <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                class="icons_block"
                                role="presentation"
                                style="
                                  mso-table-lspace: 0pt;
                                  mso-table-rspace: 0pt;
                                "
                                width="100%"
                              >
                                <tr>
                                  <td
                                    style="
                                      color: #9d9d9d;
                                      font-family: inherit;
                                      font-size: 15px;
                                      padding-bottom: 5px;
                                      padding-top: 5px;
                                      text-align: center;
                                    "
                                  >
                                    <table
                                      cellpadding="0"
                                      cellspacing="0"
                                      role="presentation"
                                      style="
                                        mso-table-lspace: 0pt;
                                        mso-table-rspace: 0pt;
                                      "
                                      width="100%"
                                    >
                                      <tr>
                                        <td style="text-align: center">
                                          <!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
                                          <!--[if !vml]><!-->
                                          <table
                                            cellpadding="0"
                                            cellspacing="0"
                                            class="icons-inner"
                                            role="presentation"
                                            style="
                                              mso-table-lspace: 0pt;
                                              mso-table-rspace: 0pt;
                                              display: inline-block;
                                              margin-right: -4px;
                                              padding-left: 0px;
                                              padding-right: 0px;
                                            "
                                          >
                                            <!--<![endif]-->
                                            <tr>
                                              <td
                                                style="
                                                  text-align: center;
                                                  padding-top: 5px;
                                                  padding-bottom: 5px;
                                                  padding-left: 5px;
                                                  padding-right: 6px;
                                                "
                                              >
                                                <a
                                                  href="https://www.designedwithbee.com/"
                                                  ><img
                                                    align="center"
                                                    alt="Designed with BEE"
                                                    class="icon"
                                                    height="32"
                                                    src="images/bee.png"
                                                    style="
                                                      display: block;
                                                      height: auto;
                                                      border: 0;
                                                    "
                                                    width="34"
                                                /></a>
                                              </td>
                                              <td
                                                style="
                                                  font-family: Arial,
                                                    Helvetica Neue, Helvetica,
                                                    sans-serif;
                                                  font-size: 15px;
                                                  color: #9d9d9d;
                                                  vertical-align: middle;
                                                  letter-spacing: undefined;
                                                  text-align: center;
                                                "
                                              >
                                                <a
                                                  href="https://www.designedwithbee.com/"
                                                  style="
                                                    color: #9d9d9d;
                                                    text-decoration: none;
                                                  "
                                                  >Designed with BEE</a
                                                >
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- End -->
    </body>
  </html>';
  


































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

        $message = $header . $first_station . $image;
        
        foreach ($final_stations as $station) {
            # code...
        }

        $message .= $end;
        
        // Compose a simple HTML email message
        /*
        $message = '<html><body>';
        $message .= '<h1 style="color:#f40;">Hi '.$name.'</h1>';
        $message .= '<p style="color:#080;font-size:18px;">Tanke jetzt!</p>';
        $message .= '<p style="color:#080;font-size:18px;background-color: #808080;"><a href="http://maps.google.com/maps?q=loc:' . $final_stations[0]->lat . ',' . $final_stations[0]->lng . '">Losfahren!</a></p>';
        $message .= print_r($final_stations, true);
        $message .= '</body></html>';*/
        
        if (mail($to , $subject, $message, $headers)){
            echo("Mail send");
        }
        else {
            echo("Error: Mail not send");
        }
    }
    
?>