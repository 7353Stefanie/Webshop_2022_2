<?php
//session_start();

 define('__ROOT__', 'C:/xampp/htdocs/Final/Kategorien/Buttons/Hilfsdokumente/');


 require_once(__ROOT__.'/KaufeArtikelKommunikation.php');

$Kaufen = new KaufeArtikelK;


 function array_keys_recursive($myArray, $MAXDEPTH = INF, $depth = 0, $arrayKeys = array()){
       if($depth < $MAXDEPTH){
            $depth++;
            $keys = array_keys($myArray);
            foreach($keys as $key){
                if(is_array($myArray[$key])){
                    $arrayKeys[$key] = array_keys_recursive($myArray[$key], $MAXDEPTH, $depth);
                }
            }
        }
      }

function array_Key_count($gemerkteArtikeldP,String $Schluessel)
{
                                                  $merkeStart = Array();

                                                  $Start = 0;

                                                  $keys = array_keys($gemerkteArtikeldP);

                                                  foreach ($keys as $key => $value) {


                                                  $ErgTest =   array_key_exists($Schluessel, $gemerkteArtikeldP[$key]);

                                                  if($ErgTest == true)
                                                    {
                                                      $merkeStart[] = $Start;  // Übergibt den Positionswert dem Array Start
                                                                                                      
                                                     }

                                                   $Start++;
                                                    //var_dump($ErgTest);
                                                    # code...
                                                  }
                                                  return $merkeStart;
}



function array_Key_count2($gemerkteArtikeldP,String $Schluessel , String $Schluessel1)
{


                                                  $merkeStart = Array();

                                                  $Start = 0;

                                                  $keys = array_keys($gemerkteArtikeldP);

                                                  

                                                  foreach ($keys as $key => $value) {

                                                
                                                  $ErgTest =   array_key_exists($Schluessel, $gemerkteArtikeldP[$key]);
                                                 
                                                  $ErgTest2 =   array_key_exists($Schluessel1, $gemerkteArtikeldP[$key]);

                                                  if($ErgTest != null && $ErgTest2 != null )
                                                    {
                                                      $merkeStart[] = $Start;  // Übergibt den Positionswert dem Array Start                                                                                                      
                                                    }

                                                  else
                                                     {
                                                        set_error_handler(function() { /* ignore errors */ });
                                                        dns_get_record();

                                                      $ErgTest =   array_key_exists($Schluessel, $gemerkteArtikeldP[$key]['0']);
                                                      $ErgTest2 =   array_key_exists($Schluessel1, $gemerkteArtikeldP[$key]['0']);

                                                         if($ErgTest == true ||  $ErgTest2 ==true )
                                                          {
                                                            $merkeStart[] = $Start;  // Übergibt den Positionswert dem Array Start                                                                                                            
                                                          }
                                                      }
                                                          restore_error_handler();

                                                   $Start++;
                                                    //var_dump($ErgTest);
                                                    # code...
                                                  }
                                                  return $merkeStart;
}

 

 function switchIt( $Artikel, $Kategorie)
 {
  //var_dump($Artikel);

  switch($Kategorie) {

    case 'Buecher':

      echo  $Artikel['Autor'] . ", <br>";
      echo  $Artikel['Erscheinungsjahr'] . ", ";
      echo  'Auflage: '.$Artikel['Auflage']; 
      # code...
      break;

    case 'Kleidung':

      echo  $Artikel['Marke'] . ", <br>";
      echo  $Artikel['Groesse'] . ", ";
      echo  $Artikel['Farbe'];
      # code...
      break;
    
    default:
      # code...
      break;
    }
 }
    if($_POST != null)
      {
      $_SESSION['buttonwerte'] = $_POST;
      
      }


      $Warenkorbartikel = $Kaufen->KaufeArtikelJetzt();
      $AnzahlWarenkorbartikel = count($_SESSION['buttonwerte']);
      $Zahlungsmethode  = $Kaufen->Zahlungsart($_SESSION['idBenutzer']);
      $Adresse = $Kaufen->Adresse();

      //var_dump($Warenkorbartikel);

                          // Zur Unterstützung der Methode Löschen können alle Datenbankausgaben in einem Array gespeichert werden
      
                                                  
      $var = 1;// wird verwendet                                                
                                                 
      $array2    = array();
      $searchErg = array();
      $y = 0;
      $x= 0;
      $Preis     = array();
      $Kaufart   = array();
      $buttonwerte = array();
      $Betrag = 0;
                                              //var_dump($Warenkorbartikel);
                                              //var_dump($_POST);
                                                  $buttonwerte = $_SESSION['buttonwerte'];

                                                  foreach ($buttonwerte as $BWert) 
                                                  {
                                                    

                                                    $Arr = explode( "W", $BWert);

                                                    //var_dump($Arr);

                                                    if($Arr['0'] == 'Tauschkosten')
                                                    {
                                                        $Kaufen->updateWarenkorb($Arr['2'], 'T');
                                                    }
                                                    else
                                                    {
                                                        $Kaufen->updateWarenkorb($Arr['2'], 'K');
                                                    }

                                                    $array2[$y] =  $Arr ;

                                                    $y++;
                                                  }

                                                  //var_dump($array2);

                                                   function sortByOrder($a, $b) {
                                                          return $a['2'] - $b['2'];
                                                      }

                                                    usort($array2, 'sortByOrder');                       
                                                  

                                                  $y = 0;    
                                                  $x = 0;

                                                 
                                                  for($i = 0; $i< count($buttonwerte)  ; $i++)// 6 Durchgänge0 
                                                    {                                                     

                                                    if($array2[$i]['2'] == $Warenkorbartikel[$x+1]['idVerkaeuferposition'])
                                                    {                                                     

                                                        if($Warenkorbartikel[$x]['Preis'] == $array2[$y]['1'])
                                                        {
                                                         // 0 Tausch
                                                          $Preis[$i]   = $Warenkorbartikel[$x]['Preis'];
                                                          $Kaufart[$i] = $Warenkorbartikel[$x]['Kaufarten'];
                                                         // echo 'a';
                                                        }
                                                        else
                                                        {
                                                         // echo 'else';
                                                        //  echo $Warenkorbartikel[$x]['1']['Preis'];
                                                        //  echo $array2[$y]['1'];

                                                          if($Warenkorbartikel[$x+1]['Preis'] == $array2[$y]['1'])
                                                          {

                                                            $Preis[$i] = $Warenkorbartikel[$x+1]['Preis'];
                                                            $Kaufart[$i] =$Warenkorbartikel[$x+1]['Kaufarten'] ;
                                                           // echo 'b';

                                                          }
                                                          else
                                                          {
                                                            // Überlegen welche Konsequenz es hat
                                                            //echo 'fehler';
                                                            $Preis[$i] = 'es ist ein Fehler aufgetreten. Bitte starten sie den Kaufprozess neu ';
                                                          }
                                                        } // else                                                        
                                                    }// ende if
                                                

                                                     $y++;
                                                      $x=$x+2; 
                                                   } // ende for 

                                                 /*  var_dump($Preis);
                                                   var_dump($Kaufart);
                                                   echo 'ä';*/

                                             
                                                 
              //var_dump($Warenkorbartikel);
   
?>

<html lang="de">
  <head>
            <meta charset="utf-8"/>
            <title>Finale Startseite</title>   
                            
            <link href="Hilfsdokumente/css/bootstrap.min.css" rel="stylesheet"> 
            <link rel="stylesheet" href="Hilfsdokumente/css/bootstrap-theme.min.css">
            <link rel="stylesheet" href="Hilfsdokumente/css/FinalStyle.css">
            <link rel="stylesheet" href="Hilfsdokumente/css/Komprimierung.css"> 
            <link rel="stylesheet" href="Hilfsdokumente/css/styleZahlung.css"> 

           <header> 
                  <nav class="navbar navbar-default ">
                        <div class="container-fluid"><!-- padding: 15px 15px 25px 15px; -->
                                <!-- Brand and toggleget grouped for better mobile display -->                        
                                 
                                          <div class="navbar-header" >   
                                          
                                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> open</button>
                                              <span class="sr-only">Toggle navigation</span>
                                              <span class="icon-bar"></span>
                                              <span class="icon-bar"></span>
                                              <span class="icon-bar"></span>
                                            </button>
                                            <a class="navbar-brand" href="/../Final/final.php">Brand</a>
                                          </div> 

                
                               <form action="sucheV2.php" method="post"  class="navbar-form navbar-left "  >
                                 <div class="form-group ">  
                                  
                                        <span >                                                                 
                                                                            <select  style="float: left; width: 150px; margin-right: 5px;" name="Kategorie" class="col-sm-1 form-control" id="einfaches-addon1" >
                                                                              
                                                                                  <option value="Alle">Alle Kategorien</option> 
                                                                                  <option value="Buecher">Bücher</option> 
                                                                                  <option value="Kleidung">Kleidung</option> 
                                                                                  <option value="FreizeitundSport">Freizeit und Sport</option> 
                                                                                  <option value="Spielzeug">Spielzeug</option> 
                                                                                  <option value="Fahrzeug">Fahrzeug</option> 
                                                                                  <option value="HaushaltundGarten">Haushalt und Garten</option> 
                                                                                  <option value="Sonstiges">Sonstiges</option> 

                                                                           </select>
                                           </span>
                                      </div>

                                      <div class="form-group "> 
                                        <input type="text" class="form-control " placeholder="Suchen" name="suchen" aria-describedby="einfaches-addon1" style="width: 25em; display: flex;">
                                      </div>
                                         <button type="submit" class="btn btn-default"> Suchen </button>
   
                               </form>                             
                               
                                    <ul class="nav navbar-nav navbar-right">    

                                           <?php
                                                    if(isset($_SESSION['benutzername']))
                                                    {
                                                           echo   '<li><a href="ArtikelAuswahl.php">';
                                                           echo   'Artikel hinzufügen </a></li>';
                                                           echo   '<li><a href="../StartseitenAnmeldung.php">';
                                                           echo   'Willkommen ';
                                                           echo   $_SESSION['benutzername'];
                                                           echo   '</a></li>';  
                                                    } 
                                                    else  
                                                    {
                                                         echo '<li><a href="#" data-toggle="modal" data-target="#modal-2">Registrieren</a></li>';
                                                         echo '<li><a href="#" data-toggle="modal" data-target="#modal-1">Login</a></li>';
                                                    }                                                      
                                           ?>

                                         
                                             <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menü<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                   <?php
                                                    if(isset($_SESSION['benutzername']))
                                                    {                                              
                                                     echo ' <li><a href="../StartseitenAnmeldung.php">Warenkorb</a></li>';
                                                    }
                                                  ?>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a href="#">Impressum</a></li>
                                                  <li><a href="#">AboutUs</a></li> 
                                                  <li><a href="#">Hilfe &amp; Support</a></li>
                                                  <li><a href="#">FAQ</a></li> 
                                                  <li><a href="#">AGB</a></li> 

                                                </ul>
                                              </li> 
                                              <?PHP
                                              if(isset($_SESSION['benutzername']))
                                                    {
                                                      echo '<li><a href="Hilfsdokumente/Logout.php" onclick="loescheCoockie()">Logout</a></li> ';
                                                    }
                                              ?>
                                             
                                        </ul>                             
                          
                         </div><!-- /.container-fluid -->
                      </nav>
            </header>   
  </head>  
 <body>
    <div id="Error">
                    <div class="alert alert-danger hideME" id="ZahlungsartError" role="alert">
                      <span class="glyphicon glyphicon-exclamation-sign"  aria-hidden="true"></span>
                      <span class="sr-only">Fehler:</span>
                       Bitte wählen Sie eine Zahlungsart aus! 
                      <span  class="glyphicon glyphicon-remove" id='Error1' style="float:right;" aria-hidden="true" ></span>
                     </div> 

                    <div class="alert alert-danger hideME" id="AdresseError" role="alert">
                      <span class="glyphicon glyphicon-exclamation-sign"  aria-hidden="true"></span>
                      <span class="sr-only">Fehler:</span>
                       Bitte fügen Sie eine Adresse hinzu! 
                      <span  class="glyphicon glyphicon-remove" id='Error2' style="float:right;" aria-hidden="true" ></span>
                    </div>

    </div>



<table style=" margin-left:auto; margin-right: auto;">
  <tr>
    <td>
        <div class="" style="margin-left:10px;  margin-bottom: 20px;min-height: 130px; border-width: 1px; border-style: solid; border-radius: 4px;">



 <table style="margin-top: 10px;margin-left: 20px;margin-right: 20px; font-size: 12px;">
 

   <tr>
    <td style="width: 60%; height: 25px; ">
       Artikelkosten gesamt

    </td>
    <td style="width: 20%; text-align: right; ">
      <?php

      $gesamtPreis = 0.0;

      for($x = 0; $x< $AnzahlWarenkorbartikel; $x++)
      {
          if($Kaufart[$x] == 'Kaufwert' || $Kaufart[$x] == 'Restwert')
            {
               $gesamtPreis = $Preis[$x] +$gesamtPreis;
            } 
      }
       echo  '<b>'.(number_format($gesamtPreis/100, 2, ',', '.')) . " € "; 
?>
    </td>
  </tr>

  <tr  >
    <td  style="width: 60%; height: 25px; ">
        Versandkosten / Tauschkosten gesamt

    </td>
    <td style="width: 20%;text-align: right; ">

    <?php 
      $gesamtVersand = 0.0;

      //var_dump($Kaufart);
      $z=0;
       

      for($x = 0; $x< $AnzahlWarenkorbartikel; $x++)
      {
       if($Kaufart[$x] == 'Restwert' )
            { 
                $gesamtVersand =  $Warenkorbartikel[$z+1]['Preis'] + $gesamtVersand;
            }
            
        else
        {
           $gesamtVersand = $Preis[$z] + $gesamtVersand;
        }
        $z=$z+2;
      }

       echo  '<b>'.(number_format($gesamtVersand /100, 2, ',', '.')) . " € "; 


    ?>

    </td>
  </tr>

  <tr >
    <td>
        Servicekosten  <span  class="glyphicon glyphicon-info-sign" id="Servicekosten" data-placement="right" aria-hidden="true" data-toggle="tooltip" title="Die Servicekosten setzen sich aus der Abwicklung des Transaktionsprozesses sowie dem Schutz vor Betrug und Unterstützungsleistungen unseres Teams zusammen.
          Die Servicekosten fallen für alle Transaktionen mit der Kreditkarte, PayPal und SOFORTÜberweisung an." ></span>  

 
    </td>

    <td style="height: 25px;  text-align: right; ">
      <?php
      $gesamtSumme = 0.0;
      $Servicekosten = 0.0;

      $gesamtSumme =  $gesamtVersand + $gesamtPreis;

      $Servicekosten =  (($gesamtSumme/100)*0.018) + 0.18 ;

      //  Servicekosten bsp. Mangopay, ohne eigenen Servicebetrag

       echo  '<b >'.number_format($Servicekosten , 2, ',', '.') . " € </b>"; 
      ?>
      
    </td>
  </tr>

  <tr style="color: #007500; font-size: 14px;">
    <td>
      <b>  Gesamtsumme </b>
    </td>

    <td style="height: 30px; border-top-style:solid; text-align: right; ">
      <?php    

      

      $gesamtSumme =  $gesamtSumme+ ($Servicekosten*100);

      //  Servicekosten bsp. Mangopay

       echo  '<b >'.number_format($gesamtSumme /100, 2, ',', '.') . " € </b>"; 
       
      ?>
      
        </td>
      </tr>
     </table>
</div>
</td>
<td>
   <div id="AdresseEinfuegen" >
    
    <!-- Adresse-->
  </div>
</td>
<td>

     <div id="ZahlungsartEinfuegen" name=<?php echo '"'.$Zahlungsmethode['0']['Zahlungsart'] .'"';?> >
    </div>


    
    <!-- Adresse-->
  
</td>

<td>
  <div style="margin-left: 20px;">
    <button type="button" type="submit" id="zahlungsvorgangStarten" class="btn btn-primary"> Jetzt bezahlen! </button>
  </div>
</td>
</tr>
</table>





 <div class="container">



<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-primary" id="one">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Artikel
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body" >

                  <table class="table" id='WarenkorbTabelle'>
                                                 
                                                       <tr  style=" font-weight: bold; font-size: 12px;">
                                                          <td>Nr.</td>
                                                          <td>Artikel</td>
                                                          <td style="text-align: center;"> Bild</td>
                                                          <td> Kaufdetails </td>
                                                          <td> Kosten </td>
                                                          <td></td>
                                                          <td></td>                                                                                                       
                                                       </tr>
<?php

                                               
                                                  $anzahlWiederholungen = 0;
                                                  $z = 0; 
                                                  $f =  count($Warenkorbartikel)-1;
                                                  $n = 0;
                                                  $alteArtikelId = '';
                                                  $zurueckzaehlen = 1;


                                                  $Liste_Pos_Anz_Verkaeuferposition = array_Key_count($Warenkorbartikel,'Zustand');

                                                  $Liste_Pos_Anz_Artikelliste = array_Key_count($Warenkorbartikel,'Titelbild');

                                                  $Liste_Pos_Anz_Benutzername = array_Key_count($Warenkorbartikel,'Benutzername');

                                                  $Liste_Pos_Anz_Kaufarten = array_Key_count($Warenkorbartikel,'Preis');

                                                  $Liste_Pos_Anz_Details = array_Key_count2($Warenkorbartikel,'ISBN','Marke'); // An Kategroieren noch anpassen

                                                  

                                                 // $Liste_Pos_Anz_GemerkteArtikel = array_Key_count($Warenkorbartikel,'idMerken');

                                                  var_dump($Warenkorbartikel);
                                                  echo($AnzahlWarenkorbartikel);



                                                  $AnzahlVarWarenkobart = count($Warenkorbartikel);
                                                  //echo $AnzahlVarWarenkobart;
                                                 // echo count($Warenkorbartikel[$AnzahlVarWarenkobart-1]);

                                                 
                                                 for($y= $AnzahlWarenkorbartikel*2; $y < $AnzahlWarenkorbartikel*3; $y++)
                                                  {

                                                    
                                                    echo '<tr style="font-size: 12px;">';
                                                    echo "<td style='width:5%;'>";
                                                    echo $var++;
                                                    echo "</td>";
                                                    echo "<td style='width:40%;'><b>";

                                                    if($Warenkorbartikel[$z]['idArtikel'] == $alteArtikelId)
                                                    {
                                                      // wenn idArtikel z-1 

                                                      if($anzahlWiederholungen>=1)
                                                      {
                                                        $zurueckzaehlen = $anzahlWiederholungen;
                                                      }

                                                      $anzahlWiederholungen++;

                                                     echo  $Warenkorbartikel[$y-$zurueckzaehlen]['Bezeichnung'] . "</b>, ";
                                                   // echo $Warenkorbartikel[$f];

                                                     var_dump($Warenkorbartikel[$y]);

                                                    switchIt($Warenkorbartikel[$y][$n-$zurueckzaehlen],$Warenkorbartikel[$y-$zurueckzaehlen]['Kategorien']  );
                                                     // switchIt($Warenkorbartikel[$f][$n-$zurueckzaehlen],$Warenkorbartikel[$y-$zurueckzaehlen]['Kategorien']  );

                                                      echo  "</td>";    

                                                      if($Warenkorbartikel[$y-$zurueckzaehlen]['Kategorien'] == 'Buecher')  
                                                      {echo "<td style='width:10%; text-align:center;'><img id='miniaturbild' style='width:60px; height:80px;' src='".$Warenkorbartikel[$y-$zurueckzaehlen]['Titelbild']."' alt='titelbild'> </td>";} 


                                                      if($Warenkorbartikel[$y-$zurueckzaehlen]['Kategorien'] == 'Kleidung')                                            
                                                     { echo "<td style='width:15%; text-align:center;'><img id='miniaturbild' style='width:80px; height:60px;' src='".$Warenkorbartikel[$y-$zurueckzaehlen]['Titelbild'] ."' alt='titelbild'> </td>";}

                                                    }
                                                    else
                                                    {
                                                      echo  $Warenkorbartikel[$y]['Bezeichnung'] . "</b>, ";
                                                      switchIt($Warenkorbartikel[$f][$n],$Warenkorbartikel[$y]['Kategorien']  );

                                                    

                                                    echo  "</td>";    

                                                    if($Warenkorbartikel[$y]['Kategorien'] == 'Buecher')  
                                                    {echo "<td style='width:10%; text-align:center;'><img id='miniaturbild' style='width:60px; height:80px;' src='".$Warenkorbartikel[$y]['Titelbild']."' alt='titelbild'> </td>";} 


                                                    if($Warenkorbartikel[$y]['Kategorien'] == 'Kleidung')                                            
                                                   { echo "<td style='width:15%; text-align:center;'><img id='miniaturbild' style='width:80px; height:60px;' src='".$Warenkorbartikel[$y]['Titelbild'] ."' alt='titelbild'> </td>";}
                                                  }
                                                   
                                                    // $rows2 enthällt die Artikeldaten $Row enthällt ein Array mit den einzelnen Buchzuständen 
                                                                                                     
                                                                                                                                    
                                                                            echo "<td style='width:20%'>Menge: <b>".  $Warenkorbartikel[$z]["Verkaufsmenge"] . "</b><br>";
                                                                            echo " Zustand: <b> ".  $Warenkorbartikel[$z]["Zustand"] ."</b> <br></td>";
                                                                            echo "<td style='width:20%'>";
                                                                           // var_dump($row2);                                                         

                                                                         echo  '<b>'. number_format($Preis[$n]/100 , 2, ',', '.') . " € "; 
                                                                         echo  $Kaufart[$n] . " </b>  <br></div>";    

                                                                            if(  $Kaufart[$n] != 'Restwert' )
                                                                             {
                                                                              echo '<div class="klein"> zzgl. Versand '.number_format($Warenkorbartikel[$z]['Preis']/100 , 2, ',', '.').' € </div>';
                                                                             }   
                                                                              else
                                                                             {
                                                                              echo '<div class="klein"> zzgl. Versand '.number_format($Warenkorbartikel[$z+1]['Preis']/100 , 2, ',', '.').' € </div>';
                                                                             }                                                                     
                                                   echo "</td>"; 
                                                    echo '</tr>';

                                                    $alteArtikelId = $Warenkorbartikel[$z]['idArtikel'];

                                                    $z = $z+2;

                                                    
                                                    
                                                    $n++;

                                                  
                                                   
                                                   }       
                                                   
                                                  
       ?>
       </table>

       <div class="" style="width:40%; min-width: 30%; margin-left:auto; margin-right: auto;  margin-bottom: 20px;min-height: 170px; border-width: 1px; border-style: solid; border-radius: 4px;">

 <table style="margin-top: 10px;margin-left: 20px;margin-right: 20px; font-size: 14px;">
 

   <tr>
    <td style="width: 60%; height: 50px; ">
       Artikelkosten gesamt

    </td>
    <td style="width: 20%; text-align: right; ">
      <?php

      $gesamtPreis = 0.0;
      $p = 0;

      for($x = 0; $x< $AnzahlWarenkorbartikel; $x++)
      {
          if( $Kaufart[$x] == 'Restwert')
            {
               $gesamtPreis = $Warenkorbartikel[$p]['Preis'] +$gesamtPreis;
            } 
             else
          {
            $gesamtPreis = $Warenkorbartikel[$p+1]['Preis'] +$gesamtPreis;
          }

          $p = $p+2;
      }
       echo  '<b>'.(number_format($gesamtPreis/100, 2, ',', '.')) . " € "; 
?>
    </td>
  </tr>

  <tr  >
    <td  style="width: 60%; height: 30px; ">
        Versandkosten / Tauschkosten gesamt

    </td>
    <td style="width: 20%;text-align: right; ">

    <?php 
      $gesamtVersand = 0.0;
      $p = 0;

      for($x = 0; $x< $AnzahlWarenkorbartikel; $x++)
      {
       if($Kaufart[$x] == 'Restwert')
            { 
                $gesamtVersand =  $Warenkorbartikel[$p+1]['Preis'] + $gesamtVersand;
            }
        else
        {
           $gesamtVersand = $Warenkorbartikel[$p]['Preis'] + $gesamtVersand;
        }
        $p = $p+2;

      }

       echo  '<b>'.(number_format($gesamtVersand /100, 2, ',', '.')) . " € "; 


    ?>

    </td>
  </tr>

  <tr >
    <td>
        Servicekosten  <span  class="glyphicon glyphicon-info-sign" id="Servicekosten" data-placement="right" aria-hidden="true" data-toggle="tooltip" title="Die Servicekosten setzen sich aus der Abwicklung des Transaktionsprozesses sowie dem Schutz vor Betrug und Unterstützungsleistungen unseres Teams zusammen.
          Die Servicekosten fallen für alle Transaktionen mit der Kreditkarte, PayPal und SOFORTÜberweisung an." ></span>  

 
    </td>

    <td style="height: 50px;  text-align: right; ">
      <?php
      $gesamtSumme = 0.0;
      $Servicekosten = 0.0;

      $gesamtSumme =  $gesamtVersand + $gesamtPreis;

      $Servicekosten =  (($gesamtSumme/100)*0.018) + 0.18 ;

      //  Servicekosten bsp. Mangopay, ohne eigenen Servicebetrag

       echo  '<b >'.number_format($Servicekosten , 2, ',', '.') . " € </b>"; 
      ?>
      
    </td>
  </tr>

  <tr style="color: #007500; font-size: 16px;">
    <td>
      <b>  Gesamtsumme </b>
    </td>

    <td style="height: 50px; border-top-style:solid; text-align: right; ">
      <?php    

      

      $gesamtSumme =  $gesamtSumme+ ($Servicekosten*100);

      //  Servicekosten bsp. Mangopay



       echo  '<b >'.number_format($gesamtSumme /100, 2, ',', '.') . " € </b>"; 
      ?>
      
    </td>
  </tr>
 </table>

        </div>
      </div>
    </div>
  </div>

  <div class="panel panelFarbe"  id="two" >
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Versandadresse / Rechnungsadresse
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        
          <div class="form-group row">
          <div class="col-sm-6"> 
              <div style=" padding-left:30px; margin-top: 30px; min-width: 30%; max-width: 100%; min-height: 200px; border-width: 1px; border-style: solid; border-radius: 4px; border-color: white;">
                  
            <form id="Adresse" > 
                       <div class="form-group row">                   
                           <div class="col-sm-5  "> 

                            <input  type="Vorname" class="form-control" placeholder="Vorname" id="Vorname">
                           </div>
                               <div class="col-sm-5">                    
                                  <input type="Nachname" class="form-control" placeholder="Nachname" id="Nachname">
                              </div>                        
                       </div>
                    
                    <div class="form-group row">  
                        <div class="col-sm-10"> 
                              <input  type="Strasse" class="form-control" placeholder="Straße, Hausnummer"  id="Strasse">
                        </div>
                    </div>

                    <div class="form-group row"> 
                        <div class="col-sm-3"> 
                           <input type="PLZ" class="form-control" placeholder="PLZ" id="PLZ">
                        </div>

                         <div class="col-sm-7 ">  
                          <input type="Ort" class="form-control" placeholder="Ort" id="Ort">
                         </div>
                    </div>

                    <div class="form-group row"> 
                        <div class="col-sm-2"> 
                           <button type="button" type="submit" id="AdresseHinzufuegen" class="btn btn-primary"> Adresse speichern</button>
                        </div>
                    </div>
           </form>  
         </div>
    </div>

          <div class="col-sm-6"  >
           <form id="ausgewaehlteAdresse">

            <div id="AdressenAusgabe">
            </div>
            

            <?php 

                if($Adresse != Null)
                    {//var_dump( $_SESSION['Adresse']);   

                      for($v = 0 ; $v < count($Adresse); $v++)
                      {
                        if(isset($Adresse[$v]))
                        
                        {
                          echo '<div id="'. $Adresse[$v]['idAdresse'].'"  class="AdresseMouseEnter"> ';
                          
                          
                              echo' <div style=" padding-left:80px; padding-top: 10px; max-width: 350px;  border-width: 1px; border-style: solid; border-radius: 4px;" >';
                             

                               echo' <div class="form-group row">  
                                      <div class="col-sm-8"> 

                                         <label class=" control-label" id="Namen'. $Adresse[$v]['idAdresse'].'" style="min-width:auto;"> '; echo $Adresse[$v]['Vorname'].", ". $Adresse[$v]['Nachname'];
                                         echo' </label>
                                      </div>
                                      <div class="col-sm-1 col-md-offset-1 loeschen" style="text-align:right;">
                                          <span  class="glyphicon glyphicon-remove" id="'.$Adresse[$v]['idAdresse'].'ZAdresse" aria-hidden="true" ></span>
                                      </div> 
                                 </div> ';

                                        echo'<div class="form-group row">  
                                            <div class="col-sm-8" > 
                                                  <label   class=" control-label" id="Strasse'. $Adresse[$v]['idAdresse'].'" style="margin-top:-20px;" >'; echo $Adresse[$v]['Strasse'];
                                             echo' </label>
                                            </div>
                                        </div>';

                                         echo'<div class="form-group row">  
                                            <div class="col-sm-1 " style="margin-top:-10px;"> 
                                                  <label   class=" control-label" id="PLZ'. $Adresse[$v]['idAdresse'].'"  >'; echo $Adresse[$v]['Postleitzahl'];
                                             echo' </label>
                                             </div>
                                             
                                            <div class="col-sm-5  col-md-offset-1" style="margin-top:-10px;"> 
                                                  <label  class=" control-label" id="Ort'. $Adresse[$v]['idAdresse'].'" >'; echo $Adresse[$v]['Ort'];
                                             echo' </label>
                                            </div>
                                          </div> 
                             </div> '; //</label>

                              

                             
                             
                              echo'   <div class="hideAdresse" id="'.$Adresse[$v]['idAdresse'].'AB" >'; // >

                               echo'  <div class="form-group row">  
                                      <div class="col-sm-12"> ';

                              echo' <div style="float:right; margin-top:-75px; ">';
                                    echo' <input type="radio" id="'.$Adresse[$v]['idAdresse'].'V"  name="Versandadresse" value="'.$Adresse[$v]['idAdresse'].'V" ';if($Adresse[$v]['ausgewaehlt'] == 'VR' || $Adresse[$v]['ausgewaehlt'] == 'V'){echo ' checked';} echo'> Lieferadresse<br>
                                     <input type="radio" id="'.$Adresse[$v]['idAdresse'].'R"  name="Rechnungsadresse" value="'.$Adresse[$v]['idAdresse'].'R"'; if($Adresse[$v]['ausgewaehlt'] == 'VR' || $Adresse[$v]['ausgewaehlt'] == 'R'){echo ' checked';} echo'>  Rechnungsadresse </div>';
                            echo' </div></div></div>



                              </div>';
                        } //ende if
                      }
                    } # // lade Ardessdaten des Nutzers  $_SESSION['Adresse']

            ?>
            </form>
           </div>
          </div>
        </div> 
      </div>
    </div>



 
<form id="ausgewaehlteZahlungsart"> 
  
  <div class="panel panelFarbe" id="three" >
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Zahlungsart
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">


                <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default" id="Zahlungsmethode1">
                   
                          <div class='test' id='3'>
                      <div class="panel-heading" role="tab" id="ZahlungsmethodeHeadingOne">
                        <h4 class="panel-title">
                         
                          <a class="collapsed " id="Kreditkarte" role="button" data-toggle="collapse" data-parent="#accordion2" href="#ZahlungsmethodeCollapseOne" aria-expanded="false" aria-controls="ZahlungsmethodeCollapseOne">
                          <table><tr><td> Kreditkarte (Mastercard / VISA)</td><td style="padding-left: 5px;"><span style="font-size:20px; " class="glyphicon glyphicon-credit-card"></span></td></tr></table>

                             <!--class="dauerHide"-->
                                  <input type="radio"  class="dauerHide" id="Kreditkarte2"  name="Zahlungsart" value="Kreditkarte"> 
                            
                          </a>
                        </h4>
                      </div>
                      </div>
                      <div id="ZahlungsmethodeCollapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="ZahlungsmethodeHeadingOne">
                        <div class="panel-body" >

                          <!--  <form id="Kreditkarte" > -->
                                 <div class="form-group row" >                   
                                     <div class="col-sm-3 "> 
                                            <input  type="Inhaber" class="form-control" placeholder="Karteninhaber" id="Karteninhaber">
                                     </div>
                                                                    
                                       
                                        <div class="col-sm-3"> 
                                              <input  type="Kreditkartennummer" class="form-control" placeholder="Kreditkartennummer"  id="Kreditkartennummer">
                                        </div>

                                        <div class="col-sm-1" style="width: auto;" >  
                                             <select class="form-control"  id="Monat"  style="border-radius: 4px;">
                                              
                                                                                          <option value="1">1</option> 
                                                                                          <option value="2">2</option> 
                                                                                          <option value="3">3</option> 
                                                                                          <option value="4">4</option> 
                                                                                          <option value="5">5</option> 
                                                                                          <option value="6">6</option> 
                                                                                          <option value="7">7</option> 
                                                                                          <option value="8">8</option> 
                                                                                          <option value="9">9</option> 
                                                                                          <option value="10">10</option> 
                                                                                          <option value="11">11</option> 
                                                                                          <option value="12">12</option> 
                                             </select>  
                                        </div><!-- input-->

                                        <div class="col-sm-1" style="width: auto;">  
                                             <select class="form-control"  id="Jahr"  style="border-radius: 4px;">
                                              
                                                                                          <option value="2018">2018</option> 
                                                                                          <option value="2019">2019</option> 
                                                                                          <option value="2020">2020</option> 
                                                                                          <option value="2021">2021</option> 
                                                                                          <option value="2022">2022</option> 
                                                                                          <option value="2023">2023</option> 
                                                                                          <option value="2024">2024</option> 
                                                                                          <option value="2025">2025</option> 
                                                                                          <option value="2026">2026</option> 
                                                                                          <option value="2027">2027</option> 
                                                                                          <option value="2028">2028</option> 
                                                                                          <option value="2029">2029</option> 
                                                                                          <option value="2030">2030</option> 
                                                                                          <option value="2031">2031</option> 
                                                                                          <option value="2032">2032</option> 
                                                                                          <option value="2033">2033</option> 
                                                                                          <option value="2034">2034</option> 
                                                                                          <option value="2035">2035</option> 
                                                                                          <option value="2036">2036</option> 
                                                                                          <option value="2037">2037</option> 
                                                                                          <option value="2038">2038</option> 
                                                                                          <option value="2039">2039</option> 
                                             </select>  
                                        </div><!-- input-->
                                    
                                        <div class="col-sm-1"> 
                                           <input type="Sicherheitscode" class="form-control" placeholder="CVC" id="Sicherheitscode">
                                        </div>
                                    </div>

                                  
                                    <div class="form-group row"> 
                                      <div class="alert alert-danger hideME" id="falscheKreditkartennummer" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Fehler:</span>
                                            Bitte gib eine gültige Kreditkartennummer ein.
                                       </div>  
                                         <div class="alert alert-danger hideME" id="falscherSicherheitscode" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Fehler:</span>
                                            Bitte gib einen gültigen Sicherheitscode ein
                                       </div>  
                                         <div class="alert alert-danger hideME" id="falschesAblaufdatum" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Fehler:</span>
                                            Bitte gib ein gültiges Ablaufdatum ein
                                       </div> 
                                  </div>

                                    <div class="form-group row"> 
                                        <div class="col-sm-2"> 
                                           <button type="button" type="submit" id="KreditkarteHinzufuegen" class="btn btn-primary"> Kreditkarte hinzufügen</button>
                                        </div>
                                        <div class="col-sm-2"> 
                                           <button type="button" type="submit" id="KreditkarteZahlen" class="btn btn-primary">mit Kreditkarte zahlen</button>
                                        </div>
                                    </div>
                             
                      </div>
                    </div>
                  
                </div> <!--ende div vom inneren panel -->             
                
                    <div class="panel panel-primary" id="Zahlungsmethode2">
                       <div class='test' id='1' >
                        <div class="panel-heading " role="tab" id="Zahlungsmethode2HeadingOne">
                        <h4 class="panel-title">
                         
                          <a class="collapsed " id="SofortueberweisungRadio" role="button" data-toggle="collapse" data-parent="#accordion2" href="#ZahlungsmethodeCollapse2" aria-expanded="false" aria-controls="ZahlungsmethodeCollapse2">
                            SOFORT Überweisung
                            <!--class="dauerHide"-->
                                  <input type="radio"  class="dauerHide" id="Sofortue"  name="Zahlungsart" value="Sofortueberweisung"> <br>
                            
                          </a> 
                        </h4>
                      </div></div>
                      <!--<div id="ZahlungsmethodeCollapse2" class="panel-collapse collapse " role="tabpanel" aria-labelledby="Zahlungsmethode2HeadingOne">
                        <div class="panel-body" >
                                    

                          <button type="button" type="submit" id="SOFORTUeberweisung" class="btn btn-primary"> Zahlen mit SOFORT Überweisung</button>

                      </div>
                    </div>  -->
                  </div>

              
                    <div class="panel panel-primary" id="Zahlungsmethode5">
                       <div class='test' id='2' > 
                        <div class="panel-heading " role="tab" id="Zahlungsmethode5HeadingOne">
                        <h4 class="panel-title">
                         
                         <a role="button" id="PayPal" data-toggle="collapse" data-parent="#accordion2" href="#ZahlungsmethodeCollapse5" aria-expanded="false" aria-controls="ZahlungsmethodeCollapse5"> <table><tr><td>   PayPal </td> <td style="padding-left: 5px;"><span class="glypho icon-paypal" aria-hidden="true" style="font-size: 20px;"></span></td></tr></table>
                          <!--class="dauerHide"-->
                                  <input class="dauerHide" type="radio" id="PayPal2"  name="Zahlungsart" value="PayPal">
                            
                          </a>                         
                        </h4>
                      </div> </div>
                      <!--
                      <div id="ZahlungsmethodeCollapse5" class="panel-collapse collapse " role="tabpanel" aria-labelledby="Zahlungsmethode5HeadingOne">
                        <div class="panel-body" >
                            <button type="button" type="submit" id="zahlenMitPaypal" class="btn btn-primary"> Zahlen mit PAYPAL</button>
                      </div>
                    </div>  -->               
                </div> <!--ende div vom inneren panel -->

      </div>
    </div>
  </div>
</div>  

</div>   
</form>
</div>
</div>



     </body>  
            
   <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
    <script src="Hilfsdokumente/js/jquery.min.js"></script>
     <script src="Hilfsdokumente/js/bootstrap.min.js"></script> 

     <script >

       $(document).ready(function(){


        $('[data-toggle="tooltip"]').tooltip(); 

        $('#Servicekosten').tooltip();
/*
        $('#Servicekosten').mouseover(function(){ 

          $('#Servicekosteninfo').show();

         });

        $('#Servicekosten'). mouseout(function(){ 

             $('#Servicekosteninfo').hide();

         });*/
            var AdressNrNeu = $('.hideAdresse input[type=radio][name=Rechnungsadresse]:checked').val();

            var AdressNrNeu3 = AdressNrNeu.split("R"); 
             AdressNrNeu = AdressNrNeu3[0];

            var AdressNrNeu2 = $('.hideAdresse input[type=radio][name=Versandadresse]:checked').val();

            var AdressNrNeu4 = AdressNrNeu2.split("V"); 
            AdressNrNeu2 = AdressNrNeu4[0];

              var kk = new Array;
             var rr = new Array;
             var jj = -1;
             var f = 0;

             elementAnzeigen();

             AdresseEinfuegen();

             Zahlungsmethode();

             OnLoadZahlungsmethode() 
             

             function elementAnzeigen()
             {
               var AdressNrNeu = $('.hideAdresse input[type=radio][name=Rechnungsadresse]:checked').val();
               

               var AdressNrNeu3 = AdressNrNeu.split("R"); 

                       console.log(AdressNrNeu3[0] );
                       AdressNrNeu = AdressNrNeu3[0];

                    document.getElementById(AdressNrNeu+'AB').style.display = 'block';

                var AdressNrNeu2 = $('.hideAdresse input[type=radio][name=Versandadresse]:checked').val();

                var AdressNrNeu4 = AdressNrNeu2.split("V");

                          console.log(AdressNrNeu4[0] );
                           AdressNrNeu2 = AdressNrNeu4[0];

                    document.getElementById(AdressNrNeu2+'AB').style.display = 'block';
             }


       $('.hideAdresse input[type=radio][name=Rechnungsadresse]').change(function() {        
      
           var elRechn = AdressNrNeu;
           var Rechn = this.id.split("R");     

            document.getElementById(Rechn[0]+'AB').style.display = 'block';        

             if(elRechn != '0' )
              {   
                if(AdressNrNeu2 != elRechn )
                  {              
                        document.getElementById(elRechn+'AB').style.display = 'none';  
                  }             
              }
           AdressNrNeu = Rechn[0];

           console.log(AdressNrNeu);

            AdresseEinfuegen();

       });

       $('.hideAdresse input[type=radio][name=Versandadresse]').change(function() {

         var elVersand = AdressNrNeu2;
         var Versand = this.id.split("V"); 
        
         document.getElementById(Versand[0]+'AB').style.display = 'block';

           if(elVersand != '0')
              { 
                if(AdressNrNeu != elVersand )
                {               
                  document.getElementById(elVersand+'AB').style.display = 'none';  
                }                 
              }

               AdressNrNeu2 = Versand[0];

                AdresseEinfuegen();
       });



     $('#AdressenAusgabe').click(function (){

          AdresseEinfuegen();
      });


       function AdresseEinfuegen()
       {
        //Ausgabe der Adresse
        //1. welche Adresse ist angeklickt? check

         var aVersandAdresse = $('input[type=radio][name=Versandadresse]:checked').val();
         var aRechnungsAdresse = $('input[type=radio][name=Rechnungsadresse]:checked').val();

         var Versand = aVersandAdresse.split("V"); 
         aVersandAdresse =  Versand[0];

         var Rechn = aRechnungsAdresse.split("R"); 
         aRechnungsAdresse = Rechn[0];

         console.log(aVersandAdresse);
         console.log(aRechnungsAdresse);

        //2. Lese die Daten der angeklickten Adresse aus.
       
          var name = $('#Namen'+aVersandAdresse).html();
          var Strasse = $('#Strasse'+aVersandAdresse).html();
          var PLZ = $('#PLZ'+aVersandAdresse).html();
          var Ort = $('#Ort'+aVersandAdresse).html();

       console.log(name, Strasse, PLZ, Ort );

         kk = new Array;
         var ll = -1;

         if(aVersandAdresse == aRechnungsAdresse)
        {

            kk[++ll]  ='<div style=" padding-top:10px; padding-left:30px; padding-right:30px; margin-left:10px; margin-bottom: 20px;min-height: 130px; border-width: 1px; border-style: solid; border-radius: 4px; padding-top: 10px; font-size:14px;">';

         

          kk[++ll]  ='<div style="font-size:14px; font-weight:bold;" >Liefer- und Rechnungsadresse : </div>';

          kk[++ll]  ='  <div style=" margin-left:40px;">  ';
                             
          kk[++ll]  ='  <div class="form-group row" style="margin-top:20px; ">  ';
          kk[++ll]  ='  <div class="col-sm-12"> ';

          kk[++ll]  =' <label class=" control-label" style="min-width:auto; margin-bottom:0px; font-weight: normal;"> '+name;
          kk[++ll]  =' </label></div></div> ';

          kk[++ll]  =' <div class="form-group row" > '; 
          kk[++ll]  =' <div class="col-sm-12" > ';
          kk[++ll]  =' <label   class=" control-label"  style="margin-top:-13px; font-weight: normal;" > '+Strasse; 
          kk[++ll]  =' </label> </div> </div>';

          kk[++ll]  ='<div class="form-group row" >';  
          kk[++ll]  =' <div class="col-sm-12 " >';
          kk[++ll]  ='<label   class=" control-label" style=" margin-top:-26px; font-weight: normal;" >'+PLZ+' '+ Ort;
          kk[++ll]  =' </label></div>';
                                             
        
          kk[++ll]  =' </label></div></div></div> ';
          

        $('#AdresseEinfuegen').html(kk.join(''));

      }
      else{

         var nameR = $('#Namen'+aRechnungsAdresse).html();
          var StrasseR = $('#Strasse'+aRechnungsAdresse).html();
          var PLZR = $('#PLZ'+aRechnungsAdresse).html();
          var OrtR = $('#Ort'+aRechnungsAdresse).html();

          kk[++ll]  ='<div style="border-width: 1px; border-style: solid; border-radius: 4px; margin-left:10px; margin-top:-20px; ">';

          kk[++ll]  ='<table><tr><td style=" width:auto; padding-left:40px; padding-right:30px; padding-top:10px; margin-bottom: 20px;min-height: 130px;  font-size:14px;">';


          kk[++ll]  ='<div style="font-size:14px; font-weight:bold;" >Lieferadresse :</div>';
                             
          kk[++ll]  ='  <div class="form-group row" style="margin-top:20px; font-weight: normal;">  ';
          kk[++ll]  ='  <div class="col-sm-12"> ';

          kk[++ll]  =' <label class=" control-label" style="min-width:auto;  font-weight: normal; "> '+name;
          kk[++ll]  =' </label></div></div> ';

          kk[++ll]  =' <div class="form-group row"> '; 
          kk[++ll]  =' <div class="col-sm-12" > ';
          kk[++ll]  =' <label   class=" control-label"  style="margin-top:-13px; font-weight: normal;" > '+Strasse; 
          kk[++ll]  =' </label> </div> </div>';

          kk[++ll]  ='<div class="form-group row">'  
          kk[++ll]  =' <div class="col-sm-1 " style="margin-top:-13px; margin-right:10px; "> ';
          kk[++ll]  ='<label   class=" control-label" style="font-weight: normal;">'+PLZ;
          kk[++ll]  =' </label></div>';
                                             
          kk[++ll]  ='<div class="col-sm-5  " style="margin-top:-13px; font-weight: normal;"> ';
          kk[++ll]  =' <label  class=" control-label" style="font-weight: normal;" >'+Ort;
          kk[++ll]  =' </label></div></div> </td>';



          kk[++ll]  ='<td style=" width:auto; padding-right:10px;  margin-bottom: 10px; min-height: 130px; padding-top:10px; font-size:14px;">';
           kk[++ll]  ='<div style="font-size:14px; font-weight:bold;" >Rechnungsadresse :</div>';
                             
          kk[++ll]  ='  <div class="form-group row" style="margin-top:20px; ">  ';
          kk[++ll]  ='  <div class="col-sm-12"> ';

          kk[++ll]  =' <label class=" control-label" style="font-weight: normal;  " > '+nameR;
          kk[++ll]  =' </label></div></div> ';

          kk[++ll]  =' <div class="form-group row"> '; 
          kk[++ll]  =' <div class="col-sm-12" > ';
          kk[++ll]  =' <label   class=" control-label"  style=" margin-top:-13px; font-weight: normal;" > '+StrasseR; 
          kk[++ll]  =' </label> </div> </div>';

          kk[++ll]  ='<div class="form-group row">'  
          kk[++ll]  =' <div class="col-sm-1 " style="margin-top:-13px; margin-right:10px; "> ';
          kk[++ll]  ='<label   class=" control-label" style="font-weight: normal;" >'+PLZR;
          kk[++ll]  =' </label></div>';
                                             
          kk[++ll]  ='<div class="col-sm-8  " style="margin-top:-13px;"> ';
          kk[++ll]  =' <label  class=" control-label" style="font-weight: normal;" >'+OrtR;
          kk[++ll]  =' </label></div></div></td></tr></table></div> ';

           $('#AdresseEinfuegen').html(kk.join(''));


          //3. Schreibe die Daten in AdresseEinfuegen
          }
       }

 
       $(document).on('click', ".test", function () {

          console.log(this.id);
            if(this.id == '1')
            {
            //  $('input:radio[name="Zahlungsart" id="Sofortue"]').checked;
              $( '#Sofortue').prop( "checked", true );
              console.log('Sofortueberweisung checked')
            }

            if(this.id == '3')
            {
            //  $('input:radio[name="Zahlungsart" id="Sofortue"]').checked;
              $( '#Kreditkarte2').prop( "checked" ,true);


              console.log('Kreditkarte checked');
            }

            if(this.id == '2')
            {
            //  $('input:radio[name="Zahlungsart" id="Sofortue"]').checked;
              $( '#PayPal2').prop( "checked" ,true);

              console.log('PayPal checked');
            }

            Zahlungsmethode();
         
        });

      function OnLoadZahlungsmethode() 
      {
       var zahlungsmethode =  $('#ZahlungsartEinfuegen').attr('name');
       console.log(zahlungsmethode+'name');



      // Wenn der Value den gleichen wert hatn wie die Variable Zahlungsmethode dann soll der Radiobutton checked sein
        if(zahlungsmethode == 'Sofortueberweisung')
        {
          $( '#Sofortue').prop( "checked", true );
        }
        if(zahlungsmethode == "Kreditkarte")
        {
          $( '#Kreditkarte2').prop( "checked", true );
        }
        if(zahlungsmethode == "PayPal")
        {
          $( '#PayPal2').prop( "checked", true );
        }

    

       var aa = new Array;
       var bb = -1;


        if( zahlungsmethode == '')
        {
          aa[++bb]  ='<div style="  padding-left:40px; padding-right:30px; margin-left:10px; margin-bottom: 20px;min-height: 130px; border-width: 1px; border-style: solid; border-radius: 4px; padding-top: 10px; font-size:12px;">';
         

          aa[++bb]  ='<div style="font-size:12px; font-weight:bold;" ></div>';
                             
          aa[++bb]  ='  <div class="form-group row" style="margin-top:35px;">  ';
          aa[++bb]  ='  <div class="col-sm-12"> ';

          aa[++bb]  =' <label class=" control-label" style="min-width:auto; font-size:16px;"> Bitte wählen Sie eine Zahlungsart aus!';
          aa[++bb]  =' </label></div></div> </div>';
        }
        else
        {


        aa[++bb]  ='<div style="  padding-left:40px; padding-right:30px; margin-left:10px; margin-bottom: 20px;min-height: 130px; border-width: 1px; border-style: solid; border-radius: 4px; padding-top: 10px; font-size:12px;">';
         

         // aa[++bb]  ='<div style="font-size:12px; font-weight:bold;" ></div>';
                             
          aa[++bb]  ='  <div class="form-group row" style="margin-top:20px;">  ';
          aa[++bb]  ='  <div class="col-sm-5"> ';

         

          aa[++bb]  =' <label class=" control-label" style=" min-width:auto; font-size:20px; ">'+zahlungsmethode ;
        
        
          aa[++bb]  =' </label></div></div>';

          aa[++bb]  ='  <div class="form-group row" >  ';
          aa[++bb]  ='  <div class="col-sm-5"> ';

          if(zahlungsmethode =="Kreditkarte")
            {
               aa[++bb]  ='<span style="padding-left:30px; padding-right: 30px; font-size:35px;" class="glyphicon glyphicon-credit-card"></span>';
            }

          if(zahlungsmethode == "PayPal")
            {
           aa[++bb]  =' <span style=" padding-left:20px; padding-right: 30px; font-size: 25px; " class="icon-paypal"  > </span>';         
            }

          aa[++bb]  =' </div> </div> </div>';

          $('#ZahlungsartEinfuegen').html(aa.join(''));
        }

      }

       function Zahlungsmethode() {

        var pp = new Array;
        var oo = -1;

        var Zahlungsart = $('input[type=radio][name=Zahlungsart]:checked').val();

        console.log(Zahlungsart);

        // wenn  Zahlungsart
        if(typeof Zahlungsart == 'undefined')
        {
          pp[++oo]  ='<div style="  padding-left:40px; padding-right:30px; margin-left:10px; margin-bottom: 20px;min-height: 130px; border-width: 1px; border-style: solid; border-radius: 4px; padding-top: 10px; font-size:12px;">';
         

          pp[++oo]  ='<div style="font-size:12px; font-weight:bold;" ></div>';
                             
          pp[++oo]  ='  <div class="form-group row" style="margin-top:35px;">  ';
          pp[++oo]  ='  <div class="col-sm-12"> ';

          pp[++oo]  =' <label class=" control-label" style="min-width:auto; font-size:16px;"> Bitte wählen Sie eine Zahlungsart aus!';
          pp[++oo]  =' </label></div></div> </div>';
        }
        else{

         pp[++oo]  ='<div style="  padding-left:40px; padding-right:30px; margin-left:10px; margin-bottom: 20px;min-height: 130px; border-width: 1px; border-style: solid; border-radius: 4px; padding-top: 10px; font-size:12px;">';
         

         // pp[++oo]  ='<div style="font-size:12px; font-weight:bold;" ></div>';
                             
          pp[++oo]  ='  <div class="form-group row" style="margin-top:20px;">  ';
          pp[++oo]  ='  <div class="col-sm-5"> ';

         

          pp[++oo]  =' <label class=" control-label" style=" min-width:auto; font-size:20px; "> '; if(Zahlungsart == 'Sofortueberweisung') {pp[++oo]  ='Sofortüberweisung';} else{ pp[++oo]  =Zahlungsart; } 
        
        
          pp[++oo]  =' </label></div></div>';

          pp[++oo]  ='  <div class="form-group row" >  ';
          pp[++oo]  ='  <div class="col-sm-5"> ';

            if(Zahlungsart =="Kreditkarte")
            {
               pp[++oo]  ='<span style="padding-left:30px; padding-right: 30px; font-size:35px;" class="glyphicon glyphicon-credit-card"></span>';
            }
            if(Zahlungsart == "PayPal")
            {
           pp[++oo]  =' <span style=" padding-left:20px; padding-right: 30px; font-size: 25px; " class="icon-paypal"  > </span>';
         
            }
          pp[++oo]  =' </label></div> </div> </div>';
        }
          
          

        $('#ZahlungsartEinfuegen').html(pp.join(''));

         // body...
       }

       function AdresseAendern()
       {
        // kopiert die daten einer vorhandenen Adresse in die freien Eingabefelder
        // nimmt ein update bei Bestätigung der Änderungen vor
       }
        

           $("#AdressenAusgabe")
             .mouseenter(function() {                                  
                                         
                                      var id = $( ".AdresseMouseEnter").attr('id');
                                        // console.log(id);                                 
                                      document.getElementById(id+'AB').style.display = 'block';

                                    // console.log( $('#AdressenAusgabe .AdresseMouseEnter').attr("id").split(' '));
                                                                                                            
                                   })
             .mouseleave(function() {                                

                                        var id = $( ".AdresseMouseEnter").attr('id');
                                       // alert(id); 
                                       document.getElementById(id+'AB').style.display = 'none';
                                       elementAnzeigen();
                                       // console.log(id); 

                                    // element soll gehidet werden
                                  });

             $(".AdresseMouseEnter" )
             .mouseenter(function() {   

                                   
                                      document.getElementById(this.id+'AB').style.display = 'block';

                                      // element wird sichtbar                                     
                                   })
             .mouseleave(function() {
                                 

                                   document.getElementById(this.id+'AB').style.display = 'none';
                                   elementAnzeigen();

                                    // element soll gehidet werden
                                  });

          // onclick Button jetzt zahlen
          
            $('#zahlungsvorgangStarten').click(function(){ 
          
            var formData = new FormData();          
            var formlaenge  =  document.getElementById("ausgewaehlteAdresse").elements;

            var istCheckded2 = 0

             console.log(formlaenge);

             for (i =0;  i<formlaenge.length; i++) 
             { 
              if( formlaenge[i].checked)
              {  
                 formData.append("Adresse[]", formlaenge[i].value); 
                 istCheckded2++;
              }
            }

            if(istCheckded2 == 0)
            {  
                document.getElementById('AdresseError').style.display = 'block';                                    
            }



            var formlaenge2  =  document.getElementById("ausgewaehlteZahlungsart").elements;

            var istCheckded = 0;


        console.log(formlaenge2);

            if(formlaenge2[0].checked)
            {
               formData.append("Zahlungsart", formlaenge2[0].value); 
               istCheckded++;
            }

             if(formlaenge2[8].checked)
            {
               formData.append("Zahlungsart", formlaenge2[8].value); 
                istCheckded++;
            }

             if(formlaenge2[9].checked)
            {
               formData.append("Zahlungsart", formlaenge2[9].value); 
                istCheckded++;
            }

            if(istCheckded == 0)
            {  
                document.getElementById('ZahlungsartError').style.display = 'block'; 
            }  // Hinweis wählen sie bitte eine Zahlungsart aus! 

           var xhttp = new XMLHttpRequest();           

           if(istCheckded > 0 && istCheckded2 > 0)
           {

            /*Als Erstes:   Überprüfung der Werte auf Plausibilität --> Entspricht der Preis der Realität
              Als zweites:  Abwicklung des Kaufs zwischen Kunden und Payment Firma
              Als Drittes:  Bearbeitung der Daten in der Datenbank sowie Briefe über Zahlungsbestätigung und Versand aufforderung verschicken.*/

            xhttp.open("POST", "Hilfsdokumente/Plausibilitaetspruefung.php", true);
            xhttp.onreadystatechange = function()
            {
              if (xhttp.readyState ==4 && xhttp.status == 200)
              {
                console.log("it Works");
                console.log( xhttp.responseText);  
                
              // wenn Erfolgreich dann das sonst nicht, evtl brauche ich es auch garnicht
                //xhttp.open("POST", "Hilfsdokumente/Zahlungsvorgang.php", true);



                 // window.document.location.href = "Hilfsdokumente/KaufeArtikelKommunikation.php";
              }
           };
            xhttp.send(formData);  
          }

          });


         $('#Error .glyphicon-remove').click(function(){ 
          console.log(this.id);

          if(this.id == 'Error1')
          {document.getElementById('ZahlungsartError').style.display = 'none'; }

          if (this.id == 'Error2')
          {
            document.getElementById('AdresseError').style.display = 'none'; 
          }

         });


         $('#AdresseHinzufuegen').click(function(){      


         var formData = new FormData();          
         var formlaenge  =  document.getElementById("Adresse").elements;
         console.log(formlaenge);

         var Fehler = 0;

         for (i =0;  i<formlaenge.length; i++) 
         {          if( formlaenge[i].value != "" )
          {  
              Fehler++;
              console.log(formlaenge[0].value); 
          }
        }

        if(Fehler !=0)
        {

         //wenn Fehler > 0 dann Infobox "Bitte füllen Sie alle freien Felder aus."
               var r = new Array;
               var j = -1;
             formData.append("Vorname", formlaenge[0].value); 
             formData.append("Nachname", formlaenge[1].value); 
             formData.append("Strasse", formlaenge[2].value); 
             formData.append("PLZ", formlaenge[3].value); 
             formData.append("Ort", formlaenge[4].value); 
             formData.append("AdressseAkutallisieren", 0);

             Vorname = formlaenge[0].value;
             Nachname = formlaenge[1].value;
             Strasse = formlaenge[2].value;
             PLZ  = formlaenge[3].value;
             Ort =  formlaenge[4].value;

             var xhr = new XMLHttpRequest(); 

             xhr.open("POST", "Hilfsdokumente/AdresseSpeichern.php");
                                //xhr.setRequestHeader("Content-Type", "image/png");
                     xhr.onload = function (oEvent) { 

                      if(xhr.status == 200) {
                                  console.log("Uploaded!");

                                  console.log( xhr.responseText);
                                   var txt = xhr.responseText;

                                  var resp = txt.split("TTT");

                                  console.log(resp[1]);
                                  console.log(txt);
                                  console.log(Strasse);

                                   

                                   //Timestamp!!!! muss im responseText enthalten sein

                                    rr[++jj] = ' <div id="'+resp[1]+'" class="AdresseMouseEnter">';

                                   
                                    rr[++jj] = ' <div style=" padding-left:80px; padding-top: 20px; max-width: 350px;  border-width: 1px; border-style: solid; border-radius: 4px;" >';

                                    rr[++jj] = '  <div class="form-group row"> '; 
                                    rr[++jj] = '        <div class="col-sm-8"> ';

                                    rr[++jj] = ' <label class=" control-label" id="Namen'+resp[1]+'" style="  min-width:auto;"> '+Vorname+', '+Nachname ;
                                    rr[++jj]  =' </label>';
                                    rr[++jj]  ='        </div>';
                                    rr[++jj]  ='        <div class="col-sm-1  col-md-offset-1" style="text-align:right; ">';
                                    
                                    rr[++jj]  ='    <span class="glyphicon glyphicon-remove" name="test" id="'+resp[1]+'ZAdresse" aria-hidden="true" ></span>';

                                    rr[++jj]  ='        </div>  '; 
                                    rr[++jj]  ='  </div>  ';  

                                        rr[++jj]  ='<div class="form-group row">';  
                                        rr[++jj]  =' <div class="col-sm-8 "> ';
                                        rr[++jj]  ='       <label   class=" control-label" id="Strasse'+resp[1]+'" style="margin-top:-10px; " >'+Strasse;
                                        rr[++jj]  ='  </label>';
                                        rr[++jj]  =' </div>';
                                        rr[++jj]  =' </div>';

                                    rr[++jj]  =' <div class="form-group row">  ';
                                    rr[++jj]  ='  <div class="col-sm-1 " style="margin-top:-10px;"> ';
                                    rr[++jj]  ='    <label   class=" control-label"  id="PLZ'+resp[1]+'">'+ PLZ;
                                    rr[++jj]  ='  </label>';
                                    rr[++jj]  ='  </div>';
                                   
                                    rr[++jj]  =' <div class="col-sm-5  col-md-offset-1" style="margin-top:-10px;"> ';
                                    rr[++jj]  ='     <label  class=" control-label" id="Ort'+resp[1]+'" >'+Ort;
                                    rr[++jj]  ='  </label>';
                                    rr[++jj]  =' </div>';
                                    rr[++jj]  ='  </div> </div>    ';   

                                    rr[++jj]  ='  <div class="hideAdresse" id="'+resp[1]+'AB" >'; // >

                                    rr[++jj]  ='   <div class="form-group row"> '; 
                                    rr[++jj]  ='  <div class="col-sm-12"> ';

                                    rr[++jj]  ='<div style="float:right; margin-top:-75px; ">';
                                    rr[++jj]  =' <input type="radio" id="'+resp[1]+'V"  name="Versandadresse" value="'+resp[1]+'V" checked> Lieferadresse<br>';
                                    rr[++jj]  =' <input type="radio" id="'+resp[1]+'R"  name="Rechnungsadresse" value="'+resp[1]+'R" checked>  Rechnungsadresse </div>';
                                    rr[++jj]  =' </div></div></div> </div> ';  

                                     

                                    $('#AdressenAusgabe').html(rr.join(''));

                                    

                                     AdresseEinfuegen();
                                 
                                } 
              }; // schliesse onload
              xhr.send(formData);// ende for

       }//ende if Fehler
       else
       {
            alert("Bitte füllen Sie alle freien Felder aus. Danke!");
       }

       });

        

        //die Farbe wird nach einem klick blau  
          $('.panel').on('click', function(){ 

           var panelAnzahl =  $(".panel" );  // alle panel     
           var derzeitigesAtr =  this.className.split(" "); // angeklicktes pannel

           for (var i = 0; i < panelAnzahl.length; i++) { 

                    // console.log(panelAnzahl[i]);

                     var split =  panelAnzahl[i].className.split(" ");
                    // console.log(split);

                     if(panelAnzahl[i].id == this.id )
                     {
                      $("#"+this.id).attr('class', 'panel panelFarbe2');
                   // console.log( $("#"+this.id)+"halol");
                     }
                     else
                     {
                      $("#"+panelAnzahl[i].id).attr('class', 'panel panelFarbe');
                     }
            }
     
      });


$(document).on('click', "#AdressenAusgabe .glyphicon-remove", function () {

   console.log( this.id);
              
          var res = this.id.split("Z");

          console.log(res[0]+res[1]);

          var xhttp = new XMLHttpRequest(); 
          var formData = new FormData(); 

          formData.append("Post", res[0]); 
          formData.append("Tabelle", res[1]); 
          formData.append("Herkunft", "Adresse");  
          formData.append("AdressseAktuallisieren", 0);  

        xhttp.open("POST", "Hilfsdokumente/EintragLoeschen.php", true);
        xhttp.onreadystatechange = function()
        {
          if (xhttp.readyState ==4 && xhttp.status == 200)
          {
            console.log("it Works");
            console.log( xhttp.responseText);  

             rr = new Array; 

            $('#'+res[0]).html(rr.join(''));       
            
                 // window.document.location.href = "Hilfsdokumente/KaufeArtikelKommunikation.php";
          }
        };
        xhttp.send(formData); 
      
    });

        
$('.loeschen .glyphicon-remove').click(function(){
 

  if( this.id != '')
    {  
          var res = this.id.split("Z");

          console.log(res[0]+res[1]);

          var xhttp = new XMLHttpRequest(); 
          var formData = new FormData(); 

          formData.append("Post", res[0]); 
          formData.append("Tabelle", res[1]); 
          formData.append("Herkunft", "Adresse");  
          formData.append("AdressseAkutallisieren", 0);  

        xhttp.open("POST", "Hilfsdokumente/EintragLoeschen.php", true);
        xhttp.onreadystatechange = function()
        {
          if (xhttp.readyState ==4 && xhttp.status == 200)
          {
            console.log("it Works");
            console.log( xhttp.responseText);  

             rr = new Array; 

            $('#'+res[0]).html(rr.join(''));       
            
                 // window.document.location.href = "Hilfsdokumente/KaufeArtikelKommunikation.php";
          }
        };
        xhttp.send(formData);   
       }      
       });

    }); // document onload close

     </script> 

</html>