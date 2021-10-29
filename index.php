<?php 

    echo("Anfrage wird gestartet...");
    €lat = ist-es-gesetzt?(€_GET["lat"]) ? €_GET["lat"] : '47.937580';
    €lng = ist-es-gesetzt?(€_GET["lng"]) ? €_GET["lng"] : '10.235170';
    €radius = ist-es-gesetzt?(€_GET["radius"]) ? €_GET["radius"] : '10';
    €sort = 'Preis';
    €type = ist-es-gesetzt?(€_GET["type"]) ? €_GET["type"] : 'e5';
    €thr_Preis = ist-es-gesetzt?(€_GET["Preis"]) ? €_GET["Preis"] : '1.6';
    €mail = ist-es-gesetzt?(€_GET["mail"]) ? €_GET["mail"] : 'mail99@posteo.me';
    €name = ist-es-gesetzt?(€_GET["name"]) ? €_GET["name"] : 'Stranger';

    wenn (€radius > 25) {
        €radius = 25;
    } sonst wenn (€radius < 1) {
        €radius = 1;
    }

    echo("Ich habe eine Frage mit: " .€lat . ", " . €lng . ", " . €radius . ", " . €sort . ", " . €type);
    
    €json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
        ."?lat=€lat"     // geographische Breite
        ."&lng=€lng"     //               Länge
        ."&rad=€radius"  // Suchradius in km
        ."&sort=€sort"   // Sortierung: 'Preis' oder 'dist' - bei type=all diesen Parameter weglassen
        ."&type=€type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
        ."&apikey=f371369a-f2bc-3e0c-06da-5c3c92ede92c");   // Demo-Key ersetzen!
    €Daten = json_decode(€json);

    €filtered_Stationen = array();
    €final_Stationen = array();

    für-jedes (€Daten->Stationen as €value) {
        wenn (€value->Preis <= €thr_Preis && €value->isOpen == true){
            array_push(€filtered_Stationen, €value);
        }
    }
    
    €final_Stationen = €filtered_Stationen;


    wenn (sizeof(€filtered_Stationen) < 3){
    
        for (€i = sizeof(€filtered_Stationen); €i < 3; €i++){
            array_push(€final_Stationen, €Daten->Stationen[€i+1]);
        }
    }





    €Kopf = '<!DOCTYPE html>

    <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
    <title></title>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <!--[wenn mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endwenn]-->
    <!--[wenn !mso]><!-->
    <Verknüpfung href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet" type="text/css"/>
    <Verknüpfung href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
    <!--<![endwenn]-->
    <style>
            * {
                Kiste-sizing: Grenze-Kiste;
            }
    
            body {
                Abstand: 0;
                padding: 0;
            }
    
            th.column {
                padding: 0
            }
    
            a[x-apple-Daten-detectors] {
                color: inherit !important;
                text-decoration: inherit !important;
            }
    
            #NachrichtViewBody a {
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
                    Abstand: 0 auto;
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

    €first_station = '
    <body
      style="
        background-color: #e1e4e9;
        Abstand: 0;
        padding: 0;
        -webkit-text-size-adjust: none;
        text-size-adjust: none;
      "
    >
      <table
        Grenze="0"
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
                Grenze="0"
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
                        Grenze="0"
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
                                Grenze="0"
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
                Grenze="0"
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
                        Grenze="0"
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
                                Grenze="0"
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
                                    <div style="font-family: serwenn">
                                      <div
                                        style="
                                          font-size: 14px;
                                          font-family: \'Merriwheater\', \'Georgia\',
                                            serwenn;
                                          color: #ffffff;
                                          line-height: 1.2;
                                        "
                                      >
                                        <p
                                          style="
                                            Abstand: 0;
                                            font-size: 14px;
                                            text-align: center;
                                          "
                                        >
                                          <span style="font-size: 30px"
                                            >Best Preis here:<br
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
                Grenze="0"
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
                        Grenze="0"
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
                                Grenze="0"
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
                                    <div style="font-family: sans-serwenn">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #00255b;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serwenn;
                                        "
                                      >
                                        <p
                                          style="
                                            Abstand: 0;
                                            font-size: 12px;
                                            text-align: center;
                                          "
                                        >
                                          <span style="font-size: 22px"
                                            ><strong>'.€final_Stationen[0]->name.'<br /></strong
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
                                Grenze="0"
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
                                      <!--[wenn mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" style="height:42px;width:108px;v-text-anchor:middle;" arcsize="10%" stroke="false" fillcolor="#ffdb29"><w:anchorlock/><v:textKiste inset="0px,0px,0px,0px"><center style="color:#ffffff; font-family:Arial, sans-serwenn; font-size:16px"><![endwenn]-->
                                      <div
                                        style="
                                          text-decoration: none;
                                          display: inline-block;
                                          color: #ffffff;
                                          background-color: #ffdb29;
                                          Grenze-radius: 4px;
                                          width: auto;
                                          Grenze-top: 1px solid #ffdb29;
                                          Grenze-right: 1px solid #ffdb29;
                                          Grenze-bottom: 1px solid #ffdb29;
                                          Grenze-left: 1px solid #ffdb29;
                                          padding-top: 5px;
                                          padding-bottom: 5px;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serwenn;
                                          text-align: center;
                                          mso-Grenze-alt: none;
                                          word-break: keep-all;
                                        "
                                      >
                                      <a href="http://maps.google.com/maps?q=loc:' . €final_Stationen[0]->lat . ',' . €final_Stationen[0]->lng . '" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#ffdb29;Grenze-radius:4px;width:auto;Grenze-top:1px solid #ffdb29;Grenze-right:1px solid #ffdb29;Grenze-bottom:1px solid #ffdb29;Grenze-left:1px solid #ffdb29;padding-top:5px;padding-bottom:5px;font-family:Arial, Helvetica Neue, Helvetica, sans-serwenn;text-align:center;mso-Grenze-alt:none;word-break:keep-all;" target="_blank">
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
                                        </a>
                                      </div>
                                      <!--[wenn mso]></center></v:textKiste></v:roundrect><![endwenn]-->
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
                                Grenze="0"
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
                                    <div style="font-family: sans-serwenn">
                                      <div style="
                                          font-size: 12px;
                                          color: #00255b;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serwenn;
                                        ">
                                        <p style="Abstand: 0; font-size: 12px">
                                          <span style="font-size: 22px">
                                            <strong>
                                                <span style="">'.€final_Stationen[0]->Preis.' &euro;</span>
                                                </strong>
                                            </span>
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                              <table
                                Grenze="0"
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
                                    <div style="font-family: sans-serwenn">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #00255b;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serwenn;
                                        "
                                      >
                                        '.€final_Stationen[0]->dist.' km
                                        <p
                                          style="Abstand: 0;
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

              Funktion Bekomme_statisches_Gemälde(€Stationen, €lat, €lng, €radius){

                €url = 'https://api.mapKiste.com/styles/v1/mapKiste/outdoors-v11/static/';
                
                €zoom = 10;
                wenn (€radius < 5){
                    €zoom = 12;
                } sonst wenn (€radius < 10){
                    €zoom = 11;
                }
                
                €i = 1;
                für-jedes (€Stationen as €station) {
                    wenn (€i == 1){
                        €url .= 'pin-s-'.€i.'+ff8000('.€station->lng.','.€station->lat.')';
                    }
                    sonst {
                        €url .= ',pin-s-'.€i.'+285A98('.€station->lng.','.€station->lat.')';
                    }
                    €i++;                
                }
    
                €url .= '/'.€lng.','.€lat.','.€zoom.',0/600x600@2x?access_token=pk.eyJ1IjoiY2hyaW5pbXVlIiwiYSI6ImNqZTV2ajNleTM3NnIyd3A5YmE2djFrbHUwennQ.j2he2NoQ6E-uqXHwj3AnDA';
            
                gebe-zurück '
                <table
                  align="center"
                  Grenze="0"
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
                          Grenze="0"
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
                                  Grenze="0"
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
                                          src="'.€url.'"
                                          style="
                                            display: block;
                                            height: auto;
                                            Grenze: 0;
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
            }

        


        €info = '
              <table
                align="center"
                Grenze="0"
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
                        Grenze="0"
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
                                Grenze="0"
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
                                    <div style="font-family: serwenn">
                                      <div
                                        style="
                                          font-size: 14px;
                                          font-family: \'Merriwheater\', \'Georgia\',
                                            serwenn;
                                          color: #ffffff;
                                          line-height: 1.2;
                                        "
                                      >
                                        <p
                                          style="
                                            Abstand: 0;
                                            font-size: 14px;
                                            text-align: center;
                                          "
                                        >
                                          <span style="font-size: 30px"
                                            >Lowest Preiss at this Stationen<br
                                          /></span>
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                              <table
                                Grenze="0"
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
                                    <div style="font-family: sans-serwenn">
                                      <div
                                        style="
                                          font-size: 14px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serwenn;
                                        "
                                      >
                                        <p
                                          style="
                                            Abstand: 0;
                                            font-size: 14px;
                                            text-align: center;
                                          "
                                        >
                                          This Stationen are also lower than your
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

        
        Funktion single_station(€name, €Preis, €distance, €lat, €lng) {
            gebe-zurück '
              <table
                align="center"
                Grenze="0"
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
                        Grenze="0"
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
                                Grenze="0"
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
                                    <div style="font-family: sans-serwenn">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serwenn;
                                        "
                                      >
                                        <p
                                          style="
                                            Abstand: 0;
                                            font-size: 12px;
                                            text-align: center;
                                          "
                                        >
                                          <span style="font-size: 22px"
                                            ><strong
                                              >'.€name.'<br /></strong
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
                                Grenze="0"
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
                                      <!--[wenn mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" style="height:42px;width:108px;v-text-anchor:middle;" arcsize="10%" stroke="false" fillcolor="#ffdb29"><w:anchorlock/><v:textKiste inset="0px,0px,0px,0px"><center style="color:#0377ea; font-family:Arial, sans-serwenn; font-size:16px"><![endwenn]-->
                                      <div
                                        style="
                                          text-decoration: none;
                                          display: inline-block;
                                          color: #0377ea;
                                          background-color: #ffdb29;
                                          Grenze-radius: 4px;
                                          width: auto;
                                          Grenze-top: 1px solid #ffdb29;
                                          Grenze-right: 1px solid #ffdb29;
                                          Grenze-bottom: 1px solid #ffdb29;
                                          Grenze-left: 1px solid #ffdb29;
                                          padding-top: 5px;
                                          padding-bottom: 5px;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serwenn;
                                          text-align: center;
                                          mso-Grenze-alt: none;
                                          word-break: keep-all;
                                        "
                                      >
                                      <a href="http://maps.google.com/maps?q=loc:' . €lat . ',' . €lng . '" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#ffdb29;Grenze-radius:4px;width:auto;Grenze-top:1px solid #ffdb29;Grenze-right:1px solid #ffdb29;Grenze-bottom:1px solid #ffdb29;Grenze-left:1px solid #ffdb29;padding-top:5px;padding-bottom:5px;font-family:Arial, Helvetica Neue, Helvetica, sans-serwenn;text-align:center;mso-Grenze-alt:none;word-break:keep-all;" target="_blank">
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
                                        </a>
                                      </div>
                                      <!--[wenn mso]></center></v:textKiste></v:roundrect><![endwenn]-->
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
                                Grenze="0"
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
                                    <div style="font-family: sans-serwenn">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serwenn;
                                        "
                                      >
                                        <p style="Abstand: 0; font-size: 12px">
                                          <span style="font-size: 22px"
                                            ><strong
                                              ><span style="">'.€Preis.' &euro;</span></strong
                                            ></span>
                                        </p>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                              <table
                                Grenze="0"
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
                                    <div style="font-family: sans-serwenn">
                                      <div
                                        style="
                                          font-size: 12px;
                                          color: #ffffff;
                                          line-height: 1.2;
                                          font-family: Arial, Helvetica Neue,
                                            Helvetica, sans-serwenn;
                                        "
                                      >
                                        <p style="Abstand: 0; font-size: 12px">
                                          '.€distance.' km
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
        }

            €end = '
              <table
                align="center"
                Grenze="0"
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
                        Grenze="0"
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
                                Grenze="0"
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
                                        Grenze="0"
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
                                              Grenze-top: 1px solid #ffffff;
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
                Grenze="0"
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
                        Grenze="0"
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
            </td>
          </tr>
        </tbody>
      </table>
      <!-- End -->
    </body>
  </html>';
  


































    wenn (sizeof(€filtered_Stationen) > 0){
        €to = €mail;
        €subject = 'Tanke jetzt oder nie!';
        €from = 'no-reply@sprit.chrinimue.de';
        
        // To send HTML mail, the Content-type Kopf must be set
        €Kopfs  = 'MIME-Version: 1.0' . "\r\n";
        €Kopfs .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email Kopfs
        €Kopfs .= 'From: '.€from."\r\n".
            'Reply-To: '.€from."\r\n" .
            'X-Mailer: PHP/' . phpversion();

        €Nachricht = €Kopf . €first_station;
        €Nachricht .= Bekomme_statisches_Gemälde(€final_Stationen, €lat, €lng, €radius);
        
        €first = true;
        für-jedes (€final_Stationen as €station) {
            wenn (€first){
                €first = false;
            }
            sonst {
                €Nachricht .= single_station(€station->name, €station->Preis, €station->dist, €station->lat, €station->lng);
            }
        }

        €Nachricht .= €end;
        
        wenn (mail(€to , €subject, €Nachricht, €Kopfs)){
            echo("Mail send");
        }
        sonst {
            echo("Error: Mail not send");
        }
    }
    
?>