<?php

class EMails

{

        	private function switchKategorieVerkaeufer($Artikel, $text)
        { 


          switch ($Artikel['Kategorien'])
          {
            case 'Buecher':

            $text .=  $Artikel['Autor']  . ", ".  $Artikel['Mediumart'] ; 
              # code...
              break;

            case 'Kleidung':

            $text .=   $Artikel['Marke'] . ", ".  $Artikel['Groesse'] . ", ".  $Artikel['Farbe'];
              # code...
              break;
            
            default:
              # code...
              break;
            }  
        }

        private function switchKategorie($Artikel, $text)
{
        var_dump($Artikel);
          
          switch ($Artikel['Kategorien'])
          {


            case 'Buecher':

              $text .=  $Artikel['Autor'] . ", ". $Artikel['Erscheinungsjahr'] . ", ".$Artikel['Auflage']." , " .$Artikel['Mediumart']; 
              # code...
              break;

            case 'Kleidung':

              $text .=  $Artikel['Marke'] . ", ".  $Artikel['Groesse'] . ", ".  $Artikel['Farbe'];
              # code...
              break;
            
            default:
              # code...
              break;
            }
          

        }

        public function EMail_Verkaufsbestaetigung($mysqli,$Zeit,$ArtikelAnzahl, $Warenkorbartikel, $Radiobutton)
        {
            $Anz = count($ArtikelAnzahl);  // Anzahl der Artikel mit den gleichen Anbieter
            //echo $Anz;
             $Position = 0;

            //var_dump($ArtikelAnzahl);

          $empf = "stefanie.burkhardt22@t-online.de";//$benutzer['EMail'];
          $betreff = "Artikelverkauf";
          $from = "From: TuK.de <stefanie.burkhardt22@t-online.de>\n";
          $from .= "Reply-To: stefanie.burkhardt22@t-online.de\n";
          $from .= "Content-Type: text/html\n";
          $text = "

          <div style='max-hight:30px; max-width:60px; background-color:yellow; '>LOGO</div>
            <div style='margin-bottom:30px; border-top-style:solid; border-bottom-style:solid; border-color:black; border-width: 1px;'>Artikelverkauf</div>
              <div style='margin-left:60px;'>
              
              ";
              if($ArtikelAnzahl['1']['ArtikelAnzahl'] > 1)
              {
                $text .="  <h4>Herzlichen Gl&uuml;ckwunsch es wurden ".$ArtikelAnzahl['1']['ArtikelAnzahl']." Deiner Artikel vom gleichen K&auml;ufer gekauft!</h4>";
              }
              else{

                $text .="  <h4> Herzlichen Gl&uuml;ckwunsch Dein Artikel <b style='color:#4863a0;'>'". $Warenkorbartikel[$ArtikelAnzahl['0']['Position']-1]['Bezeichnung'] ."'</b> wurde verkauft!</h4>";
                
                }

              $text .=" </div>
                 
            

            <div style='margin-left:60px;'>
                    <table style=' margin-top:30px;'>";

                    $Position = $ArtikelAnzahl['0']['Position'];
                   
                   for($c = 0; $c < $ArtikelAnzahl['1']['ArtikelAnzahl']; $c++)
                    {
                   
                      
                    $Position = $Position-1;
                      echo 'Position in mail '.$Position;

                       //var_dump($Warenkorbartikel);

                    

                      $text .="<tr><td style='width:200px; hight:150px;'> Bild
                      </td>
                      <td style='float:right; width:400px; '> " . $Warenkorbartikel[$Position]['Bezeichnung'].", 
                          ". $this->switchKategorieVerkaeufer($Warenkorbartikel[$Position],$text ) . "
                    </td>
                    <td style='width:200px;'>" ;


                                     $splitter = preg_split('/W/',$Radiobutton['Kaufarten_'.$c]);



                                                            
                                  //var_dump("HAllo hier kommt was neues");
                                  //var_dump( $Kaufarten);

                                  if($splitter['0'] == "Kaufwert")
                                                            {
                                                                $Kaufarten  = $Warenkorbartikel[$c]['1'];

                                                              $text .= "<b style='color:#4863a0;'> Verkauft zum Kaufwert von </b></br>";

                                                              $Kaufart = number_format($Kaufarten['Preis']/100 , 2, ',', '.');
                                                              
                                                              $text .= "<b>".$Kaufart." &euro;<b>";
                                                            }

                                  if($splitter['0'] == "Tauschwert")
                                                            {
                                                              $Kaufarten  = $Warenkorbartikel[$c]['0'];

                                                               $text .= "<b style='color:#4863a0;'> Verkauft zum Tauschwert von </b></br>";

                                                              $Kaufart2 =  number_format($Kaufarten['Preis']/100 , 2, ',', '.');
                                                              $text .= "<b>".$Kaufart2. " &euro; </b>";
                                                            }
                                $text .="<tr> ";                           
                             } // ende for                          
                                                                    
                                                                    

          $text .=  "</td>                         
          </table></div>
                                                                                   
          <div style='margin-top:50px; margin-left:40px;'>
            Du findest die Adresse des K&auml;ufers in deinem Konto im Bereich 'Nachrichten'.<br>  Einen Direktlink zu deinem Postfach findest du <a href=''> hier </a>.<br><br> 

           &Auml;ndere bitte den Status des P&auml;ckchens wenn du den Artikel verschickt hast. 
           
           <div style=' float:left; margin-top:50px; '>

           Viele Gr&uuml;&szlig;e <br>

           Dein TuK-Service.

           </div>
           </div>

          ";

          mail($empf,$betreff,$text,$from);
        }

public function EMail_Kaeufer($mysqli, $Warenkorbartikel, $Zeit, $Kaeufername, $Radiobutton)
{


   $sammelArtikelsumme= 0;
   $sammelVersandkosten = 0;
   $Kaufarten = "";             
    
	
  $count = 0;

  var_dump($Kaeufername['Vorname']);
 var_dump($Warenkorbartikel);

	$empf = "stefanie.burkhardt22@tonline.de";//$benutzer['EMail'];
	$betreff = "Zahlungsbestaetigung";
	$from = "From: TuK.de <stefanie.burkhardt22@t-online.de>\n";
	$from .= "Reply-To: stefanie.burkhardt22@tonline.de\n";
	$from .= "Content-Type: text/html\n";
	$text = "
      <h3 style='text-align:center;'>Zahlungsbest&auml;tigung</h3>

      <div style='margin-left:40px;'>Hallo "; $text .= $Kaeufername['Vorname'] . ", <br>
           <br>
          vielen Dank f&uuml;r Deinen Kauf bei TuK.de.<br>
          Deine Bezahlung ist erfolgreich bei uns eingegangen.<br>
      </div><br>

       <div style=' width:600px; float:right; text-align:right; margin-bottom:30px;'>
          Bestelldatum: ". $Zeit."
      </div>";

     for($y= 0; $y < count($Warenkorbartikel); $y++)
            { 
              //$back =  switchKategorie($Warenkorbartikel[$y]);
              
      $text .= "<div style='margin-left:20px; width:600px; border-top-style:dashed; border-bottom-style:dashed; border-color:black; border-width: 1px; font-weight: bold; margin-bottom:20px;'> <div style='width:600px; margin-bottom:10px; margin-top:10px;color:#4863a0;'> 

                  Artikel ". $count++." - ". $Warenkorbartikel[$y]['Bezeichnung'].", ". $this->switchKategorie($Warenkorbartikel[$y], $text) ."</div></div>";

     
      $text .= "<div style=' margin-bottom:10px; width:600px;'>

      <table class='table' id='WarenkorbTabelle' style='width:600px;  margin-left:40px; margin-bottom:3px;'>
                                                                    <tr >                                                                       
                                                                          <td  style=' width:10%;'>Verk&auml;ufer: 
                                                                          </td><td style='float:right; margin-left:20px;'>";

                                                                     $text .=    "<a href=''>".$Warenkorbartikel[$y]['Benutzername']."  
                                                                  </td>

                                                                     <td></td>                                                                       
                                                                  </tr> 
                                                                        <tr>   
                                                                            <td style=' width:10%;'>Zustand:
                                                                            </td>

                                                                            <td style='float:right;margin-left:20px;'> " . $Warenkorbartikel[$y]['Zustand']."
                                                                            </td>
                                                                             <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style=' width:10%;'>Beschreibung:
                                                                            </td>
                                                                              <td style='float:right; margin-left:20px;'> " . $Warenkorbartikel[$y]['Artikelbeschreibung']."
                                                                            </td>
                                                                             <td></td>
                                                                        </tr>";
                                              //ab hier Kontrollieren                       

                                                     // Kaufarten bei 0 == Tauschwert, Kaufarten bei 1 = Kaufwert



                                                    $splitter = preg_split('/W/',$Radiobutton['Kaufarten_'.$y]);

                                                    if($splitter['0'] == "Kaufwert")
                                                    {
                                                      $change = 1;
                                                    }
                                                     if($splitter['0'] == "Tauschwert")
                                                    {
                                                      $change = 0;
                                                    }

                                                     $Kaufarten  = $Warenkorbartikel[$y][$change];
                                                     $andereKaufart = $Warenkorbartikel[$y];                           
                                  

                                                        if($splitter['0'] == $Kaufarten['Kaufarten'] && $splitter['1'] == $Kaufarten['Preis'] && $splitter['2'] == $Kaufarten['idVerkaeuferposition'] )
                                                        {

                                                          if($change == 1) // wenn change 0 ist dann wird der Kaufwertübernommen, ansonsten der Tauschwert
                                                          {
                                                            $sammelArtikelsumme = $Kaufarten['Preis'] + $sammelArtikelsumme ;
                                                            $sammelVersandkosten = $andereKaufart['1']['Preis']  + $sammelVersandkosten;

                                                            $Kaufart = number_format($Kaufarten['Preis']/100 , 2, ',', '.');
                                                            $Kaufart2 =  number_format( $andereKaufart['1']['Preis']/100 , 2, ',', '.');

                                                             $text .= "   
                                                                  
                                                                  <tr>
                                                                  <td > <div style='width:80%; margin-top: 10px;border-top-style:dashed; border-color:black; border-width: 1px;' ><div style='margin-top: 10px; font-weight: bold;' >Artikelkosten:</div></div>                                                                       
                                                                        </td>

                                                                        <td>
                                                                        </td>

                                                                          <td style='float:right; width:20%;'> <div style='margin-top: 20px; text-align:right;'>" . $Kaufart."  &euro;</div>                                                                          
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style='font-weight: bold; '>Versandkosten/Tauschkosten:
                                                                        </td>

                                                                        <td>
                                                                        </td> 

                                                                         <td><div style='float:right; text-align:right;'> " . $Kaufart2 ."    &euro;</div>
                                                                        </td>                                                                   
                                                                    </tr>
                                                              ";
                                                           }

                                                           if($change == 0)
                                                          {
                                                               $sammelVersandkosten = $Kaufarten['Preis']  + $sammelVersandkosten;
                                                              $Kaufart =  number_format($Kaufarten['Preis']/100 , 2, ',', '.');

                                                             $text .= " <tr>  <td> <div style='width:80%; margin-top: 10px; margin-left:20%; border-top-style:dashed; border-color:black; border-width: 1px;' > <div style='margin-top: 30px; font-weight: bold; ' > Artikelkosten:</div></div>
                                                                       
                                                                          </td>
                                                                          <td>
                                                                          </td>

                                                                            <td> <div style='float:right; margin-left:30px; width:150%; margin-top: 20px;'> 0,00 &euro;</div>
                                                                          </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <td >Versandkosten/Tauschkosten:
                                                                        </td>

                                                                        <td>
                                                                        </td>    

                                                                         <td><div style='float:right; text-align:right; '> ".$Kaufart."  &euro;</div>
                                                                        </td>                                                                   
                                                                    </tr>";
                                                           }
                                                        }// ende if
       
       $text .= "</table></div>";
}// ende for
      $sammelArtikelsumme =  number_format($sammelArtikelsumme/100 , 2, ',', '.');
      $sammelVersandkosten = number_format($sammelVersandkosten/100 , 2, ',', '.');

      var_dump($Kaufarten);

       $text .= "<div style='width:600px; float:left; border-top-style:dashed; border-color:black; border-width: 1px; '> 
            <h4 style=' margin-top:40px;  '>Gesamtkosten:</h4>

            <table style=' margin-left:40px; float:left;width:600px; '>
              <tr> <td style='width:20%;'> Artikelkosten gesamt</td><td> <div style='text-align:right;'>". $sammelArtikelsumme." &euro; </div></td></tr>
              <tr> <td style='width:20%;'> Versandkosten/Tauschkosten gesamt</td><td><div style='text-align:right;'>". $sammelVersandkosten ." &euro; </div></td></tr>
              <tr> <td style='width:20%;'> Servicekosten</td><td><div style='text-align:right;'> ";

              var_dump($sammelArtikelsumme);
              var_dump($sammelVersandkosten);

              //einheitliche Methode zur Berechnung der Servicekosten !!! 

              (float) $gesamtSumme =  (float) $sammelArtikelsumme + (float) $sammelVersandkosten;
              var_dump($gesamtSumme);

             (float)  $Servicekosten =  ($gesamtSumme*0.018) + 0.18;

             (float) $gesamtSumme = $gesamtSumme+ $Servicekosten;
                  

              $text .= number_format($Servicekosten , 2, ',', '.')." &euro; </div></td></tr>
              <tr> <td> <div style='color:green; font-weight: bold;'> Gesamtsumme</div></td><td><div style='float:right; text-align:right; border-top-style:dashed; border-color:black; border-width: 1px; font-weight: bold;'> ". number_format($gesamtSumme , 2, ',', '.')." &euro;</div></td></tr>
             </table></div>"; // Farbe blau

       //

      
       $text .= "<p><div style='width:600px; float:left; border-top-style:dashed; border-color:black; border-width: 1px; margin-top:20px; margin-bottom:50px; margin-left:20px;'>
       <div style=' float:left; margin-top: 10px;'>
       Ein Verk&auml;ufer hat 5 Tage Zeit seinen Artikel zu verschicken. Zus&auml;tzlich k&ouml;nnen 2-5 Werktage vergehen bis die Ware bei dir eintrifft. <br>
      Bei &Auml;nderungen des Versandstatus wirst du umgehend per Mail informiert.<br> 
      Bei Fragen bez&uuml;glich der Artikel, setzten Sie sich bitte direkt mit dem Verk&auml;ufer auseinander. </div>

      <div style=' float:left; margin-top:50px; '>
      Mit freundlichen Gr&uuml;&szlig;en<br><br>

      <div style='margin-bottom:20px;'>

      Dein TuK-Team</div><br>

      service@tuk.de</div></div>      

      ";
		
			mail($empf,$betreff,$text,$from);

		

} // ende Methode

} // ende class


?>