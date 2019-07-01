<?php

 define('__ROOT__', 'C:/xampp/htdocs/Final/Kategorien/Buttons/Hilfsdokumente');
 require_once(__ROOT__.'/WarenkorbKommunikation.php');

  session_start();

      if(!isset($_SESSION['benutzername']))
    {
        header('Location: /../final/Final.php');
       exit();
    } 

    function switchIt($Artikel, $Kategorie)
 {
  switch($Kategorie['Kategorien']) {

    case 'Buecher':

      echo "<b>" .$Kategorie['Bezeichnung'] . "</b>, <br>";
      echo  $Artikel['Autor'] . ", ";
      echo  $Artikel['Erscheinungsjahr'] . ", ";
      echo  'Auflage: '.$Artikel['Auflage']; 
                                                      
      
      # code...
      break;

    case 'Kleidung':

      echo "<b>" .$Kategorie['Bezeichnung'] . "</b>, <br>" ;
      echo  $Artikel['Marke'] . ", ";
      echo  $Artikel['Groesse'] . ", ";
      echo  $Artikel['Farbe'];

     
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

     <div class="alert alert-danger hideME" id="Tauschlimit" role="alert">
                      <span class="glyphicon glyphicon-exclamation-sign"  aria-hidden="true"></span>
                      <span class="sr-only">Fehler:</span>
                       Ihr Tauschguthaben reicht leider nicht aus, um den gewählten Artikel zum Tauschpreis zu erwerben.
                      <span  class="glyphicon glyphicon-remove" id='Error1' style="float:right;" aria-hidden="true" ></span>
     </div> 

      <header class="Kasten">
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
            <div class="col-md-8" style="margin-left: 27%; " >      

            <div class="tabStyle" >
                                                <br>
                                                <h4 style="text-align: center; font-weight: bold; position: relative;">Mein Warenkorb</h4> 
                                                <br>

                                                
                                                <div style="box-sizing:border-box; width:700px; margin-left: auto; margin-right: auto;  border-radius: 4px; position: relative; padding-left: 175px;   ">
                                                             
                                        <form method="post" action="Buttons/Zahlung.php" name="form" >

                                                 <?php

                                                 $Warenkorb_Kom = new WarenkorbKommunikation();

                                                // $Guthaben =  $Warenkorb_Kom.Guthaben($_SESSION['idBenutzer']);

                                                  $Guthaben =$Warenkorb_Kom::Guthaben($_SESSION['idBenutzer']);
                                                  

                                                  
                                                  echo"<div class='Guthaben' id='".$Guthaben['Guthaben']."'></div>";
                                                             
                                                    echo '<div style="box-sizing:border-box; width:350px; margin-left: auto; margin-right: auto; border-radius: 4px; position: relative; display:inline-table;">' ;


                                                    
                                                                                                      

                                                    echo"  <div id='WarenkorbBer'>"; 
                                                    echo "</div>";
                                                  
                                                   
                                                
                                                   ?>
                                                                                                 
                                                    </div> 
                                                             <form method="post" action="Buttons/Zahlung.php" name="form" >
                                                           <div style="float: right; padding-top: 50px; display:table;">
                                                                <button style="margin-bottom: 20px;"  type="submit" class="btn btn-default" > Zur Kasse gehen! </button>
                                                          </div>
                                                </div>
                                                    
                                                                                                             
                                                      <table class="table" id='WarenkorbTabelle'>
                                                 
                                                       <tr  style=" font-weight: bold; font-size: 12px;">
                                                          <td>Nr.</td>
                                                          <td>Artikel</td>
                                                          <td> Bild</td>
                                                          <td> Kaufdetails </td>
                                                          <td> Kosten </td>
                                                          <td></td>
                                                          <td></td>                                                                                                       
                                                       </tr>
                                                    
                                              <?php
                                                    // Zur Unterstützung der Methode Löschen können alle Datenbankausgaben in einem Array gespeichert werden
                                                  
                                                 $Warenkorbartikel = $Warenkorb_Kom::Warenkorb($_SESSION['idBenutzer']);  
                                                  $AnzahlWarenkorbartikel = count($Warenkorbartikel) ;

                                                  //var_dump($Warenkorbartikel);

                                                  $var = 1;
                                                  $variable = 1;
                                                  $array = array();
                                                     
                                                 for($y= 0; $y < $AnzahlWarenkorbartikel; $y++)
                                                  {

                                                    echo '<tr style="font-size: 12px;">';
                                                    echo "<td style='width:5%;'>";
                                                    echo $var++;
                                                    echo "</td>";
                                                    echo "<td style='width:40%;'><b>";
                                                    echo  $Warenkorbartikel[$y]['Bezeichnung'] . "</b>, ";

                                                    switchIt( $Warenkorbartikel[$y]['2'],$Warenkorbartikel[$y] );



                                                    echo  "</td>";    

                                                    if($Warenkorbartikel[$y]['Kategorien'] == 'Buecher')  
                                                    {echo "<td style='width:10%;'><img id='miniaturbild' style='width:60px; height:80px;' src='Buttons/".$Warenkorbartikel[$y]['Titelbild']."' alt='titelbild'> </td>";} 

                                                    if($Warenkorbartikel[$y]['Kategorien'] == 'Kleidung')                                            
                                                   { echo "<td style='width:10%;'><img id='miniaturbild' style='width:80px; height:60px;' src='Buttons/".$Warenkorbartikel[$y]['Titelbild'] ."' alt='titelbild'> </td>";}
                                                   
                                                    // $rows2 enthällt die Artikeldaten $Row enthällt ein Array mit den einzelnen Buchzuständen 
                                                                                                     
                                                                                                                                    
                                                                            echo "<td>Menge: <b>".  $Warenkorbartikel[$y]['1']["Verkaufsmenge"] . "</b><br>";
                                                                            echo " Zustand: <b> ".  $Warenkorbartikel[$y]['1']["Zustand"] ."</b> <br></td>";
                                                                            echo "<td style='width:20%'>";
                                                                           // var_dump($row2);
                                                                

                                                          if($Warenkorbartikel[$y]['1']['Kauf'] == 1 || $Warenkorbartikel[$y]['1']['Tausch'] == 1 ) // wenn entweder kauf oder nur Tausch angegeben wurde ...
                                                                     {
                                                                                
                                                                               //in der ID der Artikel müssen der Wert, Artikelid , Tausch bzw. Kaufoption, Bezeichnung T oder K,  und die Zahlungsoption enthalten sein
                                                     //$Warenkorbartikel[$z]['1']['Kauf'] ==> Kaufoption (True/false)
                                                     //$Warenkorbartikel[$z]['0']['Tausch'] ==> Tauschoption (True/false)
                                                     //$Warenkorbartikel[$z]['1']['Preis'] --> Kaufpreis
                                                     //$Warenkorbartikel[$z]['0']['Preis'] --> Tauschpreis     
                                                     // Auslesen der Id bei Onclick 
                                                                      if( $Warenkorbartikel[$y]['1']['Tausch'] != 0)
                                                                            { 
                                                                               echo' <div class="T1">';
                                                                            } 
                                                                            else{ echo' <div class="T0">';}


                                                                          echo' <span  class="glyphicon glyphicon-info-sign" id="Servicekosten" data-placement="right" aria-hidden="true" data-toggle="tooltip" title="Der Tauschwert entspricht den Versandkosten" >
                                                                            </span>';
                                                                            echo  '<b style="padding-left:5px;">'.$Warenkorbartikel[$y]['1']['Preis']/100 . " € "; 
                                                                        
                                                                            echo  $Warenkorbartikel[$y]['1']['Kaufarten'] ;
                                                                         
                                                                         echo " </b> <input class='Kaufarten' type='radio' id='".$Warenkorbartikel[$y]['0']['idVerkaeuferposition']."W".$Warenkorbartikel[$y]['1']['Preis']."W". $Warenkorbartikel[$y]['1']['Tausch']. "WTW"."' name='Kaufarten ". $y . "' value='".$Warenkorbartikel[$y]['1']['Kaufarten']."W".$Warenkorbartikel[$y]['1']['Preis']."W". $Warenkorbartikel[$y]['0']['idVerkaeuferposition']."' >  <br></div>"; 
                                                                          
                                                                          

                                                                             if($Warenkorbartikel[$y]['1']['Kauf'] == 1 && $Warenkorbartikel[$y]['1']['Tausch'] == 1 )
                                                                                {
                                                                                   echo " oder<br>";                             
                                                                                }
                                                                                           
                                                                           if( $Warenkorbartikel[$y]['0']['Kauf'] != 0)
                                                                             { 

                                                                              echo' <div class="K1">';
                                                                              
                                                                             }
                                                                             else{ 

                                                                              echo' <div class="K0">';} 

                                                                                    echo '<b>'. $Warenkorbartikel[$y]['0']['Preis']/100 . " € "; 
                                                                                    echo  $Warenkorbartikel[$y]['0']['Kaufarten'] . 
                                                                                    
                                                                                    "</b>  <input class='Kaufarten' type='radio' id='".$Warenkorbartikel[$y]['0']['idVerkaeuferposition']."W".$Warenkorbartikel[$y]['0']['Preis']."W". $Warenkorbartikel[$y]['0']['Kauf']. "WKW"."' name='Kaufarten ". $y . "' value='".$Warenkorbartikel[$y]['0']['Kaufarten'] .'W'.$Warenkorbartikel[$y]['0']['Preis'].'W'. $Warenkorbartikel[$y]['0']['idVerkaeuferposition']."' checked>  <br></div>"; 
                                                                            if( $Warenkorbartikel[$y]['0']['Kauf'] != 0)
                                                                             {
                                                                              echo '<div class="klein"> zzgl. Versand '. $Warenkorbartikel[$y]['1']['Preis']/100 .' € </div>';
                                                                             }
                                                                     }  
                                                   echo "</td>";                                  

                                                    echo '<td><span id="'; echo $_SESSION['Warenkorbinfos'][$y]['idWarenkorb'].'ZWarenkorb'; echo'"    class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                    </td>';
                                                    echo '</tr>';
                                                   }       
                                                                                                      
                                                ?>
                                          </form>
                               </table> 
                        </div> 

            </div> <!-- ende col 8-->
           </div><!-- selector -->
    </header>
   </header>
    </body>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Buttons/Hilfsdokumente/js/bootstrap-filestyle.min.js"></script> 
     <script src="Buttons/Hilfsdokumente/js/bootstrap.min.js"></script> 
     <script src="Buttons/Hilfsdokumente/js/jquery-filestyle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    

     <script type="text/javascript">
     // neueid = 0;
/*
$( ".head2" ).click(function() {

  if(neueid == 0)
   {
    $('#WillkommenHead').css('background-color', 'white', 'font-color', '#f5f5f5');
  }
  else
  {
    $('#'+neueid ).css('background-color', 'white', 'font-color', '#f5f5f5');
   
  }

  neueid = this.id;
  console.log(this.id);

  $('#'+this.id).css('background-color', '#bfefff', 'font-color', 'white');

  
});*/


  $(document).ready( function() {

    var z = 0; // nicht überschreiben
    var Guthaben = $( ".Guthaben" ); 
      Guthaben = parseFloat(Guthaben['0'].id); 
    Kaufberechnung();

 //$('[data-toggle="tooltip"]').tooltip(); 
    


    


 $(' input[type=radio]').change(function() { 
  //alert('changed');

  var ergArray = new Array;
  var unchecked = 0;
   Guthaben = $( ".Guthaben" ); //hole Guthaben
  var Preis = parseFloat("0");

   Guthaben = Guthaben['0'].id;    

   var uncheckedTest =  $(".Kaufarten" );
   var alleGechecked =  $( "input:checked" ); 

   var res7 =  new Array;

   var d= 1;
   var neuerPreis = parseFloat(0);

   console.log(uncheckedTest);


  for (var i = 0; i < alleGechecked.length; i++) { 

            ergArray = alleGechecked[i].id.split("W");
           //var res7 = uncheckedTest[i+k].id.split("W");
            console.log(ergArray);


           if(ergArray['3'] == 'T')
           {
                unchecked =  uncheckedTest[i+d].id.split("W");
                //console.log(unchecked);

                Preis = parseFloat(unchecked['1']) + Preis;

                //console.log(alleGechecked[i]);

                if(this.id==alleGechecked[i].id)
                {
                //  console.log(alleGechecked);
                  neuerPreis = parseFloat(unchecked['1']);
                /*  console.log(Preis);
                  console.log(neuerPreis);*/
                }
           }
           d++;
           /*console.log(i+1);
           console.log(Preis);*/
           
}
/*console.log(neuerPreis);
console.log(Guthaben);
console.log(this.name);*/

if(Guthaben >= Preis)
{
  Guthaben = Guthaben - Preis;
  Kaufberechnung();
  console.log("im if");
}else
{
  //input[type=radio][name=Rechnungsadresse]:checked
  console.log("im else");
 
  Guthaben = parseFloat(Guthaben)  - (parseFloat(Preis)-neuerPreis) ;
    
    var suche = this.id;
    value =  $('.Kaufarten');
    var d =0;
    //console.log(value[0].id);
 
    for(c = 0; c < value.length ;c++)
    {
         d= value[c].id;

        if(d == this.id)
        {// gerade Tausch // ungerade Kauf  // +1 wenn gerade // -1 wenn ungerade


          if( ( c % 2) == 0 ) 
              {
                  console.log(value[c+1]);
                   $( '#'+value[c+1].id).prop( "checked", true );
         
              }
           else
           {
                  console.log(value[c-1]);
                 $( '#'+value[c-1].id).prop( "checked", true );
            }
        } 

         document.getElementById('Tauschlimit').style.display = 'block'; 
    }

  console.log(value);
    //.prop( "checked", true )
}//ende else

 });



         $('#Error1').click(function(){ 
          document.getElementById('Tauschlimit').style.display = 'none'; 
        });


   function Kaufberechnung()
   {  

     var rr = new Array;
     var jj = -1;
     var idArtikel = "";
     var Betrag = parseFloat("0");
     var Versandkosten =parseFloat("0");
    

      var test =  $( "input:checked" ); 
      var uncheckedTest =  $(".Kaufarten" );

     var  k = 0;

        for (var i = 0; i < test.length; i++) { 

            var res6 = test[i].id.split("W");
            var res7 = uncheckedTest[i+k].id.split("W");

            if(res6[3] != "T")
            {
                 Betrag = parseFloat(res6[1]) + Betrag; 
            }
            else{
                  Versandkosten = parseFloat(res7[1]) + Versandkosten;
                }

            
            if(res6[3] == 'K' )
            {
               Versandkosten = parseFloat(res7[1]) + Versandkosten;
              // console.log(res7);              
            }

            k++;

            }

            var hideKauf = $(".K0").hide();
            var hideTausch =   $(".T0").hide();

            var Gesamtsumme = Betrag + Versandkosten;


              rr[++jj] =   '<table class="table" style="  background-color: white; text-align: center; font-size: 14px; position: relative; border-radius: 6px;">';


               rr[++jj] =  '<tr style="font-weight: bold; ">';
               rr[++jj] = '<td>Tauschguthaben</td>';
               rr[++jj] = '<td style="min-width:20px;width:30%; ">';
               rr[++jj] =  Guthaben/100;
                                                    
               rr[++jj] = ' chips / € </td></tr>';

                rr[++jj] = '<tr style="background-color:white;"><td>Artikelkosten </td>';

              rr[++jj] = "<td>";
              rr[++jj] = " " + Betrag/100 + " € ";
              rr[++jj] = "</td>";
              rr[++jj] =  "</tr>"; 
              rr[++jj] = '<tr><td>Versandkosten / Tauschkosten </td>';   

               rr[++jj] ="<td>";
               rr[++jj] = " " +Versandkosten/100 + " € ";

                                                    
                rr[++jj] = "</td>";                                                    
                 rr[++jj] = "</tr>"; 

               
              rr[++jj] = '<tr><td><b>Gesamtsumme </b></td>';   

               rr[++jj] ="<td>";
               rr[++jj] = " <b>" +Gesamtsumme/100 + " € </b>";

                                                    
                rr[++jj] = "</td>";                                                    
                 rr[++jj] = "</tr>  </table>";             

                 $('#WarenkorbBer').html(rr.join(''));            
   }


  
       $('.glyphicon-trash').click(function(){
       
          var res = this.id.split("Z");

          console.log(res[0]+res[1]);

          var xhttp = new XMLHttpRequest(); 
          var formData = new FormData(); 

          formData.append("Post", res[0]); 
          formData.append("Tabelle", res[1]); 
          formData.append("Herkunft", "Warenkorb");    

        xhttp.open("POST", "Buttons/Hilfsdokumente/EintragLoeschen.php", true);
        xhttp.onreadystatechange = function()
        {
          if (xhttp.readyState ==4 && xhttp.status == 200)
          {
            console.log("it Works");
            console.log( xhttp.responseText);          
            
                  window.document.location.href = "Buttons/Hilfsdokumente/WarenkorbKommunikation.php";
          }
        }
        xhttp.send(formData); 
  
             
       });

       $('#abschicken').click(function(){   


     // console.log("ausgabe alles senden");

         var formData = new FormData();      
         var formlaenge = document.form.elements; 

         //console.log(formlaenge);

          for (var i = 0 ; i < formlaenge.length; i++) 
          {
              if (formlaenge[i].checked) 
              { 
                formData.append("Erwerb", formlaenge[i].value);                
              }
          }

           var xhr = new XMLHttpRequest(); 

             xhr.open("POST", "Buttons/Hilfsdokumente/KaufeArtikelKommunikation.php" , true);
                                //xhr.setRequestHeader("Content-Type", "image/png");
                       xhr.onreadystatechange = function()
                      {
                        if (xhr.readyState ==4 && xhr.status == 200)
                        {
                                  console.log("Uploaded!");

                                 // console.log( xhr.responseText);

                                 window.location.href = "Buttons/Zahlung.php";
                              } 
              }; // schliesse onload
              xhr.send(formData);// ende for


       });
});


     </script>  

  </html>