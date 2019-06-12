<?php
 session_start();
?>

<html  style=" background-color: #f5f5ff;" lang="de">
  <head >
            <meta charset="utf-8"/>
            <title>Kaufübersicht</title>                               
             

             <link rel="stylesheet" href="Hilfsdokumente/willkommenStyle.css"> 
             <link rel="stylesheet" href="Hilfsdokumente/ZumKauf.css">
            <link href="Hilfsdokumente/css/bootstrap.min.css" rel="stylesheet"> 
            <link rel="stylesheet" href="Hilfsdokumente/css/bootstrap-theme.min.css">
        
             
        <header > 
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
                                            <a class="navbar-brand" href="01_Bauteile/Final.html">Brand</a>
                                          </div> 
                                          
                                   <!-- die Suche  -->                     <!-- das obere ermöglicht bei einer kleineren Sicht die Verschiebung der Buttons. -->   
                                <div class="row">  
                                <div class="col-xs-12 col-md-7"> 
                                       <form class="navbar-form navbar-left ">
                                                    <div class="form-group" >
                                                      <input type="text" class="form-control" placeholder="Search" style="width: 30em; display: flex;">
                                                    </div>
                                                  <button type="submit" class="btn btn-default"> Suchen</button>
                                        </form>                                     
                                </div>  
                                                            <!-- Collect the nav links, forms, and other content for toggling -->                 
                                <div class="col-sm-4 col-md-4">
                                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">    
                                               <ul class="nav navbar-nav navbar-right">

                                                  <li><a href="willkommen2_funktioniert.php">

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
                                                 <li><a href="#">Kategorie</a></li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                                      <ul class="dropdown-menu">
                                                          
                                                 <li><a href="#">Warenkorb</a></li>
                                                 <li role="separator" class="divider"></li>
                                                 <li><a href="#">Impressum</a></li>
                                                 <li><a href="#">AboutUs</a></li> 
                                                 <li><a href="#">Hilfe &amp; Support</a></li>
                                                 <li><a href="#">FAQ</a></li> 
                                                 <li><a href="#">AGB</a></li>                                         
                                                      </ul>
                                                     </li>                                          
                                              </ul>
                                            </div> <!--nav bar-->
                                </div> <!-- col 3-->
                                </div><!-- row -->
                      </div><!-- /.container-fluid -->
                 </nav>
        </header>            
  </head>  
<body>
        
       <header>
            <div class="container-fluid" style=" background-color: #f5f5ff;"">
              <div class='row' style=" margin-left: 0; margin-right: 0; ">

                     <button class="col-md-4"  onclick="location.href='ZumKauf.php'"  style=" background-color: #f5f5f5;">Kaufübersicht</button>                        
                                    
                    
                     <button class="col-md-4"  onclick="location.href='ZuDenZahlungsdetails.php'"  style="background-color: #f5f5f5;">                    
                                    Zahlungsdetails
                     </button>
                     <button class="col-md-4"  onclick="location.href='ZurZahlungsbestaetigung.php'"  style="background-color: #f5f5f5;">
                                    Zahlungsbestätigung
                     </button>
                        
                         
              </div> <!-- row-->

                  <table class="table"  style= "margin-left: 3%; margin-right: 3%; float: left; max-width: 65%; margin-top: 50px; background-color: white;" >
                                               
                     <tr  style=" font-weight: bold; font-size: 14px;">
                         <td>Nr.</td>
                         <td>Artikel</td>
                         <td style="width: 30%;">Wähle eine Währungsart </td>
                         
                         <td> Umrechnungskurse </td>
                         <td></td>                                                                                                       
                     </tr>
                                   <?php
                                               $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop03');

                                                if ($mysqli->connect_error) {

                                                  echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                                                } else {   
   
                                                  $query = "SELECT Buchtitel, Autor, Erscheinungsjahr, Auflage, Benutzername, idWarenkorb
                                                            from Warenkorb, Bücher, Artikel, Verkäuferposition, Benutzer 
                                                            where Warenkorb.idArtikel = Artikel.idArtikel
                                                            
                                                            and Bücher.idBücher = Artikel.idBücher
                                                            and Verkäuferposition.idArtikel = Warenkorb.idArtikel                                                          
                                                            
                                                            and Verkäuferposition.idBenutzer = Benutzer.idBenutzer;                                                            
                                                            ";
                                                 
                                                 $query2 =    sprintf("Select Preis,Kaufarten, w.idWarenkorb
                                                                         from Kaufarten, Verkäuferposition, Warenkorb w
                                                                        where Verkäuferposition.idVerkäuferposition = w.idVerkäuferposition
                                                                          and Verkäuferposition.idVerkäuferposition = Kaufarten.idVerkäuferposition
                                                                          and w.idBenutzer = '%s'
                                                                     Group By idKaufarten",                         
                                                            
                                                                      $mysqli->real_escape_string($_SESSION['idBenutzer']) 
                                                            );

                                                  $result = $mysqli->query($query); # Enthält Benutzernamen und Passwort
                                                  $result2 = $mysqli->query($query2);
                                                
                                                  if ( ! $result )
                                                  {
                                                    die('Ungültige Abfrage: ' . mysqli_error());
                                                  }
                                                    // Zur Unterstützung der Methode Löschen können alle Datenbankausgaben in einem Array gespeichert werden
                                                   if ( ! $result2 )
                                                  {
                                                    die('Ungültige Abfrage: ' . mysqli_error());
                                                  }
                                                    // Zur Unterstützung der Methode Löschen können alle Datenbankausgaben in einem Array gespeichert werden
                                                  
                                                  
                                                   $rows = array() ;                                                   

                                                  while ($row = $result2->fetch_array(MYSQLI_ASSOC))
                                                         {
                                                             $rows[] = $row;
                                                         }
                                                  
                                                  $var = 0;

                                                  echo '<form action="ZuDenZahlungsdetails.php" name="FormularName" id="DasFormular" method="post">';
                                                  while ($zeile = $result->fetch_array(MYSQLI_ASSOC))
                                                  {
                                                    $var = $var+1;
                                                    
                                                    echo '<tr  style="font-size: 14px;">';
                                                    echo "<td>";
                                                    echo $var;
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo  $zeile['Buchtitel'] . ", ";
                                                    echo  $zeile['Autor'] . ", <br>";
                                                    echo  $zeile['Erscheinungsjahr'] . ", ";
                                                    echo  $zeile['Auflage'] . " <br><br> Anbieter: ";
                                                    echo  $zeile['Benutzername'] . " <br>";   
                                                    echo "<td>"; 
                                                   
                                                                                                   
                                                     foreach($rows as $row)                                                             
                                                            { 
                                                             if($zeile['idWarenkorb'] == $row['idWarenkorb'])
                                                              {
                                                                      echo '<label>';                                                                      

                                                                      if($row['Kaufarten'] == 'Euro')
                                                                      { 
                                                                                echo '<label style="margin-right:75px;">';
                                                                                echo  $row['Kaufarten'] . ": ";
                                                                                echo '</label>';

                                                                         $PreisEuro = $row['Preis']/100;
                                                                                
                                                                                echo '<label style="float:right;  ">';
                                                                                echo  $PreisEuro . " € ";  //
                                                                       
                                                                                    echo '<label style="float:right; margin-left:10px;">';

                                                                                    echo '<input type="radio" id="'; echo $var ."W" . $row['Kaufarten']; echo'" name="Zahlmethode'; echo $var . '" value="'; echo $row['Kaufarten']."W".$row['Preis']; echo '"></label>'; 

                                                                                echo '</label>';
                                                                      } // ende if
                                                                      else
                                                                      { 
                                                                        
                                                                        if($row['Kaufarten'] == "Bitcoins")
                                                                        {
                                                                            echo '<label style=" margin-right:45px; ">';
                                                                            echo  $row['Kaufarten'] . ": ";
                                                                            echo '</label>'; 

                                                                            echo ' <label style="margin-right:10px;">';
                                                                            echo $row['Preis'] ;                                                     
                                                                            echo ' </label>';  

                                                                            echo '<label style="float:right; margin-left:13px; ">';
                                                                            echo '<input type="radio" id="'; echo $var ; echo'" name="Zahlmethode'; echo $var . '" value="';echo $row['Kaufarten']."W".$row['Preis']; echo '">';
                                                                            echo '</label>';
                                                                        }// ende if
                                                                        else
                                                                        {  
                                                                            echo '<label style=" margin-right:20px; ">';
                                                                            echo  $row['Kaufarten'] . ": ";
                                                                            echo '</label>'; 

                                                                            echo  $row['Preis'] ; 

                                                                            echo '<label style="float:right; margin-left:23px; ">';
                                                                            echo '<input type="radio" id="'; echo $var; echo'" name="Zahlmethode'; echo $var . '" value="';echo $row['Kaufarten']."W".$row['Preis']; echo '">';
                                                                            echo "</label>";                                                                        
                                                                        }  // ende else                                                                     
                                                                       
                                                                      }// ende else
                                                                       echo "</label><br>";
                                                              } // ende for-each
                                                            } // ende while
                                                    
                                                    echo "</td>";                                                    
                                                    
                                                    
                                                    echo "<td>"; 
                                                     // hier kommen die Umrechnungskurse von Bitcoin und Tauschchip rein
                                                    echo "</td>"; 
                                                    
                                                    echo '<td><span  id="'; echo $WarenNr . "W" . $_SESSION['idBenutzer']; echo'"  onclick="WarenkorbEintragLöschen(this.id)" class="glyphicon glyphicon-trash" aria-hidden="true"></span> </td>';
                                                    echo "</tr>";

                                                    }
                                                      mysqli_free_result( $result );
                                                      mysqli_free_result( $result2 );
                                                                      }
                                // Ende Datenbankquery Zugriff 1 und 2
                                // query 2 ist in rows gespeichert                                     
                               echo "</form>";                                    
                               echo  '</table>';

                               echo  '<table id="Guthaben2" class="Guthaben2" style=" float:right; margin-top: 50px; margin-right: 100px; width: 20%; background-color:white;">';
                      

                               echo  '<tr style="height: 30px; padding-top: 5px;  padding-left: 5px; padding-bottom: 5px; padding-right:5px;" class="border_bottom">';
                                    echo  '<td  style=" font-weight: bold; padding-left:5px;">aktuelles Guthaben';
                                    echo  '</td>';
                               echo  '</tr>';
                              
                                  $Value = 0;
                                                if ($mysqli->connect_error)
                                                     {
                                                      echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
                                                     } 

                                                else {  //alle zahlungsmittel von Benutzerid x holen
                                                                  $query3 = sprintf("SELECT   Zahlungsart, Betrag
                                                                        from Benutzer, Geldkonto
                                                                        where Geldkonto.idBenutzer = Benutzer.idBenutzer                                                             
                                                                        and  Geldkonto.idBenutzer = '%s'",
                                                                        $mysqli->real_escape_string($_SESSION['idBenutzer']) 
                                                                        );

                                                                  $result3 = $mysqli->query($query3);     

                                                               if ( !  $result3 )
                                                                  {
                                                                    die('Ungültige Abfrage: ' . mysqli_error());
                                                                  }


                                                                while ($zeile3 = $result3->fetch_array(MYSQLI_ASSOC))
                                                              {
                                                               
                                                                echo '<tr id="DasGuthaben' . $Value . '" style="height: 25px;" >'; 
                                                                echo '<td style="padding-left:5px;">';

                                                                echo $zeile3['Zahlungsart'];
                                                                
                                                                echo "</td>";
                                                                echo '<td>';

                                                                echo  $zeile3['Betrag'];
                                                                echo "</td>";

                                                                echo "</tr>"; 

                                                                $Value = $Value++;
                                                                
                                                              }                                                      
                                                  
                                                      mysqli_free_result( $result3 );

                                                     }
                          //ende des class "Guthaben divs"                        

// ende Datenbankzugriff query 3

                                                    if ($mysqli->connect_error)
                                                     {
                                                      echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
                                                     } 
                                                     
                                                    else {
                                                      
                                                    echo '<tr style="height: 25px;" class="border_bottom">'; 
                                                            echo '<td  style="font-weight: bold; padding-left:5px;">'; 

                                                                  echo "Zu zahlen:";

                                                             echo "</td>";                                                   
                                                     echo '</tr>';


                                                     for($i= 1; $i<= $var;$i++)
                                                     {
                                                     echo '<tr id="Zahlmethode'.$i . '" style="  padding-top: 5px;  padding-left: 10px; padding-bottom: 5px; padding-right:  5px;" >';
                                                     echo '</tr>';
                                                     }
                                              }
                                                      mysqli_close($mysqli);
                                             ?>
              </table>

                      <form>

                        <div style="float: right; padding-top: 50px;padding-right: 140px; padding-bottom: 50px; display:table;">
                          <p><button class="btn btn-default" name="submit" form="DasFormular" type="submit" >Zu den Zahlungsdetails</button></p>
                        </div> 

                      </form>  

            </div> <!-- container-fluid-->
        </header>        
</body>        


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Hilfsdokumente/js/bootstrap.min.js"></script> 
     <script src="Hilfsdokumente/js/jquery.min.js"></script>
     
    <script type="text/javascript">

         $(document).ready( function() {

          function unique(array){
            return array.filter(function(el, index, arr) {
                return index == arr.indexOf(el);
            });
          }       
                   
            
          $('input[type="radio"]').change(function(e){
               
               
               var alleWerte = new Array;
               var r = new Array;                
               var ZuZahlen = new Array;
               var neueWerte = new Array;             
              
               var z = -1;               
               var count = -1;               
               var FormLaenge = 0;
               var ausgabeCheckedButtons = 0;
               
               var res = 0;
               // neu

               var Zh1 = 0;
               var Zh2 = 0;
                 
               FormLaenge = document.forms["FormularName"].elements.length;
              

              for(var i = 1; i <= FormLaenge; i++)
                   {
                      ausgabeCheckedButtons = $("input[name='Zahlmethode"+i+"']:checked").val();

                      if(ausgabeCheckedButtons != undefined)
                      {
                        console.log(ausgabeCheckedButtons);
                        //werte = $(this).attr('value'); // der Value aus dem Radiobutton wir in werte gespeichert 
                        
                        res = ausgabeCheckedButtons.split("W");        // in res werden die geteilten Werte gespeichert

                        neueWerte[Zh1] = res[0];
                        neueWerte[Zh1+1] = res[1];
                        
                        Zh1 = Zh1 +2;
                      }
                    }

                console.log(neueWerte);

                 var j = 0;
                 var b = 1;

              for( var k = 1; k <= neueWerte.length/2; k++) 
                    {                         
                               r[++j] ='<td style="padding-top:5px; padding-left:5px;">';
                               r[++j] = neueWerte[Zh2] ;                              
                               r[++j] = '</td>'; 
                               r[++j] = '<td>';
                        if(neueWerte[Zh2]=="Euro")    
                        {
                               r[++j] = neueWerte[Zh2+1]/100;
                               r[++j] = ' ';//€
                               r[++j] = '</td>';
                         }       
                         else
                        {
                                r[++j] = neueWerte[Zh2+1] ;                              
                               r[++j] = '</td>';
                               r[++j] = '';
                        }                                                    
                       
                        $('#Zahlmethode'+ k).html(r.join(''));

                        Zh2 = Zh2+2;  
                        j=0;  
                      }
                       
                      
                // console.log(r);
                  z = -1;

                $('#Guthaben2 td').each(function() {
                     alleWerte[++z] = $(this).html();      // schreibt das derzeitige Guthaben in ein Array             
                 });

                count = -1; 
                var kopieZuZahlen2 = new Array;
                 
                var aktGuthabenSpalte = alleWerte.indexOf('aktuelles Guthaben'); // Trennt die Werte von Guthaben und Zu zahlen
                var aktZuZahlenSpalte = alleWerte.indexOf('Zu zahlen:');              

              for (var p = aktZuZahlenSpalte+1; p <= alleWerte.length-1; ++p) {                            
                            ZuZahlen[++count] = alleWerte[p];                            
                 }

                 count = -1;
                 for (var p = aktZuZahlenSpalte+1; p <= alleWerte.length-1; ++p) {                            
                            kopieZuZahlen2[++count] = alleWerte[p];                            
                 }
                 // speichere r in einem neuen Array ab
                
                console.log(alleWerte);
                console.log(ZuZahlen);
                                           
                var laengeVonZuZahlen = ZuZahlen.length/2; // länge durch zwei damit die Anzahl der Zahlarten ermittelt wird
                   
                    // Wenn ZuZahlen [i] und in ZuZahlen vorhanden ist dann                
                var count = 0;
                var Kumuliert = 0;
                var Wert1 = 0;
                var Wert2 = 0;
                var kopieZuZahlen = ZuZahlen;                
             
                var neuesArray = new Array;

                var zuloeschen = 0;
                var zuloeschen2  = 0;
                var ArtikelNrID = 0;

                var arrPostition1 = 0;
                var arrPostition2 = 0;
                
                 var l = 0;
                 r = new Array;
                 j = 0;
                 
                 var fixeLaenge = ZuZahlen.length/2;             
                console.log(laengeVonZuZahlen);
                

                if(laengeVonZuZahlen>=2)  // wenn die Länge des Arrays größer ist als
                  {
                   for(var m = 0; m < fixeLaenge; ++m ) // läuft mindestens 2 mal durch
                    {
                           kopieZuZahlen = ZuZahlen;
                           zuloeschen  =  ZuZahlen.lastIndexOf(kopieZuZahlen[m+count]); // 
                           zuloeschen2 =  ZuZahlen.indexOf(kopieZuZahlen[m+count]);

                           console.log(m + "m" + count + " count ");
                           console.log(kopieZuZahlen[m+count] +" Position zur Überprüfung");
                           
                           console.log(zuloeschen2 + "zuloeschen2");
                           console.log(zuloeschen + "zuloeschen");
                           console.log(laengeVonZuZahlen + " länge von zu Zahlen");
                            console.log(ZuZahlen + " ZuZahlen");

                          if(zuloeschen != zuloeschen2) // ist ein wert doppelt?
                           {

                                zuloeschen = parseInt(zuloeschen);
                                zuloeschen2 = parseInt(zuloeschen2);

                                console.log(ZuZahlen);                               

                                Wert1 = parseInt(kopieZuZahlen[zuloeschen+1]);
                                Wert2 = parseInt(kopieZuZahlen[zuloeschen2+1]);                               

                                Kumuliert = (Wert1 + Wert2);
                                //ZuZahlen[zuloeschen+1] = Kumuliert; // erste Wert wurde überschreiben

                                for(var i = 1; i <= laengeVonZuZahlen; i++)
                                {$('#Zahlmethode'+ i).html(neuesArray.join(''));
                                }                                                            
                                console.log(ZuZahlen);
                               
                                  var p = 0;
                                
                                  z = -1;
                                  kopieZuZahlen = ZuZahlen.slice();
                                                                      
                                  ZuZahlen.splice(zuloeschen,2);
                                  ZuZahlen.splice(zuloeschen2,2);


                                  var laengeVonZuZahlen = ZuZahlen.length;
                                  if(laengeVonZuZahlen != 0)
                                  {
                                    ZuZahlen[laengeVonZuZahlen] = kopieZuZahlen[zuloeschen];
                                    ZuZahlen[++laengeVonZuZahlen] = Kumuliert;
                                  }
                                  else
                                  {
                                   ZuZahlen[0] = kopieZuZahlen[zuloeschen];
                                   ZuZahlen[1] = Kumuliert;
                                  }

                                  laengeVonZuZahlen = ZuZahlen.length/2;
                                  count = count -1;
                                  m = m-1;
                                  fixeLaenge = fixeLaenge-1;

                            }// ende if
                            count = count+1;
                          } // ende for
                          console.log(laengeVonZuZahlen + "letztes Ende von zu Zahlen");

                                 Zh2 = 0;
                                  j = 0;
                                 var b = 1;

                                  for( var k = 1; k <= ZuZahlen.length/2; k++) 
                                        {                       
                                                   r[++j] ='<td style="padding-top:5px;padding-left:5px;">';
                                                   r[++j] = ZuZahlen[Zh2] ;
                                                  
                                                   r[++j] = '</td>'; 
                                                   r[++j] ='<td>';

                                                   r[++j] = ZuZahlen[Zh2+1] ;

                                                    if(ZuZahlen[Zh2] == "Euro")
                                                   {  r[++j] = ' €';} 

                                                   r[++j] = '</td>';
                                                   r[++j] = '';
                                            
                                             $('#Zahlmethode'+ k).html(r.join(''));


                                            Zh2 = Zh2+2;  
                                            j=0;  
                                           
                                        }// ende for
                  } // ende if
                    
                    console.log(ZuZahlen);
                    console.log(kopieZuZahlen);
                    
            
            });


        });
      </script> 

</html>