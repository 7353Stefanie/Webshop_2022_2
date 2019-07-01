<?php
define('__ROOT__', 'C:/xampp/htdocs/Final/Kategorien/Buttons');
 require_once(__ROOT__.'/hintergrundSuche.php');
 session_start();

     if(!isset($_SESSION['benutzername']))
    {
        header('Location: /../final/Final.php');
       exit();
     } 

 

?>
<html lang="de">
  <head>
            <meta charset="utf-8"/>
            <title>Benutzerseite</title>                             
             
            <!-- <link rel="stylesheet" href="willkommenStyle.css"> -->
            
            <link rel="stylesheet" href="Hilfsdokumente/css/willkommenStyle.css"> 
             <link rel="stylesheet" href="Hilfsdokumente/css/Bilder.css">
             
            <link href="Hilfsdokumente/css/bootstrap.min.css" rel="stylesheet"> 
            <link rel="stylesheet" href="Hilfsdokumente/css/bootstrap-theme.min.css">
            <link rel="stylesheet" href="Hilfsdokumente/css/RadioButtons.css">
    
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
                                  
                                        <span>                                                                 
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
                                                           echo   '<li><a href="ArtikelAuswahl.php">';
                                                           echo   'Artikel hinzufügen </a></li>';
                                                           echo   '<li><a href="../StartseitenAnmeldung.php">';
                                                           echo   'Willkommen ';
                                                           echo   $_SESSION['benutzername'];
                                                           echo   '</a></li>';                                                          
                                           ?>

                                         
                                             <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menü<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                              
                                              <li><a href="../StartseitenAnmeldung.php">Warenkorb</a></li>
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

      <header >  <div class="ueberschrift" style="margin-left: 15px; margin-right: 15px; margin-top: 10px; padding-left: 10px; margin-bottom: 10px; border-width: 1px; border-style: solid; border-radius: 4px;">
            <h4>Artikelauswahl</h4>
          </div>
      </header>

      <div class="ueberschrift" style="margin-left: 15px; margin-right: 15px; margin-top: 10px; padding-left: 10px; padding-top:20px;margin-bottom: 10px; border-width: 1px; border-style: solid; border-radius: 4px;">

                      <form id="form1" action="" method="post"  name="form1" class="form-horizontal" >
                                           <div class="form-group ">
                                                                         <label  for="Kategorie" class="col-sm-1 control-label">Kategorie</label>
                                                                         <div class="col-sm-3 " style="width: 20%; margin-left: 10px;">
                                                                            <select class="form-control" name='Kategorie' id="Kategorie">
                                                                                  <option value="Buecher">Bücher</option> 
                                                                                  <option value="Kleidung">Kleidung</option> 
                                                                                  <option value="FreizeitundSport">Freizeit und Sport</option> 
                                                                                  <option value="Spielzeug">Spielzeug</option> 
                                                                                  <option value="Fahrzeug">Fahrzeug</option> 
                                                                                  <option value="HaushaltundGarten">Haushalt und Garten</option> 
                                                                                  <option value="Sonstiges">Sonstiges</option> 
                                                                           </select>
                                                                        </div>
                                           </div>  <!--form-group-->
                  
                                    <div class="form-group row"  >
                                       
                                         <div class="col-sm-1" style="margin-left: 10px;">
                                          <button  id="SucheKlick" class="btn btn-default "> Suchen</button>
                                         </div>

                                          <div class="col-sm-5">
                                            <input type="text" style="width:100%;"  name="suchen" class="form-control" id="SuchText" placeholder="Suche hier nach deinem Artikel" > 
                                          </div>                         
                                   </div>
                                    
                   </form>
     </div>

      <form id="form2" method="post" action="ArtikelHinzufügen_Buecher.php"  name="form2" >       

                    <?php  if( isset($_POST) )
                {   

                $i = 0; 

                echo '<div class="ueberschrift" style="margin-left: 15px; margin-right: 15px; margin-top: 10px; padding-left: 10px; margin-bottom: 10px; border-width: 1px; border-style: solid; border-radius: 4px;">';
                echo '<h4> Artikel:';
                                                             
                echo' <a style="margin-left:60px;"  href="ArtikelHinzufügen_Buecher.php" class="btn btn-primary">neuer Artikel hinzufügen</a>';

                echo '<button type="submit" value="Submit" style="float: right;  margin-right: 20px; margin-bottom: 5px; margin-top: -2px;"  class="btn btn-primary"> weiter</button>';

                echo ' </div>';


        $Suche = new Suche_Artikel();

        //var_dump($_POST);
    
        if($_POST != null)
        {   
          $erg = $Suche->suche_allg($_POST['Kategorie'] ,$_POST['suchen']);
          $laenge = count($erg); 
                     

            if( count($erg) > 4)
            {
              $anzahlrunden =  count($erg) / 4;
             $anzahlrunden= ceil($anzahlrunden);

             // var_dump($anzahlrunden);
              
              
                  $r = 0;
                        for ( $o = 0; $o < $anzahlrunden; $o++)
                        {
                          if($o == $anzahlrunden && $rest>=1)
                          {
                              $sliced = array_slice($erg, $r, $laenge-1 );
                          }
                          else
                          {  $sliced = array_slice($erg, $r, $r+2);
                          }

                            BuchsuchenV2($sliced);

                            $r= $r +3;
                        }
            }
            else
            {
             
               Buchsuchen($erg);
            }

          }
        }
          
      
        function Buchsuchen($erg)
        {
// start
             $s = 'src="'; $e = '"';  $a = 'alt="';$i = 0;    
               
                   echo'   <div class="ueberschrift" style="margin-left: 10px; height: 550px; margin-right: 10px; margin-top: 10px; padding-top:20px;margin-bottom: 10px; border-width: 1px; border-style: solid; border-radius: 4px;">';
                
                 echo ' <table style="margin-left:auto; margin-right: auto; margin-top: 0px;"  ><tr  >  ';

                  // Bildpfade im Ergebnis
                 
                //                 var_dump($erg); 
                if($erg != null) 
                    {
                 foreach ($erg as $key ) {
               //   var_dump($key);

                  echo' <td>';

                        echo'<div class="none" id="Artikel'.$i.'" style="  width:420px; height:250px;">';
                        echo '<label class="BuchSuchen" id="'.$i.'" for="Buch_'.$i.'" >';
                        echo' <img style="width:150px; height: 210px; float:left; margin-left: 30px;  margin-top: 20px; "'; echo $s . $key['Titelbild'] . $e ;  echo $a . $key['Bezeichnung'] .$e.'  />'; //breite des Bildes
                             
                        echo'  <table class="table"  style=" margin-top: 20px;  font-size: 12px; border-style: solid; max-width:120px; height: 200px; ">';
                        echo'  <tr >';

                                   echo '<td> Titel: </td> <td>'.  $key['Bezeichnung'] .'</td> </tr> <tr>';
                                   echo '<td>Autor: </td> <td> '.  $key['Autor'] .'</td>  </tr> <tr>';
                                   echo '<td>ISBN: </td> <td>'.  $key['ISBN'] .' </td>  </tr> <tr>';
                                   echo '<td>Jahr: </td> <td>'.  $key['Erscheinungsjahr'] .'</td></tr>';
                                    echo '<td>Auflage: </td> <td>'.  $key['Auflage'] .'</td></tr>';                                    
                                
                        echo ' </tr> ';
                        echo ' </table>';                        
                    
                         echo ' <input class="RButtons" style="margin-right: 175px;  " type="radio" name="Buch" id="Buch_'.$i.'" value="'.$key['idArtikel'] .'"> ';
                         echo '   </label> '; 
                      $i++;      

                    echo ' </div> ';  
                echo ' </td> '; 

                    }  
                 }  
            echo '</tr><tr>';

                   if($erg != null) 
                    {  
                    $i2 = 0;                 

                     foreach ($erg as $key2 ) { 
                                     

                        echo ' <td> ';  
                         echo ' <div id="Artikel'.$i2.'2" style=" width:420px; height:270px; padding-top: 20px;  margin-bottom: 40px;  ">';                   
                        echo ' <div  style=" padding-left:5px; padding-right:5px; padding-top: 5px; padding-bottom:5px; font-size: 12px; margin-left:30px; margin-right:10px; margin-top: 0px; margin-bottom: 20px;   border-style: solid; width:350px; height: 220px;" >'; 
                        echo ' <b > Kurzbeschreibung: </b> </br>'.  $key2['Kurzbeschreibung'] ;

                         echo '</div>'; 
                        echo '</div></td>';# zähle die größe der Kurzbeschreibung, wenn größer als x dann feld mit weiter

                       $i2++;
                      }    
                    }
              // ende if isset
            // 
                    echo'</tr>';     
             
        echo'  </table>  ';              
           echo'    </div>  ';  
            } #ende Function

             function BuchsuchenV2($erg)
        {
// start
             $s = 'src="'; $e = '"';  $a = 'alt="';$i = 0;    
               
                   echo'   <div class="ueberschrift" style="margin-left: 10px; height: 550px; margin-right: 10px; margin-top: 10px; padding-top:20px;margin-bottom: 10px; border-width: 1px; border-style: solid; border-radius: 4px;">';
                
                 echo ' <table style="margin-left:auto; margin-right: auto; margin-top: 0px;"  ><tr  >  ';

                  // Bildpfade im Ergebnis
                 
                // var_dump($erg); 
                if($erg != null) 
                    {
                 foreach ($erg as $key ) {

                  echo' <td>';

                        echo'<div class="none" id="Artikel'.$i.'" style="  width:25%; height:250px;">';
                        echo '<label class="BuchSuchen" id="'.$i.'" for="Buch_'.$i.'" >';
                        echo' <img style="width:12,5%; height: 200px; float:left; margin-left: 3%px;  margin-top: 20px; "'; echo $s . $key['Titelbild'] . $e ;  echo $a . $key['Bezeichnung'] .$e.'  />';
                             
                        echo'  <table class="table"  style=" margin-top: 20px;  font-size: 12px; border-style: solid; max-width:12,5%; height: 200px; ">';
                        echo'  <tr >';

                                   echo '<td> Titel: </td> <td>'.  $key['Bezeichnung'] .'</td> </tr> <tr>';
                                   echo '<td>Autor: </td> <td> '.  $key['Autor'] .'</td>  </tr> <tr>';
                                   echo '<td>ISBN: </td> <td>'.  $key['ISBN'] .' </td>  </tr> <tr>';
                                   echo '<td>Jahr: </td> <td>'.  $key['Erscheinungsjahr'] .'</td></tr>';                                   
                                
                        echo ' </tr> ';
                        echo ' </table>';                        
                    
                         echo ' <input class="RButtons" style="margin-right: 5,5%;  " type="radio" name="Buch" id="Buch_'.$i.'" value="'.$key['idArtikel'] .'"> ';
                         echo '   </label> '; 
                      $i++;      

                    echo ' </div> ';  
                echo ' </td> '; 

                    }  
                 }  
            echo '</tr><tr>';

                   if($erg != null) 
                    {  
                    $i2 = 0;                 

                     foreach ($erg as $key2 ) { 
                                     

                        echo ' <td> ';  
                         echo ' <div id="Artikel'.$i2.'2" style=" width:25%; height:270px; padding-top: 20px;  margin-bottom: 40px;  ">';                   
                        echo ' <div  style=" padding-left:3%; padding-right:5px; padding-top: 5px; padding-bottom:5px; font-size: 12px; margin-left:30px; margin-right:10px; margin-top: 0px; margin-bottom: 20px;   border-style: solid; width:200%; height: 220px;" >'; 
                        echo ' <b > Kurzbeschreibung: </b> </br>'.  $key2['Kurzbeschreibung'] ;

                         echo '</div>'; 
                        echo '</div></td>';#

                       $i2++;
                      }    
                    }
              // ende if isset
            // 
                    echo'</tr>';     
             
        echo'  </table>  ';              
           echo'    </div>  ';  
            } #ende Function

?>

    </form>
  </body>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Hilfsdokumente/js/bootstrap-filestyle.min.js"></script> 
     <script src="Hilfsdokumente/js/bootstrap.min.js"></script> 
     <script src="Hilfsdokumente/js/jquery.min.js"></script>
     <script src="Hilfsdokumente/js/jquery-filestyle.min.js"></script>
     

     <script type="text/javascript">



       $(document).ready( function() {



        function ISBNHinzufuegen()
        {
            var r = new Array;
            var t = new Array;
            var j = -1;
             $('#submit').html(t.join(''));

             r[++j] = ' ';
      

           $('#submit').html(r.join(''));
        }

     
            

       $('select[name=Kategorie]').on('change', function() 
        {
                var Ausgabe =  document.forms["form1"].elements["Kategorie"].value;

               
                if(Ausgabe == 'Kleidung') 
                {
                  window.location.href = "ArtikelHinzufügen_NurKleidung.php";
                }             
        });


        $('.RButtons').hide();


        $(".BuchSuchen").click(function(){ 
           var Buchid = this.id;
           var RB =  document.forms["form2"].elements["Buch_"+Buchid].checked;
          // console.log(RB); 
           
        });

        $('input[type=radio][name=Buch]').on('change', function() {

        var Buch = $('input[name=Buch]:checked').attr('id');
        var res = Buch.split("_"); 

        var form2laenge =document.form2.elements;  

        console.log(document.forms["form2"].elements["Buch_"+res['1']].value);



        for( var i = 0; i< form2laenge.length; i++)

      {  
        if(i == res[1])
          {$("#Artikel"+i).css('border-style','solid' , 'border-width', '5px', 'border-color', 'blue');
           $("#Artikel"+i+'2').css('border-style','solid' , 'border-width', '5px', 'border-color', 'blue');
         //  $("#Artikel"+i+"2").css('border-style', 'solid','border-width', '5px', 'border-color', '#f5f5f5');
          }
       else
       {
        {$("#Artikel"+i).css('border-style', 'none','border-width', '5px', 'border-color', 'white');
         $("#Artikel"+i+"2").css('border-style', 'none','border-width', '5px', 'border-color', 'white');
       }
       }
      }

        });
       


    

$('#abschicken').click(function(){
  

      console.log("ausgabe alles senden");

               var formData = new FormData();         

         var form1laenge =document.form1.elements; 
         var form2laenge =document.form2.elements; 
        
         console.log(form1laenge[0].value);

          var i;

           formData.append("Kategorie", form1laenge[0].value);
          

          for (i = 0; i < form2laenge; i++) {
              if (form2laenge[i].checked) 
              {                 
                  formData.append("Buch", form2laenge[i].value); 
                  console.log(form2laenge[i].value);
              }
          }
                  
      var xhr = new XMLHttpRequest(); 

       xhr.open("POST", "ArtikelHinzufügen.php");
                          //xhr.setRequestHeader("Content-Type", "image/png");
               xhr.onload = function (oEvent) { 

                if(xhr.status == 200) {
                            console.log("Uploaded!");

                            console.log( xhr.responseText);
                        } 
        }; // schliesse onload
        xhr.send(formData);// ende for
  //do something
});
 



  });
      

     </script>
  </html> 
