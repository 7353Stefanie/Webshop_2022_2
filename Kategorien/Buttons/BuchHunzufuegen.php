<?php
 session_start();



    if(isset($_POST['Buch']))
         {


          $Erg = mySql();

                
         }

function Select($mysqli)
{ 
  $query = sprintf("select Kategorien from Artikel  where idArtikel = %s" ,
                           $mysqli->real_escape_string($_POST['Buch']) 
                          ); 

                  $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

                $row = $result->fetch_array(MYSQLI_ASSOC);                                                                  

                mysqli_free_result( $result ); 
                return $row;
}

 function mySql()
 { 
                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   

                    $Kategorie = Select($mysqli);
                    $ErgebnisidArtikel = switchIt($mysqli, $Kategorie); 

               }   
                 mysqli_close($mysqli);
                return $ErgebnisidArtikel;
 }


  function selectBuecher($mysqli)
 {
                    $query = sprintf("select * from Artikel a, Buecher b  where a.idArtikel = b.idArtikel where a.idArtikel = %s" ,
                           $mysqli->real_escape_string($_POST['Buch']) 
                          ); 


                 $result = $mysqli->query($query);

                  if ( ! $result )
                {
                     die('Ungültige Abfrage: ' . mysqli_error());
                }

                 $rows = Array(); 


                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                   {
                          $rows[] = $row;  
                   }                                                   

                     mysqli_free_result( $result ); 

                        // var_dump($rows); 

                   return $rows;
 }

 function switchIt($mysqli, $Kagtegorie)
 {

  if($Kagtegorie)
  {

 switch ($Kagtegorie) {
   case 'Buecher':
              $Erg = selectBuecher($mysqli);

              return($Erg);
     break;

 case 'Alle':
              $Erg = selectAlle($mysqli);

              return($Erg);
     # code...
     break;

  case 'Kleidung':
     # code...
     break;

    case 'Fahrzeug':
     # code...
     break;
     case 'Spielzeug':
     # code...
     break;
     case 'FreizeitundSport':
     # code...
     break;
     case 'Sonstiges':
     # code...
     break;
     case 'HaushaltundGarten':
     # code...
     break;
   
   default:
     # code...
     break;
 }
}
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

                                           <?PHP
                                                           echo   '<li><a href="ArtikelAuswahl.php">';
                                                           echo   'Artikel hinzufügen </a></li>';
                                                           echo   '<li><a href="StartseitenAnmeldung.php">';
                                                           echo   'Willkommen ';
                                                           echo   $_SESSION['benutzername'];
                                                           echo   '</a></li>';                                                          
                                           ?>

                                         
                                             <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menü<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                              
                                              <li><a href=/Warenkorb.php">Warenkorb</a></li>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a href="#">Impressum</a></li>
                                                  <li><a href="#">AboutUs</a></li> 
                                                  <li><a href="#">Hilfe &amp; Support</a></li>
                                                  <li><a href="#">FAQ</a></li> 
                                                  <li><a href="#">AGB</a></li> 

                                                </ul>
                                              </li> 
                                            <li><a href="Hilfsdokumente/Logout.php" onclick="loescheCoockie()">Logout</a></li> 
                                             
                                        </ul>                             
                          
                         </div><!-- /.container-fluid -->
                      </nav>
            </header> 
  </head> 
  <body>
    <header class="Kasten">
   

      <header >  <div class="ueberschrift" style="margin-left: 15px; margin-right: 15px; margin-top: 10px; padding-left: 10px; margin-bottom: 10px; border-width: 1px; border-style: solid; border-radius: 4px;">
            <h4>Artikel einstellen</h4>
          </div>
      </header>

<div class="container-fluid" style="  margin-left: 15px; border-radius: 3px; margin-top: 3%; margin-right: 15px;">

<div class="row ">
          <form name="form" enctype="multipart/form-data">

                  <div class="col-md-4">
                    <div id="Vorschau"> 
                         <img id="Vorschaubild" class=" media-object" style="padding-top: 20px; padding-right:10px; " src="Hilfsdokumente/Bilder/004_Vorlage_Bilder/Kamera_default_200KB_400x600px.png" alt="Default_Bild">
                    </div>                    

                      <div style="padding-top: 20px; padding-bottom: 10px; ">
                        <input type="file" id="files" name="files[]"  multiple class="jfilestyle" data-input="false" data-buttonText="<span class='glyphicon glyphicon-plus'></span> Bilder hinzufügen" > </input>
                      </div>

                           <div class="galery-container" style="padding-top: 10px;" id="ladeBilder">

                                       <div class=" col-xs-4 col-sm-3 col-md-2 outerContent" >
                                                 <a  href="#" title="...">
                                                      <div class="innerContent" style=" background-image: url('Hilfsdokumente/Bilder/004_Vorlage_Bilder/Kamera_default_200KB_400x600px.png')"></div>
                                                 </a>
                                       </div> <!--outerConten-->
                            </div> <!--galery-container-->
                  </div> <!--col-md-4-->
          </form>
         <div class="col-md-8" style="padding-right: 3%;">                                               
                 <div class="well">   
                      <form id="form1" name="form1" class="form-horizontal" >
                                           <div class="form-group ">
                                                                         <label  for="Kategorie" class="col-sm-1 control-label">Kategorie</label>
                                                                         <div class="col-sm-10 col-md-offset-1">
                                                                            <select class="form-control"  id="Kategorie">
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
                      </form>                  
                             <!--Artikelinformationen-->
                      <div id="EingabeKategorie"> 
                       
                      </div> <!--EingabeKategorie-->

                      


                      <form id="form2" name="form2" class="form-horizontal" >
                    

                      <div id="Kostenmodelle">
                      </div> <!--Kostenmodelle-->

                      <div class="form-group row">
                      <div class=" col-sm-16">
                         <div class="input-group" >  
                           <label  for="Preis" class="col-sm-1  control-label" style="padding-top: 5px; "> Restwert </label>
                          
                                    <div class="col-sm-2 col-md-offset-1">
                                                <div class="input-group" >
                                                                          <div class="input-group-addon">€</div><input class="form-control"  id="Preis" name="Preis">
                                               </div><!-- col.3-->                                    
                                               </div><!-- col.3-->                                

                                <label for="Zustand" class="col-sm-1  control-label" style="padding-top: 5px; " > Zustand </label>
                         <div class=" col-sm-3" style="margin-left: 10px;" > 
                                <div class="input-group" >                   
                              
                                     <select class="form-control"  id="Zustand"  style="border-radius: 4px;">
                                                                                  <option value="Wie neu">Wie Neu</option> 
                                                                                  <option value="mit Gebrauchsspuren">mit Gebrauchsspuren</option> 
                                                                                  <option value="leicht beschädigt">leicht beschädigt</option> 
                                                                                  <option value="schwer beschädigt">schwer beschädigt</option> 
                                     </select>  
                                </div><!-- input-->
                          </div><!-- col-->
                          <div class="col-sm-3 ">
                           <label  for="Menge" class="col-sm-4  control-label" style="padding-top: 5px; "> Menge </label>
                          
                                               <div class=" col-sm-4"  >
                                                <div class="input-group" >
                                                                          <div class="input-group-addon">St.</div><input class="form-control" style="width: 150%;" id="Menge" name="Menge">
                                               </div><!-- col.3-->                                    
                                               </div><!-- col.3-->
                          </div><!-- input-->
                      </div><!-- col.8-->
                      </div><!-- row--> 
                    </div>

                      <div class="form-group row">
                      <div class=" col-sm-8 col-md-offset-1">

                        <div style="margin-top: 25px; margin-bottom: 15px;">
                          
                               Dieser Artikel wird zum  <input type="checkbox"  id="Kaufen" name="Kaufen" value="Kauf" checked>
                                                        <label for="Kaufen">Kauf</label>

                                                        und

                                                        <input type="checkbox" id="Tausch" name="Tauschen" value="Tausch" checked>
                                                        <label for="Tausch">Tausch</label>

                                                        angeboten

                         </div>
                         </div>
                         </div>                                               
                      </form> <!--StandardInformationen-->
                 </div>  <!--well-->
        </div> <!--col-md-8-->  
</div> <!--Row-->
</div> <!-- container--> 
                         

  </header>


<header>
 <form id="form3" name="form3" class="form-horizontal"  >
  <div class="container-fluid">
  
    
          <div class="ueberschrift" style="margin-left: 15px; margin-right: 15px; margin-top: 10px; padding-left: 10px; margin-bottom: 10px; border-width: 1px; border-style: solid; border-radius: 4px;">
            <h4>Artikelbeschreibung:</h4>
          </div>
    <!-- zusätzliche Angaben -->
    <!-- Text box-->
           <div class="form-group" style="margin-left: 15px; margin-right: 15px;">
                <textarea class="form-control" rows="5" id="comment" style="height: 200px;" placeholder="In diesem Feld können Sie zusätzliche, wichtige Angaben zu Ihrem Produkt hinterlegen"></textarea>
          </div>

  </div><!--container-->

  </form>

    <div class="row"> 
      <div  class="col-md-12" style=" padding-right: 10px; margin-top: 10px; padding-left: 10px; margin-bottom: 10px;">
              <button id="abschicken" class="btn btn-primary" style=" float: right;" >Artikeldaten speichern</button> 
     </div>
    </div>
       

  </header>
         
  </body>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Hilfsdokumente/js/bootstrap-filestyle.min.js"></script> 
     <script src="Hilfsdokumente/js/bootstrap.min.js"></script> 
     <script src="Hilfsdokumente/js/jquery.min.js"></script>
          <script src="Hilfsdokumente/js/jquery-filestyle.min.js"></script>
    
  

     <script type="text/javascript">



       $(document).ready( function() {

  //  document.getElementById('hochgeladeneBuecher').style.display = 'none';   

    var p =0;
    var ca ="";
    var r = new Array;
    var j = -1;

    var rr = new Array;
    var jj = -1;

    Bilderladen();

$('#abschicken').click(function(){
  

      console.log("ausgabe alles senden");

               var formData = new FormData(); 

         eraseCookie('Bilder');

         var form1laenge =document.form1.elements; 
         var form2laenge =document.form2.elements; 
         var form3laenge =document.form3.elements; 
          console.log(form2laenge[1].checked);

          var i;

           formData.append("Kategorie", form1laenge[0].value);
          formData.append("Titel", form2laenge[0].value);

          for (i = 1; i < 4; i++) {
              if (form2laenge[i].checked) 
              {                 
                  formData.append("Tauschwert", form2laenge[i].value); 
              }
          }
        
        formData.append("Restwert", form2laenge[4].value); 
        formData.append("Zustand", form2laenge[5].value); 
        formData.append("Menge", form2laenge[6].value); 
       
         formData.append("Beschreibung", form3laenge[0].value); 
        console.log( form3laenge[0].value);  


          for (i = 0; i < formData.length;i++) {
                              
                console.log(formData[i]);
              }
          
      var xhr = new XMLHttpRequest(); 

       xhr.open("POST", "Hilfsdokumente/speicherVerkaeuferpostition.php");
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

function eraseCookie(name) {
    createCookie(name,"",-1);
}

function loescheCoockie(){

  var p = 0;
   while(readCookie("Bilder"+[p]) != null)
             {
                eraseCookie("Bilder"+[p]);
                p++;
             }
}

      function vorschau(Text)
  {
       valueKategorie =document.forms["form1"].elements["Kategorie"].value ;
      if(valueKategorie == 'Buecher')
      {rr[++jj] =  "<img style='width:150px; height:250px; padding-left:20px;' id='Vorschaubild' class='media-object' src="+Text+" alt='Ihr hochgeladenes Bild'>";}
      else
      {
        rr[++jj] =  "<img  id='Vorschaubild' class='media-object' src="+Text+" alt='Ihr hochgeladenes Bild'>";
      }

      $('#Vorschau').html(rr.join(''));

      jj = -1;  
  }

p=0;

   $('.innerContent').on('click', function(){ vorschau(this.id) });

    function Bilderladen()
    {
           while(readCookie("Bilder"+[p]) != null)
             {
                ca =readCookie("Bilder"+[p]);
                console.log(ca+"ca");

                var Text = '"'+ca+ '"';

                console.log(Text+"ca ladeBilder");

               r[++j] = "<div class=' row' style='float:left;'>";
                r[++j] = "<div class=' col-xs-4 col-sm-3 col-md-7 outerContent' >";

                   r[++j] = '<input type="radio" id="Titelbild"  name="Titelbild" value="'+Text+'">';
                  r[++j] = '<label for="Titelbild">Titelbild</label>';
                  r[++j] = "</div> <!--outerConten-->";

               r[++j] = "<div class=' col-xs-4 col-sm-3 col-md-8 outerContent' style='height:100px;'>";
               
             //  console.log( r[j]);
                r[++j] = "<a  href='#' title='...'>";
               // console.log( r[j]);

                r[++j] = "<div class='innerContent' id='"+Text+"' style=' background-image: url("+Text+")'></div>";
              //  console.log( r[j]);
                 r[++j] = "</a>";                
              //   console.log( r[j]);
                 r[++j] = "</div>";
               r[++j] = "</div>";
              //  console.log( r[j]);

                 $('#ladeBilder').html(r.join(''));
                p++;
             }
    }

       var Ausgabe =  document.forms["form1"].elements["Kategorie"].value ;
      
       Auswahl(Ausgabe);
       //Auswahl(Ausgabe);  

       $('select').on('change', function() 
        {
                var Ausgabe =  document.forms["form1"].elements["Kategorie"].value ;
                 Auswahl(Ausgabe);
               //  alert(Ausgabe);
        });

        function ISBNHinzufuegen()
        {
           document.getElementById('Kostenmodelle').style.display = 'block';
         //  document.getElementById('hochgeladeneBuecher').style.display = 'block'; 
            var r = new Array;
            var z = new Array;
            var j = -1; 

              $('#EingabeKategorie').html(z.join(''));

           /*   <?PHP
             
              ?>*/


               r[++j] =' <form>';
                r[++j] ='<div class="form-group row">';
                 r[++j] ='<label for="Buchtitel"  class="col-sm-1  control-label">Buchtitel</label>';
              r[++j] ='  <div class="col-sm-10 col-md-offset-1">';
               r[++j] =' <input class="form-control" id="Buchtitel"  name="Buchtitel"> ';
               

                r[++j] =' </div>';
               r[++j] =' </div>';
                r[++j] ='  <div class="form-group row">';
               r[++j] =' <label for="Autor"  class="col-sm-1  control-label">Autor</label>';
                r[++j] =' <div class="col-sm-10 col-md-offset-1">';
               r[++j] ='  <input class="form-control" id="Autor" name="Autor"> ';  
               r[++j] ='  </div>';
               r[++j] =' </div> ';
                r[++j] =' <div class="form-group row">';
               r[++j] =' <label for="Erscheinungsjahr"  class="col-sm-1  control-label">Erscheinungsjahr</label>';
                r[++j] ='  <div class="col-sm-2 col-md-offset-1">';
               r[++j] =' <input style="width:60%; "  class="form-control" id="Erscheinungsjahr" name="Erscheinungsjahr">';
                r[++j] ='  </div>';
               r[++j] =' <label for="Auflage"  class="col-sm-1  control-label"> Auflage </label>';
               r[++j] ='  <div class="col-sm-1  ">';
               r[++j] =' <input  class="form-control" id="Auflage" name="Auflage">';
                r[++j] ='  </div>';
               r[++j] ='  <label for="Seitenanzahl"  class="col-sm-2  control-label"> Seitenanzahl </label>';
                r[++j] ='  <div class="col-sm-2 ">';
               r[++j] =' <input  class="form-control" id="Seitenanzahl" name="Seitenanzahl">';
                r[++j] ='  </div>  ';                                                                       
               r[++j]='</div>';
                r[++j]='<div class="form-group row">';
                 r[++j]=' <label for="Genre"  class="col-sm-1  control-label"> Genre</label>';

                  r[++j]='  <div class="col-sm-4 col-md-offset-1">';
                   r[++j]='<input  class="form-control" id="Genre" name="Genre">';
                    r[++j]=' </div> ';

                     r[++j]='<label for="Mediumart"  class="col-sm-2  control-label"> Mediumart</label>';

              r[++j]='<div class="col-sm-4 ">';
               r[++j]='<input  class="form-control" id="Mediumart" name="Mediumart">';
                r[++j]='</div> ';
                 r[++j]='</div> ';
                  r[++j]=' </form>  ';

           
                  $('#EingabeKategorie').html(r.join(''));


                    r = new Array;
                   j = -1;
    
                 
                    r[++j] ='<table class="table" style="font-size:90%; width:82.5%; margin-left:17.5%; margin-top:20px; margin-bottom:20px; background-color:white;">';
                    r[++j] ='      <thead>';
                    r[++j] ='        <tr>';
                    r[++j] ='<th>Maße </th>';
                    r[++j] ='<th>Gewicht </th>';
                    r[++j] ='<th>Kosten </th>';
                    r[++j] ='<th></th>';
                    r[++j] ='</tr>';
                    r[++j] ='</thead>';
                            
                    r[++j] ='<tbody>';
                    r[++j] ='<tr>';

                    r[++j] ='<td>';
                     r[++j] ='L: 10 - 35,3 cm<br>';
                    r[++j] ='B: 7 - 30 cm<br>';
                    r[++j] ='H: bis 15 cm<br>';
                    r[++j] ='</td>';

                    r[++j] ='<td>bis 500 g  </td>';
                    r[++j] ='<td>1 €</td>';
                    r[++j] ='<td><input type="radio" name="Versandart" value="1" checked> Buchversand</td>';
                    r[++j] ='</tr>';

                    r[++j] ='<tr>';
                    r[++j] ='<td>';
                    r[++j] ='L: 10 - 35,3 cm<br>';
                     r[++j] ='B: 7 - 30 cm<br>';
                    r[++j] ='H: bis 15 cm<br>';
                    r[++j] ='</td>';
                    r[++j] ='<td>';
                    r[++j] ='bis 1.000 g    ';
                    r[++j] ='</td>';
                    r[++j] ='<td>';
                    r[++j] ='1,65 €';
                    r[++j] ='</td>';
                     r[++j] ='<td>';
                   r[++j] ='<input type="radio" name="Versandart" value="1.65"> Buchversand ';
                    r[++j] ='</td>';
                    r[++j] ='</tr>';
                    r[++j] ='<tr>';
                    r[++j] ='<td>';
                    r[++j] ='L: 15 - 60 cm<br>';
                     r[++j] ='B: 11 - 30 cm<br>';
                    r[++j] ='H: 1 - 15 cm<br>';
                  
                    r[++j] ='</td>';
                   r[++j] ='<td>';
                   r[++j] =' bis 2.000 g      ';
                   r[++j] ='</td>';
                  r[++j] ='<td>';
                    r[++j] ='4,50 €';
                    r[++j] ='</td>';
                    r[++j] ='<td>';
                    r[++j] ='<input type="radio" name="Versandart" value="4.50"> Päckchen';
                   r[++j] ='</td>';
                   r[++j] ='</tr>';
                    r[++j] ='</tbody>';
                        
                  r[++j] ='</table> <!-- row-->';

                

                   $('#Kostenmodelle').html(r.join(''));

      }

      function Spielzeug()
        {
         // document.getElementById('hochgeladeneBuecher').style.display = 'none';
          document.getElementById('Kostenmodelle').style.display = 'none';

           var r = new Array;
            
            var j = -1; 

             r[++j] = '<form class="form-inline">';

                  r[++j] =  '<div class="form-group row" >'; 
                              
                  r[++j] = '<div class="col-sm-1 ">';
                  r[++j] = '<label for="Groesse" class="control-label"> Hersteller</label>';
                   r[++j] = '     </div>  <!--form-group--> ';
                  r[++j] = '      <div class="col-sm-4 col-md-offset-3" style="padding-left:20px;">';
                  r[++j] = '      <input class="form-control" id="Hersteller" name="Hersteller">';
                   r[++j] = '     </div>  <!--col-sm-10-->   ';                                                                                
                   r[++j] = '     </div>  <!--form-group--> ';
                                                                         
            r[++j] ='</form>';

                     $('#EingabeKategorie').html(r.join(''));
          }


      function Kleidung()
      {
        document.getElementById('Kostenmodelle').style.display = 'none';

       // document.getElementById('hochgeladeneBuecher').style.display = 'none';   

          var r = new Array;
          var z = new Array;
            var j = -1; 

             $('#EingabeKategorie').html(z.join(''));
         

            r[++j] = '<form class="form-inline" action="#" method="post" >'; 
             
   
            r[++j] = '  <div class="form-group row">';
             r[++j] = '<div class="col-sm-1 col-md-offset-3">';
            r[++j] = '  <label for="Marke" class="control-label"> Marke </label>';
              r[++j] = '     </div>  <!--form-group--> ';
            r[++j] = '  <div class="col-sm-2">'; 
            r[++j] = '      <input class="form-control"  id="Marke" name="Marke">';
            r[++j] = '     </div>  <!--col-sm-10-->   ';                                                                                
                                
              r[++j] = '<div class="col-sm-1 col-md-offset-3">';
              r[++j] = '<label for="Groesse" class="control-label"> Größe</label>';
               r[++j] = '     </div>  <!--form-group--> ';
              r[++j] = '      <div class="col-sm-2">';
              r[++j] = '      <input class="form-control" style="width:80%" id="Groesse" name="Groesse">';
               r[++j] = '     </div>  <!--col-sm-10-->   ';                                                                                
               r[++j] = '     </div>  <!--form-group--> ';
                                                                  
         
            r[++j] ='</form>';

                   $('#EingabeKategorie').html(r.join(''));

      }

       function Fahrzeug()
      {
        document.getElementById('Kostenmodelle').style.display = 'none';

           //document.getElementById('hochgeladeneBuecher').style.display = 'none';   

           var r = new Array;
      
           var j = -1;                     

            r[++j] = '<form class="form-horizontal" action="#" method="post" >'; 
             
   
            r[++j] = '  <div class="form-group row">';
            r[++j] = '  <label for="Hersteller" class="col-sm-2  control-label" > Hersteller </label>';
           
            r[++j] = '  <div class="col-sm-10">'; 
            r[++j] = '  <input class="form-control"  style="width:50%;" id="Hersteller" name="Hersteller">';
            r[++j] = '  </div>  <!--col-sm-10-->   ';    
            r[++j] = '  </div>  <!--col-sm-10-->   ';                                                                  
                    
            r[++j] = '  <div class="form-group row">';        
            r[++j] = '  <label for="Fahrzeugtyp" class="col-sm-2 control-label">Fahrzeugtyp</label>';
           
            r[++j] = '  <div class="col-sm-10">';
            r[++j] = '  <input class="form-control"  id="Fahrzeugtyp" name="Fahrzeugtyp">';
            r[++j] = '  </div>  <!--col-sm-10-->   ';
            r[++j] = '  </div>  <!--col-sm-10-->   ';                                                                                   
                     
         
            r[++j] ='</form>';


                   $('#EingabeKategorie').html(r.join(''));

      }

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');

  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

  var r = new Array;
  var j = -1;
  var b = 0;
  var ca = "";


 $('#files').on('change', function(evt) 
  {    
    var formData = new FormData();  
    var testeFile = document.getElementById("files").files[0];

     var files = evt.target.files; 

    console.log(testeFile.size);
    if(testeFile.size < 250000)
    {

      for (var i = 0, f; f = files[i]; i++) 
        {
               formData.append("PostImage", document.getElementById("files").files[0]);     
               console.log(formData);    

               var getImage = document.getElementById("files").files[0];
                        var xhr = new XMLHttpRequest(); 

                          xhr.open("POST", "Hilfsdokumente/speicherBild.php");
                          //xhr.setRequestHeader("Content-Type", "image/png");
               xhr.onload = function (oEvent) { 

                if(xhr.status == 200) {
                            console.log("Uploaded!");

                            console.log( xhr.responseText);

                    
                           var bildPfade = xhr.responseText;
                           bildPfade = bildPfade.split('"');

                           while(readCookie("Bilder"+[b]) != null)
                           {
                              ca =readCookie("Bilder"+[b]);
                              console.log(ca+"ca Files");

                              var Text = '"Hilfsdokumente/'+ca+ '"';

                                 r[++j] = "<div class=' row' style='float:left;'>";
                                  r[++j] = "<div class=' col-xs-4 col-sm-3 col-md-7 outerContent' >";

                                     r[++j] = '<input type="radio" id="Titelbild"  name="Titelbild" value="'+Text+'">';
                                    r[++j] = '<label for="Titelbild">Titelbild</label>';
                                    r[++j] = "</div> <!--outerConten-->";

                                 r[++j] = "<div class=' col-xs-4 col-sm-3 col-md-8 outerContent' style='height:100px;'>";
                                 
                               //  console.log( r[j]);
                                  r[++j] = "<a  href='#' title='...'>";
                                 // console.log( r[j]);

                                  r[++j] = "<div class='innerContent' id='"+Text+"' style=' background-image: url("+Text+")'></div>";
                                //  console.log( r[j]);
                                   r[++j] = "</a>";                
                                //   console.log( r[j]);
                                   r[++j] = "</div>";
                                 r[++j] = "</div>";
                            b++;
                           }
                           if(readCookie("Bilder"+[b]) ==  null)

                           { document.cookie = "Bilder"+[b] + "=Hilfsdokumente/" + bildPfade[1]  + "; path=/";}

                              ca =readCookie("Bilder"+[b]);
                              console.log(ca+"ca");

                              var Text = '"'+ca+ '"';

                               r[++j] = "<div class=' row' style='float:left;'>";
                                            r[++j] = "<div class=' col-xs-4 col-sm-3 col-md-7 outerContent' >";

                                               r[++j] = '<input type="radio" id="Titelbild"  name="Titelbild" value="'+Text+'">';
                                              r[++j] = '<label for="Titelbild">Titelbild</label>';
                                              r[++j] = "</div> <!--outerConten-->";

                                           r[++j] = "<div class=' col-xs-4 col-sm-3 col-md-8 outerContent' style='height:100px;'>";
                                           
                                         //  console.log( r[j]);
                                            r[++j] = "<a  href='#' title='...'>";
                                           // console.log( r[j]);

                                            r[++j] = "<div class='innerContent' id='"+Text+"' style=' background-image: url("+Text+")'></div>";
                                          //  console.log( r[j]);
                                             r[++j] = "</a>";                
                                          //   console.log( r[j]);
                                             r[++j] = "</div>";
                                           r[++j] = "</div>";                          
                                                  
                                b++;

                                $('#ladeBilder').html(r.join(''));
                             
                                  vorschau(Text);
                     } //    }//ende if
                           else 
                          {
                            console.log( "Error " + xhr.status + " occurred when trying to upload your file.<br />");
                          }
                        }; // ende onload
               xhr.send(formData);
        }// ende for
    }
    else{
      alert("Bitte landen Sie nur Bilder mit einer Größe von max 250 KB hoch. Danke !");
        }
  });


       function Auswahl(Wert)
       {
         var z = new Array;
          switch(Wert) 
          {
            case 'Buecher':
                  ISBNHinzufuegen();

               break;
            case 'ComputerundElektronik':
              
                break;
            case 'Kleidung':
                  Kleidung();
                break;
            case 'FreizeitundSport':

             
                $('#EingabeKategorie').html(z.join(''));
             
                break;
            case 'Spielzeug':

                $('#EingabeKategorie').html(z.join(''));
                Spielzeug();
              
                break;
             case 'Fahrzeug':

                 $('#EingabeKategorie').html(z.join(''));

                 Fahrzeug();
               
                break;
             case 'HaushaltundGarten':

                 $('#EingabeKategorie').html(z.join(''));
                 Spielzeug();
             
                break;
             case 'Sonstige#s':

                 $('#EingabeKategorie').html(z.join(''));
                 Spielzeug();
              
               break;
            default:    
          }
       }

  });
      

     </script>
  </html> 
