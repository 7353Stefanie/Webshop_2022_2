<?php




 require_once(__DIR__.'\Buttons\Hilfsdokumente\VerkaufsartikelKommunikation.php');

 session_start();

    if(!isset($_SESSION['benutzername']))
    {
        header('Location: /../final/Final.php');
       exit();
     } 


 function switchIt($Artikel)
 {

  switch($Artikel['Kategorien']) {

    case 'Buecher':

      echo  $Artikel['0']['Autor'] . ", <br>";
      echo  $Artikel['0']['Erscheinungsjahr'] . ", ";
      echo  'Auflage: '.$Artikel['0']['Auflage']; 
       echo  "</td>";                                                   
      echo "<td style='width:9%;'><img id='miniaturbild' style='width:60px; height:80px;' src='Buttons/".$Artikel['Titelbild']."' alt='titelbild'> </td>";
      # code...
      break;

    case 'Kleidung':

      echo  $Artikel['0']['Marke'] . ", <br>";
      echo  $Artikel['0']['Groesse'] . ", ";
      echo  $Artikel['0']['Farbe'];

      echo  "</td>";                                                   
      echo "<td style='width:9%;'><img id='miniatorbild' style='width:80px; height:60px;' src='Buttons/".$Artikel['Titelbild']."' alt='titelbild'> </td>";
      # code...
      break;
    
    default:
      # code...
      break;
  }
 }

?>
<html lang="de">
  <head>
            <meta charset="utf-8"/>
            <title>Benutzerseite</title>    
            
            <link href="Buttons/Hilfsdokumente/css/bootstrap.min.css" rel="stylesheet"> 
            <link rel="stylesheet" href="Buttons/Hilfsdokumente/bootstrap-theme.min.css">
             <link rel="stylesheet" href="Buttons/Hilfsdokumente/bootstrap.css">
               <link rel="stylesheet" href="Buttons/Hilfsdokumente/css/willkommenStyle.css"> 
        
             
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

                
                               <form action="Buttons/sucheV2.php" method="post"  class="navbar-form navbar-left "  >
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

                                           <?PHP
                                                           echo   '<li><a href="Buttons/ArtikelAuswahl.php">';
                                                           echo   'Artikel hinzufügen </a></li>';
                                                           echo   '<li><a href="StartseitenAnmeldung.php">';
                                                           echo   'Willkommen ';
                                                           echo   $_SESSION['benutzername'];
                                                           echo   '</a></li>';                                                          
                                           ?>

                                         
                                             <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menü<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                              
                                              <li><a href="Warenkorb.php">Warenkorb</a></li>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a href="#">Impressum</a></li>
                                                  <li><a href="#">AboutUs</a></li> 
                                                  <li><a href="#">Hilfe &amp; Support</a></li>
                                                  <li><a href="#">FAQ</a></li> 
                                                  <li><a href="#">AGB</a></li> 

                                                </ul>
                                              </li> 
                                            <li><a href="Buttons/Hilfsdokumente/Logout.php" onclick="loescheCoockie()">Logout</a></li> 
                                             
                                        </ul>                             
                          
                         </div><!-- /.container-fluid -->
                      </nav>
            </header>
  </head>  
  <body>
        <header class="Kasten">
      <header style="margin-left: 6%;">
         <div  id="selector2" role="tablist">
          
            <div class="col-md-3" style="position: fixed;  ">   
<!-- Überschriften -->                      
                 <ul class="nav nav-pills nav-stacked">  
                      <div class="head2" role="tab" id="WillkommenHead">
                              
                                           <li role="Willkommen" class="active"> <a href="StartseitenAnmeldung.php" >
                                           <?PHP

                                             try{                                                   
                                                    echo 'Willkommen ';
                                                    echo $_SESSION['benutzername'];
                                                }
                                               catch(Exception $e)
                                                {   
                                                   echo 'Willkommen';
                                                }
                                           
                                           ?>
                                           
                                           </a></li> 
                      </div><!-- head ende -->

                      <div class="head2" role="tab" id="WarenkorbHead">
                                                          
                                          <li role="Warenkorb"><a href="Warenkorb.php"  >Mein Warenkorb</a></li>
                           
                      </div> <!-- head ende -->
                      
                      <div class="head2" role="tab" id="BestellungenHead">
                                                          
                                          <li role="Bestellungen"><a href="MeineBestellungen.php" >Meine Bestellungen</a></li>
                           
                      </div> <!-- head ende -->

                      <div class="head2" role="tab" id="ArtikelHead">
                                                          
                                          <li role="Artikel"><a href="MeineVerkaufsartikel.php">Meine Artikel</a></li>
                           
                      </div> <!-- head ende -->

                        <div class="head2" role="tab" id="GemerktHead">
                                                          
                                          <li role="Artikel"><a href="gemerkteArtikel.php">Meine gemerkten Artikel</a></li>
                           
                      </div> <!-- head ende -->

                      <div class="head2" role="tab" id="WatchlistHead">
                                                          
                                          <li role="Watchlist"><a  href="MeineWatchlist.php" >Meine Watchlist</a></li>
                           
                      </div> <!-- head ende -->

                      <div class="head2" role="tab" id="Nachrichten">
                                                          
                                          <li role="Nachrichten"><a  href="MeineNachrichten.php" >Meine Nachrichten</a></li>
                           
                      </div> <!-- head ende -->

                      <div class="head2" role="tab" id="KontoHead">
                                                          
                                          <li role="Konto"><a href="MeineKontodaten.php" >Meine Kontodaten</a></li>
                           
                      </div>

                      <div class="head2" role="tab" id="KontoeinstellungenHead">
                                                          
                                          <li role="Kontoeinstellungen"><a  href="MeineKontoeinstellungen.php" >Kontoeinstellungen</a></li>
                           
                      </div> <!-- head ende -->
                 </ul>
            </div><!-- col 3-->

            <div class="col-md-8" style=" width: 70%; margin-left: 27%; " >      

            <div class="tabStyle" >
                           <br>
                             <h4 style="text-align: center; font-weight: bold; position: relative;">Meine Verkaufsartikel</h4> 

                             <form  > 

<a  type="button"  class="btn btn-primary" style="font-size: 12px; float:right; margin-bottom: 10px;margin-right: 10px;" href="Buttons/ArtikelAuswahl.php" role="button"  >   <span id="hinzufügen" class="glyphicon glyphicon-plus" aria-hidden="true" ></span> Artikel hinzufügen</a>

                             

                            
                              
                                  
                              
                            </form>
                                
                                 
                                                
                                          <div style="box-sizing:border-box;  margin-left: auto; margin-right: auto;  border-radius: 4px; position: relative;  ">
                                                                                                               
                                               <table class="table" >
                                                 
                                                       <tr  style=" font-weight: bold; font-size: 12px;">
                                                          <td>Nr.</td>
                                                          <td>Artikel</td>
                                                          <td> Bild</td>
                                                          <td> Kaufdetails </td>
                                                          <td> Kosten </td>
                                                          <td> Status </td>

                                                           <td>                                                            
                                                          </td>  
                                                          <td></td>  
                                                                                                                                                                
                                                       </tr>

                                               <?php   
                                                    // Zur Unterstützung der Methode Löschen können alle Datenbankausgaben in einem Array gespeichert werden
                                                   $VerkaufsartikelKom = new VerkaufsartikelKommunikation();
                                                   $Artikelinfos = $VerkaufsartikelKom->Verkaufsartikel($_SESSION['idBenutzer']); 
                                                   
                                                  
                                                  

                                                   //$Preise = $_SESSION['Preise'];
                                                   //$Artikeldetails = $_SESSION['Artikeldetails'] ;

                                                  // var_dump($Artikeldetails);
                                                   //var_dump($Preise);
                                                   // var_dump($Preise);

                                                  $AnzahlVekaufsartikel =  count($Artikelinfos);

                                                  $var = 1;
                                                  $variable = 1;
                                                  $array = array();

                                                                                                    
                                                   for($y= 0; $y < $AnzahlVekaufsartikel ; $y++)
                                                    {

                                                    echo '<tr style="font-size: 12px;">';
                                                    echo "<td style='width:10px;;'>";
                                                    echo $var++;
                                                    echo "</td>";
                                                    echo "<td style='width:35%;'><b>";
                                                    echo  $Artikelinfos[$y]['Bezeichnung'] . "</b>, ";

                                                    switchIt($Artikelinfos[$y]);

                                                  
                                                    // $rows2 enthällt die Artikeldaten $Row enthällt ein Array mit den einzelnen Buchzuständen 
                                                                                                     
                                                                                                                                    
                                                                            //echo "<td >Menge: <b>".   $Artikelinfos[$y]["Verkaufsmenge"] . "</b><br>";
                                                                            echo " <td >Zustand: <b> ".   $Artikelinfos[$y]["Zustand"] ."</b> <br></td>";
                                                                            echo "<td style='width:17%;'>";
                                                                           // var_dump($row2);
                                                                

                                                          if($Artikelinfos[$y]['Kauf'] == 1 || $Artikelinfos[$y]['Tausch'] == 1 ) // wenn entweder kauf oder nur Tausch angegeben wurde ...
                                                                     {
                                                                            if( $Artikelinfos[$y]['Kauf'] != 0)
                                                                            {                                                                                 
                                                                                    echo  '<b>'.$Artikelinfos[$y]['2']['Preis']/100 . " € "; 
                                                                                    echo  $Artikelinfos[$y]['2']['Kaufarten'] . "  </b><br>"; 
                                                                                    echo '<div class="klein">zzgl. '. $Artikelinfos[$y]['1']['Preis']/100  . " € Versand <br></div>" ; 

                                                                                    
                                                                            }

                                                                             if($Artikelinfos[$y]['Kauf'] == 1 && $Artikelinfos[$y]['Tausch'] == 1 )
                                                                                {
                                                                                   echo " <b>oder</b><br>";
                                                                                
                                                                                }
                                                                                           
                                                                           if( $Artikelinfos[$y]['Tausch'] != 0)
                                                                            {                                                                              
                                                                                    echo '<b>'. $Artikelinfos[$y]['1']['Preis']/100 . " € "; 
                                                                                    echo  $Artikelinfos[$y]['1']['Kaufarten'] . "  <br></b>";              
                                                                            }
                                                                        }
                                
                                                   echo "</td>"; 
                                                   echo "<td>";

                                                   if($Artikelinfos[$y]['Verfuegbarkeitsstatus'] == 1)
                                                          { echo 'Verfügbar';}

                                                   if($Artikelinfos[$y]['Verfuegbarkeitsstatus'] == 2)
                                                          { echo '<b>Verkauft</b>, <div style="color:red;">Handlung erforderlich!</div>';}

                                                  if($Artikelinfos[$y]['Verfuegbarkeitsstatus'] == 0 )
                                                  {
                                                    echo 'Im Warenkorb eines Kunden'; 
                                                  }

                                                   echo "</td>"; 


                                                    echo '<td>

                                                   <div style=" line-height=1.9; margin-left:5px; margin-right=5px; margin-top:5px; margin-buttom:5px;">
                                                    <span  id="'; echo $Artikelinfos[$y]['idVerkaeuferposition'].'WVerkaufsartikelW'. $Artikelinfos[$y]['Kategorien'].'W'.  $Artikelinfos[$y]['Zeitstempel']; echo'"    class="glyphicon glyphicon-trash" aria-hidden="true"></span> </div>';
                                                   if($Artikelinfos[$y]['Verfuegbarkeitsstatus'] == 2)
                                                   {
                                                   echo' <div style="  line-height=1.9; margin-left:5px; margin-right=5px; margin-top:5px; margin-buttom:5px;">';
                                                    
                                                   echo '<span id="" class="glyphicon glyphicon-file" style="color:red" aria-hidden="true"></span></div> ';
                                                   }
                                                    echo' </td>';
                                                    echo '</tr>';
                                                   }       
                                                                                                      
                                                    
                                                      ?>

                                    </table> 
                        </div> 
            </div> <!-- ende col 8-->
   

</div>
</div>

       

    </header>
  </header>
    </body>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Buttons/Hilfsdokumente/js/bootstrap-filestyle.min.js"></script> 
-     <script src="Buttons/Hilfsdokumente/js/bootstrap.min.js"></script> 
     <script src="Buttons/Hilfsdokumente/js/jquery-filestyle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    

     <script type="text/javascript">

$(document).ready( function() {

      $('.glyphicon-trash').click(function()
       {

          var res = this.id.split("W");
          
          console.log(res[0]+res[1]+res[2]+res[3]);

          var xhttp = new XMLHttpRequest(); 
          var formData = new FormData(); 

          formData.append("Post", res[0]);  // idArtikel
          formData.append("Tabelle", res[1]); // Herkunft
          formData.append("Kategorie", res[2]);  //
          formData.append("Zeitstempel", res[3]);  
        

           xhttp.open("POST", "Buttons/Hilfsdokumente/EintragLoeschen.php", true);          
        xhttp.onreadystatechange = function()
        {if (xhttp.readyState ==4 && xhttp.status == 200)
          {
            console.log("it Works");
            console.log( xhttp.responseText);

           var response = xhttp.responseText;
          /* var Alert = response.indexOf("Alert:");
           
           if(Alert ==true)
           { var txt;
             var r = confirm("Der Artikel liegt bei einem Kunden im Warenkorb. Möchten Sie Ihren Artikel dennoch löschen?");
              if (r == true) {
                formData.append("LoeschenOK", 'OK');
                  
              } 
              else {
                  txt = "You pressed Cancel!";
    
                  formData.append("LoeschenOK", 'OK');  
                }           
          
              window.document.location.href = "Buttons/Hilfsdokumente/VerkaufsartikelKommunikation.php";

            } // ende if 
*/
          }

        xhttp.send(formData);              
       }// ende if
      });// ende function

 });

     </script>  

  </html>