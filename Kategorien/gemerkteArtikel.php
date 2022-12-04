<?php
   define('__ROOT__', '../../Final/Kategorien/Buttons/Hilfsdokumente');
 require_once(__ROOT__.'/gemerkteArtikelAktuallisieren.php');
// session_start();


     if(!isset($_SESSION['benutzername']))
    {
        header('Location: /../final/Final.php');
       exit();
     } 



 function switchIt($Kategorie, $Artikel)
 {

  switch($Kategorie) {

    case 'Buecher':

      echo  $Artikel['0']['Autor'] . ", <br>";
      echo  $Artikel['0']['Erscheinungsjahr'] . ", ";
      echo  'Auflage: '.$Artikel['0']['Auflage']; 
      # code...
      break;

    case 'Kleidung':

      echo  $Artikel['0']['Marke'] . ", <br>";
      echo  $Artikel['0']['Groesse'] . ", ";
      echo  $Artikel['0']['Farbe'];
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
<link rel="stylesheet" href="Buttons/Hilfsdokumente/css/Komprimierung.css">
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
      <header style="margin-left: 5%;">
         <div  id="selector2" role="tablist">
          
            <div class="col-md-3" style="position: fixed; ">   
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
 <div class="col-md-8" style="margin-left: 27%; display: box; align-items: center;  justify-content: center; " >                    
<!-- Inhalte -->         
 <div class="tabStyle">
                                                <br>
                                                <h4 style="text-align: center; font-weight: bold">Meine gemerkten Artikel</h4>  
                                                <br>
                                                

                                               <table class="table">
                                                 
                                                       <tr  style=" font-weight: bold; font-size: 12px;">
                                                          
                                                          <td>Nr.</td>
                                                            <td> Artikel</td>
                                                          <td> Bild</td>
                                                          <td> Kaufdetails </td>
                                                          <td> Kosten </td>
                                                          <td></td>
                                                          <td>                                                             
                                                          </td>                                                                                                        
                                                       </tr>


                                              <?php
                                                    // Zur Unterstützung der Methode Löschen können alle Datenbankausgaben in einem Array gespeichert werden
                                                  
                                                  $var = 1;
                                                  $variable = 1;
                                                  $array = array();


                                                  $gemerkteArtikel = new gemerkteArtikel();
                                                 
                                                  $gemerkteArtikeldP = $gemerkteArtikel->AusgabeAllergemerktenArtikelDerPerson(); 

                                                   
                                                     if(count($gemerkteArtikeldP)>1) // überprüft ob die Liste gefüllt ist
                                                  {
                                                  
                                                  
                                                  

                                                                                
                                                 
                                                    // [0] == Verkäuferpositionsinfos, 
                                                   /*["idVerkaeuferposition"] ["idBenutzer"] ["idArtikel"] ["Zustand"] ["Kauf"]=> string(1) "1" ["Tausch"]=> string(1) "1" ["Verfuegbarkeitsstatus"]

                                                   // [1] == Artikelliste
                                                   /*["idArtikel"]  ["Kategorien"] ["Bezeichnung"] ["Titelbild"]
                                                   */
                                                   //[2] == Benutzername
                                                   //["idBenutzer"] ["Benutzername"]

                                                   //[3] == Kaufarten
                                                   /*["idKaufarten"] ["Preis"] ["Kaufarten"] ["idVerkaeuferposition"] ["ausgewaehlt"]
                                                   */
                                                // var_dump($gemerkteArtikeldP);

                                                   
                                                  //echo 'Test ArrrayKey';

                                                  $Liste_Pos_Anz_Verkaeuferposition = $gemerkteArtikel->array_Key_count($gemerkteArtikeldP,'Zustand');

                                                  $Liste_Pos_Anz_Artikelliste = $gemerkteArtikel->array_Key_count($gemerkteArtikeldP,'Titelbild');

                                                  $Liste_Pos_Anz_Benutzername = $gemerkteArtikel->array_Key_count($gemerkteArtikeldP,'Benutzername');

                                                  $Liste_Pos_Anz_Kaufarten = $gemerkteArtikel->array_Key_count($gemerkteArtikeldP,'Preis');

                                                  $Liste_Pos_Anz_Details = $gemerkteArtikel->array_Key_count2($gemerkteArtikeldP,'ISBN','Marke'); // An Kategroieren noch anpassen

                                                  

                                                  $Liste_Pos_Anz_GemerkteArtikel = $gemerkteArtikel->array_Key_count($gemerkteArtikeldP,'idMerken');

                                                  // var_dump($Liste_Pos_Anz_Verkaeuferposition);
                                                  //  echo 'next \n  ';
                                                  //  var_dump($Liste_Pos_Anz_Artikelliste);
                                                  //  echo 'next \n  ';
                                                  //  var_dump($Liste_Pos_Anz_Benutzername);
                                                  //  echo 'next \n  ';
                                                  //  var_dump($Liste_Pos_Anz_Kaufarten);

                                                  //  echo 'next \n  ';

                                                    //var_dump($Liste_Pos_Anz_GemerkteArtikel);


                                                 // var_dump($gemerkteArtikeldP);

                                                  //var_dump( $Liste_Pos_Anz_Details);
                                                   //var_dump($gemerkteArtikeldP['19']['0']);



                                                   $zaehler = 0;  
                                                   $zaehler2 = 0;
                                                   $k = 0;

                                                 for($y= 0; $y <= count($Liste_Pos_Anz_Verkaeuferposition)-1; $y++)
                                                  {
                                                    
                                                    // der Hintergrund wird blau wenn sich der Artikel bereits im Warenkorb befindet
                                                    echo '<tr style="font-size: 12px; " >';
                                                    echo "<td style='width:5%;'>";
                                                    echo $var++;
                                                    echo "</td>";
                                                    echo "<td style='width:40%;'><b>";

                                                      $e= $y;


                                                          if($y>0)
                                                          {
                                                              if($gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]['idArtikel']  == $gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y-1]]['idArtikel'])
                                                              {
                                                                if($y>0)
                                                                  { $zaehler++;
                                                                    $e = $e - $zaehler;
                                                                  }
                                                              }
                                                              else
                                                              {
                                                                $e= $y-$zaehler;
                                                              }
                                                          }

                                                         // echo $e;

                                                    echo  $gemerkteArtikeldP[$Liste_Pos_Anz_Artikelliste[$e]]['Bezeichnung'] . "</b>, ";

                                                    //echo $gemerkteArtikeldP[$Liste_Pos_Anz_Artikelliste[$e]]['Kategorien'];
                                                    //var_dump($gemerkteArtikeldP[$Liste_Pos_Anz_Details[$e]]);

                                                    switchIt($gemerkteArtikeldP[$Liste_Pos_Anz_Artikelliste[$e]]['Kategorien'], $gemerkteArtikeldP[$Liste_Pos_Anz_Details[$e]]);

                                                    $b = $y;


                                                 if($y>0)
                                                { 
                                                    if($gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]['idBenutzer'] == $gemerkteArtikeldP[$Liste_Pos_Anz_Benutzername[$y-$b]]['idBenutzer'])
                                                    {
                                                      $zaehler2++;
                                                      $b = $b - $zaehler2;
                                                        
                                                    }
                                                    else
                                                    {
                                                      $zaehler2 = 0;
                                                    }
                                                  }
                                                

                                                    echo "</br></br>Anbieter: <b> ".  $gemerkteArtikeldP[$Liste_Pos_Anz_Benutzername[$b]]['Benutzername'] . "</b> <br>"; 

                                                    echo  "</td>";                                                   
                                                    echo "<td style='width:12%;'><img id='miniatrubild' style='width:60px; height:80px;' src='Buttons/".$gemerkteArtikeldP[$Liste_Pos_Anz_Artikelliste[$e]]['Titelbild']."' alt='titelbild'> </td>";
                                                   
                                                    // $rows2 enthällt die Artikeldaten $Row enthällt ein Array mit den einzelnen Buchzuständen 
                                                                                                     
                                                                                                                                    
                                                                           // echo "<td>Menge: <b>".  $gemerkteArtikeldP[$y]['1']["Verkaufsmenge"] . "</b><br>";
                                                                            echo " <td>Zustand: <b> ".  $gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]["Zustand"] ."</b> <br></td>";
                                                                            echo "<td style='width:15%;'>";
                                                                           // var_dump($row2);
                                        // variable für Kaufarten                         

                                                          if($gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]['Kauf'] == 1 || $gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]['Tausch'] == 1 ) // wenn entweder kauf oder nur Tausch angegeben wurde ...
                                                                     {
                                                                            if( $gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]['Tausch'] != 0)
                                                                            {                                                                                 
                                                                                    echo  $gemerkteArtikeldP[$Liste_Pos_Anz_Kaufarten[$y+$k]]['Preis']/100 . " € "; 
                                                                                    echo  $gemerkteArtikeldP[$Liste_Pos_Anz_Kaufarten[$y+$k]]['Kaufarten'] . "  <br>";         
                                                                            }                                                                     

                                                                    }


                                                           if($gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]['Kauf'] == 1 && $gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]['Tausch'] == 1 )
                                                                                {
                                                                                   echo " <b>oder</b><br>";
                                                                                
                                                                                }
                                                                                           
                                                                           if( $gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]['Kauf'] != 0)
                                                                            {                                                                              
                                                                                    echo  $gemerkteArtikeldP[$Liste_Pos_Anz_Kaufarten[$y+1+$k]]['Preis']/100 . " € "; 
                                                                                    echo  $gemerkteArtikeldP[$Liste_Pos_Anz_Kaufarten[$y+1+$k]]['Kaufarten'] . "  <br>";              
                                                                            }                                      
                                                                         
                                
                                                   echo "</td>";  

                                                                             

                                                  echo' <td style="width:20%;">
                                                    <span style="color:red; cursor: pointer;  margin-right:3px;font-size:15px; margin-bottom:5px;" id="'; echo $gemerkteArtikeldP[$Liste_Pos_Anz_GemerkteArtikel[$y]]['idMerken'].'ZMerken'; echo'"  onclick="MerkenEintragLoeschen(this.id)"  class="icon-heart-broken" aria-hidden="true"></span> Löschen</br>';
                                                   // echo $gemerkteArtikeldP[$Liste_Pos_Anz_GemerkteArtikel[$y]]['idMerken'];

                                                    

                                                  echo'  <div id="sofortKaufW'. $gemerkteArtikeldP[$Liste_Pos_Anz_Kaufarten[$y+$k]]['idVerkaeuferposition'] .'" class="EMSK" ><span style="margin-right:10px; cursor: pointer;  margin-bottom:5px; "class="glyphicon glyphicon-euro" aria-hidden="true"> </span>Sofort kaufen</br></div>';

                                                        if($gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]['Verfuegbarkeitsstatus'] == 0 )  // 0 = = im Warenkorb eines Kunden
                                                        {
                                                          
                                                          if($gemerkteArtikeldP[$Liste_Pos_Anz_Verkaeuferposition[$y]]['idBenutzer'] ==  $_SESSION['idBenutzer'] )  
                                                           {
                                                            echo'<span style="margin-right:10px; cursor: pointer;  margin-bottom:5px; color: #4863a0; "class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><b>Im Warenkorb</b></br>';
                                                           echo '</td></tr>';  
                                                            }
                                                            else
                                                            {
                                                             echo'<span style="margin-right:10px; cursor: pointer ; margin-bottom:5px; color: #4863a0; "class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><b>Nicht verfügbar</b></br>';
                                                           echo '</td></tr>';  
                                                            }


                                                         }
                                                        else
                                                        {
                                                         

                                                          echo'<div id="EinkaufswagenW'. $gemerkteArtikeldP[$Liste_Pos_Anz_Kaufarten[$y+$k]]['idVerkaeuferposition'] .'"  class="EMSK"><span style="margin-right:10px; cursor: pointer;  margin-bottom:5px;  "class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Zum Warenkorb hinzufügen</br></div>';
                                                            echo '</td></tr>';   
                                                        }       


                                                        $k++;                                        

                                                   } //for 

                                                   } // if ende

                                                 
                                                if(count($gemerkteArtikeldP)<1)
                                                  {
                                                    echo '<div class="container">
                                                                <h4>Es befinden sich hier derzeit keine gemerkten Artikel. </h4>
                                                            </div>';

                                                    
                                                  }
                                                ?>
</table>

                                    </div>                                          
</div><!-- col-8 -->
</div><!-- selector -->


    </header>

    </body>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Buttons/Hilfsdokumente/js/bootstrap-filestyle.min.js"></script> 
     <script src="Buttons/Hilfsdokumente/js/bootstrap.min.js"></script> 
     <script src="Buttons/Hilfsdokumente/js/jquery-filestyle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

     <script type="text/javascript">


      $('.EMSK').on('click', function(){ 
                   
          Name = this.id.split('W');

          console.log(Name);


         console.log(this.id);
          var formData = new FormData(); 
         

          formData.append("idVerkaeuferposition", Name['1']);
          formData.append("Aktion", Name['0']);


           var xhr = new XMLHttpRequest(); 

       xhr.open("POST", "Buttons/Hilfsdokumente/AuswahlArtikel.php");
                          //xhr.setRequestHeader("Content-Type", "image/png");
               xhr.onload = function (oEvent) { 

                if(xhr.status == 200) {
                            console.log("Uploaded!");

                            console.log( xhr.responseText);  
                            
                           window.document.location.href = "gemerkteArtikel.php";
                         }                            
                         
        }; // schliesse onload
        xhr.send(formData);// ende for
      


        });


       function MerkenEintragLoeschen(Merken)
       {

          var res = Merken.split("Z");

          console.log(res[0]+res[1]);

          var xhttp = new XMLHttpRequest(); 
          var formData = new FormData(); 

          formData.append("Post", res[0]); 
          formData.append("Tabelle", res[1]);    

        xhttp.open("POST", "Buttons/Hilfsdokumente/EintragLoeschen.php", true);
        xhttp.onreadystatechange = function()
        {if (xhttp.readyState ==4 && xhttp.status == 200)
          {
            console.log("it Works");
           window.document.location.href = "gemerkteArtikel.php";
         
          }

        }
        xhttp.send(formData); 
             
       }

     </script>  

  </html>