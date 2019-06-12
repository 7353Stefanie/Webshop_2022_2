
<?php


 session_start();

    if(isset($_POST['Buch']))
         {
          $Erg = mySql();
        //  var_dump($Erg);                
         }

function Select($mysqli)
{ 
   echo '<script type="text/javascript">send('.$_POST["idArtikel"].');</script>';
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

              //  var_dump($row);
                return $row;                
}

 function mySql()
 { 
                 $mysqli = @new mysqli('localhost', 'Webshop', 'Dolby?!Audio000', 'webshop04');

                 if ($mysqli->connect_error) {

                   echo 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;

                   } else {   

                    $Kategorie = Select($mysqli);
                     $kat =$Kategorie['Kategorien'];
                     
                    $ErgebnisidArtikel = switchIt($mysqli, $kat); 

                    
                       $_SESSION['Buch'] = $_POST['Buch'];
                   
               }   
                 mysqli_close($mysqli);
                return $ErgebnisidArtikel;
 }


  function selectBuecher($mysqli)
 {
                    $query = sprintf("select * from Artikel a, Buecher b  where a.idArtikel = b.idArtikel and a.idArtikel = %s" ,
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

 function switchIt($mysqli, $Kategorie)
 {

  if($Kategorie)
  {

 switch ($Kategorie) {
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
                                              
                                              <li><a href="Warenkorb.php">Warenkorb</a></li>
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
                                      
                                        <?php if(isset($_POST))
                                        {
                                          if($_POST != null){

                                          
                                          ?>
                                               <div class=' row' style='float:left;'>  
                  
                                               <div class=' col-xs-4 col-sm-3 col-md-7 outerContent' >  

                                                <input type="radio" id="Titelbild"  name="Titelbild"  checked value=<?php  echo  $Erg['0']['Artikelbild'] ;?>  >
                                                 <label for="Titelbild">Titelbild</label>
                                                </div> <!--outerConten-->  

                                                 <div class=' col-xs-4 col-sm-3 col-md-8 outerContent' style='height:100px;'>  
                                  
                                                  <a  href='#' title='...'>  
              
                                                     <div class='innerContent' name=Titelbild id=<?php  echo  $Erg['0']['Artikelbild'];?> style=' background-image: url(<?php echo  $Erg['0']['Artikelbild'];?> )'></div>             
                                                 </a>                 
                
                                                 </div>  
                                                 </div>            
                                        
                                       <?php
                                       
                                         }} ?>

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
                                      
                             <!--Artikelinformationen-->

               

                      <div id="EingabeKategorie"> 
                       
                      </div> <!--EingabeKategorie-->


               <div id="Buecherdaten">
                      

                      <?php if(isset($_POST))
                      {?>
                 
                  <div class="form-group row">
                 <label for="Buchtitel"  class="col-sm-1  control-label">Buchtitel</label>
               <div class="col-sm-10 col-md-offset-1">
               <input class="form-control" id="Buchtitel" <?php if($_POST != null){ echo ' value="' .$Erg['0']['Bezeichnung'] .'"';}?>  name="Buchtitel">              

                </div>
                </div>

                 <div class="form-group row">
                       <label for="Autor"  class="col-sm-1  control-label">Autor</label>
                        <div class="col-sm-5 col-md-offset-1">
                           <input class="form-control" id="Autor" <?php if($_POST != null)  { echo ' value= "' .$Erg['0']['Autor'] .'"';}?>  name="Autor"> 
                       </div>
                           <label for="ISBN"  class="col-sm-1  control-label"> ISBN</label> 

                       <div class="col-sm-4 "> 
                             <input  class="form-control" id="ISBN"   <?php if($_POST != null)  { echo 'value="' .$Erg['0']['ISBN'] .'"';}?>  name="ISBN"> 
                       </div>  
               </div> 
               <div class="form-group row">
                  
                   <label for="Erscheinungsjahr"  class="col-sm-1  control-label">Erscheinungsjahr</label>

                        <div class="col-sm-2 col-md-offset-1">
                              <input style="width:60%; "  class="form-control" id="Erscheinungsjahr"  <?php if($_POST != null)  {  echo 'value="' .$Erg['0']['Erscheinungsjahr'] .'"';}?> name="Erscheinungsjahr">
                         </div>

                              <label for="Auflage"  class="col-sm-1  control-label"> Auflage </label>

                        <div class="col-sm-1  ">
                                <input  class="form-control" id="Auflage" <?php if($_POST != null)  { echo 'value= "' .$Erg['0']['Auflage'] .'"';}?> name="Auflage">
                       </div>

                                <label for="Seitenanzahl"  class="col-sm-2  control-label"> Seitenanzahl </label>
                      <div class="col-sm-2 ">
                               <input  class="form-control" id="Seitenanzahl"  <?php if($_POST != null)  {  echo 'value= "' .$Erg['0']['Seitenanzahl'] .'"';}?>  name="Seitenanzahl">
                     </div> 

               </div> 

                <div class="form-group row"> 
                <label for="Genre"  class="col-sm-1  control-label"> Genre</label> 

                   <div class="col-sm-4 col-md-offset-1"> 
                  <input  class="form-control" id="Genre"   <?php if($_POST != null)  { echo 'value="' .$Erg['0']['Genre'] .'"';}?>  name="Genre"> 
                    </div>  

                       <label for="Mediumart"  class="col-sm-2  control-label"> Mediumart</label> 

                <div class="col-sm-4 "> 
                 <input  class="form-control" id="Mediumart"   <?php if($_POST != null)  { echo 'value="' .$Erg['0']['Mediumart'] .'"';}?>  name="Mediumart"> 
                  </div>                    
                   </div> 

                   <div class="form-group row"> 
                        <label for="Kurzbeschreibung"  class="col-sm-2  control-label"> Inhaltsbeschreibung:</label> 

                          <div class="col-sm-10 col-md-offset-2"> 

                           <textarea name="Kurzbeschreibung" class="form-control" rows="4" id="comment" style="height: 200px;"><?php if($_POST != null)  { echo '"' .$Erg['0']['Kurzbeschreibung'] .'"';}?>
                           </textarea>
                          </div>
                                       
                  </div>
                     
                     <?php }?>

              </div>
</form>
                      <form id="form2" name="form2" class="form-horizontal" >
                    

                      <div id="Kostenmodelle">
                      </div> <!--Kostenmodelle-->

                      <div class="form-group row">
                      <div class=" col-sm-16">
                         <div class="input-group" >  
                           <label  for="Preis" class="col-sm-1  control-label" style="padding-top: 5px; "> Restwert (Verkaufswert ohne Versand) </label>
                          
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
                <textarea class="form-control" rows="5" name="Artikelbeschreibung" id="comment" style="height: 200px;" placeholder="In diesem Feld können Sie zusätzliche, wichtige Angaben zu Ihrem Produkt hinterlegen"></textarea>
          </div>

  </div><!--galery-container    -->
  </form>

    <div class="row"> 
      <div  class="col-md-12" style=" padding-right: 10px; margin-top: 10px; padding-left: 10px; margin-bottom: 10px;">
              <a   id="abschicken" class="btn btn-primary" style=" float: right;" >Artikeldaten speichern</a> 
     </div>
    </div>  
  </header>
         
  </body>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Hilfsdokumente/js/bootstrap-filestyle.min.js"></script> 
     <script src="Hilfsdokumente/js/jquery.min.js"></script>
     <script src="Hilfsdokumente/js/bootstrap.min.js"></script>      
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
      

      loescheCoockie();

      console.log("ausgabe alles senden");

         var formData = new FormData(); 

         var formlaenge  =document.form.elements;
         var form1laenge =document.form1.elements; 
         var form2laenge =document.form2.elements; 
         var form3laenge =document.form3.elements;

       
   var g = 0;         
       i = 0;
       w = 0;
       v=0;


       for (i =0;  i<form1laenge.length; i++) {
          if(form1laenge.length == 42 )
          {
             if( form1laenge[i].value == "" )
              {  
                  g = 1;  
              }

              if(i == 6)
              {
                break;
              }
              console.log('39 erreicht');
          }

          if( form1laenge[i].value == "" )
          {            
            //alert("1");
              g = 1;  
          }
        }

               for (i =0;  i<form2laenge.length; i++) {
          if( form2laenge[i].value == "" )
          {            
           // alert("2");
              g = 1;  
          }
        }

       for (i =0;  i<form3laenge.length; i++) {
          if( form3laenge[i].value == "" )
          {            
           // alert("3");
              g = 1;  
          }
        }  
        

        if(g == 0)
      {
        Auswahl(form1laenge[0].value, 1); 
      }  

else
{
   alert("Bitte füllen Sie alle freien Felder aus. Danke");
   if(v == 1)
   {
    alert("Bitte fügen Sie ein Titelbild ein und markierten es. Danke");
   }
}



});

function KleidungUebertragen()
{

           var formData = new FormData(); 

         var formlaenge  =document.form.elements;
         var form1laenge =document.form1.elements; 
         var form2laenge =document.form2.elements; 
         var form3laenge =document.form3.elements;

        i = 1;

          for (i in formlaenge) {

              if (formlaenge[i].checked) 
              { 
                formData.append("Titelbild", formlaenge[i].value);
                
              }
              else
              {
                formData.append("BilderGes[]", formlaenge[i].value);
              }
            } 

      formData.append("Kategorie", form1laenge[0].value);
      //DAmenmode Herremode
            if (form1laenge[1].checked) 
              { 
                formData.append("Geschlecht", form1laenge[1].value);                
              }
              else
              {
                formData.append("Geschlecht", form1laenge[2].value);
              }
            

            formData.append("Marke", form1laenge[3].value);
            formData.append("Groesse", form1laenge[4].value);
            formData.append("Titel", form1laenge[5].value);

            // marke, groesse, Verkaufstitel
            // 27 Farben (von 6 bis 32)
            
             for ( i = 6; i <33; i++) 
             {
                if (form1laenge[i].checked) 
                { formData.append("Farbe", form1laenge[i].value);
                }
             }

                for (i = 0; i < 4; i++) {
              if (form2laenge[i].checked) 
              {                 
                  formData.append("Tauschwert", form2laenge[i].value); 
              }
          }

              formData.append("Restwert", form2laenge[4].value); 
              formData.append("Zustand", form2laenge[5].value); 
              formData.append("Menge", form2laenge[6].value); 

              if(form2laenge[7].checked) 
              {formData.append("Kaufen", form2laenge[7].value); }
              if(form2laenge[8].checked)
              {formData.append("Tauschen", form2laenge[8].value); }

             
               formData.append("Beschreibung", form3laenge[0].value); 
              console.log( form3laenge[0].value);  

              var xhr = new XMLHttpRequest(); 

             xhr.open("POST", "Hilfsdokumente/speicherVerkaufsdaten.php");
                                //xhr.setRequestHeader("Content-Type", "image/png");
                     xhr.onload = function (oEvent) { 

                      if(xhr.status == 200) {
                                  console.log("Uploaded!");

                                  console.log( xhr.responseText);

                                  //window.location.href = "../MeineVerkaufsartikel.php";
                              } 
              }; // schliesse onload
              xhr.send(formData);// ende for

}

function BuecherUebertragen()
{

           var formData = new FormData(); 

         var formlaenge  =document.form.elements;
         var form1laenge =document.form1.elements; 
         var form2laenge =document.form2.elements; 
         var form3laenge =document.form3.elements;

        i = 1;

          for (i in formlaenge) {

              if (formlaenge[i].checked) 
              { 
                formData.append("Titelbild", formlaenge[i].value);
                
              }
              else
              {
                formData.append("BilderGes[]", formlaenge[i].value);
              }
            }    
           

           formData.append("Kategorie", form1laenge[0].value);
           formData.append("Titel", form1laenge[1].value);
           formData.append("Autor", form1laenge[2].value);
           formData.append("ISBN", form1laenge[3].value);
           formData.append("Erscheinungsjahr", form1laenge[4].value);
           formData.append("Auflage", form1laenge[5].value);
           formData.append("Seitenanzahl", form1laenge[6].value);
           formData.append("Genre", form1laenge[7].value);
           formData.append("Mediumart", form1laenge[8].value);
           formData.append("Kurzbeschreibung", form1laenge[9].value);

          

          for (i = 0; i < 3; i++) {
              if (form2laenge[i].checked) 
              {                 
                  formData.append("Tauschwert", form2laenge[i].value); 
              }
          }
        
        formData.append("Restwert", form2laenge[3].value); 
        formData.append("Zustand", form2laenge[4].value); 
        formData.append("Menge", form2laenge[5].value); 

        if(form2laenge[6].checked) 
        {formData.append("Kaufen", form2laenge[6].value); }
        if(form2laenge[7].checked)
        {formData.append("Tauschen", form2laenge[7].value); }

       
         formData.append("Beschreibung", form3laenge[0].value); 
        console.log( form3laenge[0].value);  


        
          
      var xhr = new XMLHttpRequest(); 

       xhr.open("POST", "Hilfsdokumente/speicherVerkaufsdaten.php");
                          //xhr.setRequestHeader("Content-Type", "image/png");
               xhr.onload = function (oEvent) { 

                if(xhr.status == 200) {
                            console.log("Uploaded!");

                            console.log( xhr.responseText);

                            window.location.href = "../MeineVerkaufsartikel.php";
                        } 
        }; // schliesse onload
        xhr.send(formData);// ende for
 
        
  //do something
}



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
      {rr[++jj] =  "<img style='width:200px; height:250px; padding-left:20px;' id='Vorschaubild' class='media-object' src="+Text+" alt='Ihr hochgeladenes Bild'>";}
      else
      {
        rr[++jj] =  "<img  id='Vorschaubild' class='media-object' src="+Text+" alt='Ihr hochgeladenes Bild'>";
      }

      $('#Vorschau').html(rr.join(''));

      jj = -1;  
  }

p=0;

   $('.innerContent').on('click', function(){ vorschau(this.id) });



   function Titelbild(Text,laenge)   
   {
                r[++j] = "<div class=' row' style='float:left;'>";
                r[++j] = "<div class=' col-xs-4 col-sm-3 col-md-7 outerContent' >";
            if(laenge ==1)
            {
                r[++j] = '<input type="radio" id="Titelbild"  name="Titelbild" value='+Text+' checked>';
            }
            else
            {
               r[++j] = '<input type="radio" id="Titelbild"  name="Titelbild" value='+Text+'>';
            }
                r[++j] = '<label for="Titelbild">Titelbild</label>';
                r[++j] = "</div> <!--outerConten-->";

               r[++j] = "<div class=' col-xs-4 col-sm-3 col-md-8 outerContent' style='height:100px;'>";
               
             //  console.log( r[j]);
                r[++j] = "<a  href='#' title='...'>";
               // console.log( r[j]);
                r[++j] = "<div class='innerContent' id="+Text+" style=' background-image: url("+Text+")'></div>";
              //  console.log( r[j]);
                 r[++j] = "</a>";                
              //   console.log( r[j]);
                 r[++j] = "</div>";
               r[++j] = "</div>";
   
   }

function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
        end = dc.length;
        }
    }
    // because unescape has been deprecated, replaced with decodeURI
    //return unescape(dc.substring(begin + prefix.length, end));
    return decodeURI(dc.substring(begin + prefix.length, end));
} 
var nix =1; 

    function Bilderladen()
    {
      fn = new Array();     

         l = 0;
         p = 0;
         var el = $('.innerContent').attr('id');  
        // console.log(el);
         var boolean =2;

       var b =  String(el);
       b= b.length;
       //console.log(b);

      if(b > 10)
      {
         console.log(el+'el');
         boolean =0;  
      } // ende if        

           while(readCookie("Bilder"+[p]) != null)                    
             {
              fn[p] = readCookie("Bilder"+[p]); 
              if(fn[p] != 'undefined' && fn[p].length > 10)
                {l++;}
              console.log(l);
              p++;
             }

             console.log(fn.length+'laenge');

            for(z = 0; z< fn.length; z++)
            {             
                 
                console.log(fn[z]);
                var Text = '"'+fn[z]+ '"';

                 if(fn[z].length > 10) 
                { Titelbild(Text,l);}
               
                 if(el == fn[z])
                 {                          
                    boolean = 1;
                 }                          
             }

             if(boolean == 0)
              {
                createCookie("Bilder"+[p],el,"");
                l++;
                Titelbild(el,l);
              }

      

             $('#ladeBilder').html(r.join(''));  

          
    }


       var Ausgabe =  document.forms["form1"].elements["Kategorie"].value ;
      
       Auswahl(Ausgabe,0);
       //Auswahl(Ausgabe);  

       $('select').on('change', function() 
        {
                var Ausgabe =  document.forms["form1"].elements["Kategorie"].value ;
                 Auswahl(Ausgabe,0);
               //  alert(Ausgabe);
        });

        function ISBNHinzufuegen()
        {
           document.getElementById('Kostenmodelle').style.display = 'block';
           document.getElementById('Buecherdaten').style.display = 'block';
//none
              
            var r = new Array;
            var z = new Array;
            var j = -1; 
           

              $('#EingabeKategorie').html(z.join(''));

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
          document.getElementById('Buecherdaten').style.display = 'none';

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
        document.getElementById('Kostenmodelle').style.display = 'block';
         document.getElementById('Buecherdaten').style.display = 'none';

       // document.getElementById('hochgeladeneBuecher').style.display = 'none';   

          var r = new Array;
          var z = new Array;
            var j = -1; 

                   $('#EingabeKategorie').html(z.join(''));

                    r = new Array;
                   j = -1;
              
               r[++j] ='<table class="table" style="font-size:90%; width:82.5%; margin-left:17.5%; margin-top:20px; margin-bottom:20px; background-color:white;">';
                    r[++j] ='      <thead>';
                    r[++j] ='        <tr>';
                   
                    r[++j] ='<th>Maße </th>';
                    r[++j] ='<th>Gewicht </th>';
                    r[++j] ='<th>Kosten </th>';
                    r[++j] ='<th>Briefart/Päckchen</th>';
                    r[++j] ='</tr>';
                    r[++j] ='</thead>';
                            
                    r[++j] ='<tbody>';
                    r[++j] ='<tr>';

                   
                    r[++j] ='<td>';
                     r[++j] ='L: 10 - 23,5 cm<br>';
                    r[++j] ='B: 7 - 12,5 cm<br>';
                    r[++j] ='H: 0 bis 1 cm<br>';
                    r[++j] ='</td>';

                    r[++j] ='<td>bis 50 g  </td>';
                    r[++j] ='<td>0,85 €</td>';
                    r[++j] ='<td><input type="radio" name="Versandart" value="0.85" checked> Kompaktbrief</td>';
                    r[++j] ='</tr>';

                    r[++j] ='<tr>';
                   
                    r[++j] ='<td>';
                    r[++j] ='L: 10 - 35,3 cm<br>';
                     r[++j] ='B: 7 - 25 cm<br>';
                    r[++j] ='H: 0 bis 20 cm<br>';
                    r[++j] ='</td>';
                    r[++j] ='<td>';
                    r[++j] ='bis 500 g    ';
                    r[++j] ='</td>';
                    r[++j] ='<td>';
                    r[++j] ='1,45 €';
                    r[++j] ='</td>';
                     r[++j] ='<td>';
                   r[++j] ='<input type="radio" name="Versandart" value="1.45"> Großbrief ';
                    r[++j] ='</td>';
                    r[++j] ='</tr>';

                    r[++j] ='<tr>';                   
                    r[++j] ='<td>';
                    r[++j] ='L: 10 - 35,3 cm<br>';
                     r[++j] ='B: 7 - 25 cm<br>';
                    r[++j] ='H: 0 bis 50 cm<br>';
                    r[++j] ='</td>';
                    r[++j] ='<td>';
                    r[++j] ='bis 1000 g    ';
                    r[++j] ='</td>';
                    r[++j] ='<td>';
                    r[++j] ='2,60 €';
                    r[++j] ='</td>';
                     r[++j] ='<td>';
                   r[++j] ='<input type="radio" name="Versandart" value="2.60"> Maxibrief ';
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
                    r = new Array;
                   j = -1;

             $('#EingabeKategorie').html(z.join(''));
         

           r[++j] ='<div class="form-group row" style=" margin-top: 20px; margin-bottom: 20px;">';
                 r[++j] ='<label style="margin-top: -5px;" for="Damenmode"  class="col-sm-1 col-md-offset-2  control-label">Damenmode </label>';
               r[++j] ='<div class="col-sm-1 col-md-offset-1">';
                r[++j] ='<input   type="radio" id="Damenmode" name="mode" value="Damenmode" checked >';
               r[++j] ='</div>';
                

               
                 r[++j] ='<label style="margin-top: -5px;" for="Herrenmode"  class="col-sm-1 col-md-offset-2  control-label">  Herrenmode </label>';
               r[++j] ='<div class="col-sm-1 col-md-offset-1">';
                r[++j] ='<input   type="radio" id="Herrenmode" name="mode" value="Herrenmode" >';
               r[++j] ='</div>';
               r[++j] ='</div>';  

                r[++j] ='<div class="form-group row">';
                            r[++j] ='<label for="Autor"  class="col-sm-1  control-label">Marke</label>';
                     r[++j] ='<div class="col-sm-5 col-md-offset-1">';
                           r[++j] ='<input class="form-control" id="Autor"  name="Autor">'; 
                     r[++j] ='</div>';


                           r[++j] ='<label for="Größe"  class="col-sm-1  control-label"> Größe</label>'; 
                     r[++j] ='<div class="col-sm-4 ">'; 
                            r[++j] ='<select class="form-control"  id="Größe">';
                                                                                  r[++j] ='<option value=" 4 / 32 / XXS"> 4 / 32 / XXS </option>'; 
                                                                                  r[++j] ='<option value=" 6 / 34 / XS"> 6 / 34 / XS </option>'; 
                                                                                  r[++j] ='<option value=" 8 / 36 / S"> 8 / 36 / S </option>'; 
                                                                                  r[++j] ='<option value=" 10 / 38 / S/M"> 10 / 38 / S/M </option>'; 
                                                                                  r[++j] ='<option value=" 12 / 40 / M"> 12 / 40 / M </option>'; 
                                                                                  r[++j] ='<option value=" 14 / 42 / L"> 14 / 42 / L</option>'; 
                                                                                  r[++j] ='<option value=" 16 / 44 / XL"> 16 / 44 / XL </option>'; 
                                                                                  r[++j] ='<option value=" 18 / 46 / XXL"> 18 / 46 / XXL </option>'; 
                                                                                  r[++j] ='<option value=" 20 / 48 / 3XL"> 20 / 48 / 3XL</option>'; 
                                                                                  r[++j] ='<option value=" 22 / 50 / 4XL"> 22 / 50 / 4XL</option>'; 
                                                                                  r[++j] ='<option value=" 24 / 52 / 5XL"> 24 / 52 / 5XL </option>'; 
                                                                                  r[++j] ='<option value=" 26 / 54 / 6XL"> 26 / 54 / 6XL </option>'; 
                                                                                  r[++j] ='<option value=" Uni"> Uni </option>'; 
                                                                                  r[++j] ='<option value="Sonstiges">Sonstiges</option>'; 
                            r[++j] ='</select>';                            
                     r[++j] ='</div>';  
               r[++j] ='</div>';  

               r[++j] ='<div class="form-group row">';
                 r[++j] ='<label  for="Tauschtitel"  class="col-sm-1 control-label">Verkaufs-/</br>Tauschtitel:</label>';
               r[++j] ='<div class="col-sm-10 col-md-offset-1">';
               r[++j] ='<input class="form-control" id="Tauschtitel" style="margin-top: 5;"  name="Tauschtitel">';             

                r[++j] ='</div>';
                r[++j] ='</div>';

                 r[++j] ='<div class="form-group row">';
                             r[++j] ='<label   class="col-sm-1 control-label">Farbe</label>';
                     r[++j] ='<div class="col-sm-4 col-md-offset-1  ">'; 

                      r[++j] ='<table>';
                      r[++j] ='<tr>';
                        r[++j] ='<td >';
                           r[++j] ='<label style="margin-top: -5px;" id="Schwarz1" for="Schwarz" >';
                          r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Schwarz" value="Schwarz" checked ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="font-size: 25px;" ></span></br></div> <b style="margin-left: 10px; font-size: 12px;" >Schwarz</b></label>';
                          
                        r[++j] ='</td>';
                          r[++j] ='<td >';
                            r[++j] ='<label style="margin-top: -5px;" id="Weiß1" for="Weiß" >';
                          r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Weiß" value="Weiß"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:white; background-color:grey;  font-size: 25px;" ></span></br></div><b style=" margin-left: 20px;font-size: 12px;" >weiß</b></label>';
                          
                        r[++j] ='</td>';

                        r[++j] ='<td><label style="margin-top: -5px;" id="Grau1" for="Grau" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Grau" value="Grau"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:grey; font-size: 25px;"> </span></br></div><b style=" margin-left: 20px;font-size: 12px;" >Grau</b></label>';
                        
                        r[++j] ='</td>';

                        r[++j] ='<td><label style="margin-top: -5px;" id="Creme1" for="Creme" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Creme" value="Creme"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#ffefd5; font-size: 25px;"> </span></br></div><b style=" margin-left: 15px;font-size: 12px;" >Creme</b></label>';
                        
                        r[++j] ='</td>';

                         r[++j] ='<td><label style="margin-top: -5px;" id="Nude1" for="Nude" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Nude" value="Nude"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#ffe7d6; font-size: 25px;"> </span></br></div><b style=" margin-left: 20px;font-size: 12px;" >Nude</b></label>';
                      
                        r[++j] ='</td>';

                         r[++j] ='<td><label style="margin-top: -5px;" id="Apricose1" for="Apricose" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben"  id="Apricose" value="Apricose"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#ffcc99; font-size: 25px;"> </span></br></div><b style=" margin-left: 10px;font-size: 12px;" >Apricose</b></label>';
                        
                        r[++j] ='</td>';

                         r[++j] ='<td><label style="margin-top: -5px;" id="Orange1" for="Orange" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Orange"  value="Orange"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#FF8000; font-size: 25px;"> </span></br></div><b style=" margin-left: 15px;font-size: 12px;" >Orange</b></label>';
                      
                        r[++j] ='</td>';

                           r[++j] ='<td><label style="margin-top: -5px;" id="Rot1" for="Rot" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Rot" value="Rot"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#FE2E2E; font-size: 25px;"> </span></br></div><b style=" margin-left: 25px;font-size: 12px;" >Rot</b></label>';
                        
                        r[++j] ='</td>';

                           r[++j] ='<td><label style="margin-top: -5px;" id="Dunkelrot1" for="Dunkelrot" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Dunkelrot" value="Dunkelrot"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#B40404; font-size: 25px; float:left;"> </span></br></div><b style=" margin-left: 10px;font-size: 12px;" >Dunkelrot</b></label>';
                        
                        
                        r[++j] ='</td>';

                           r[++j] ='<td><label style="margin-top: -5px;" id="Pink1" for="Pink" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Pink" value="Pink"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#FF00BF; font-size: 25px;"> </span></br></div><b style=" margin-left: 20px;font-size: 12px;" >Pink</b></label>';
                                             
                        r[++j] ='</td>';

                         

                      r[++j] ='</tr>';
                        r[++j] ='<tr>';
                        r[++j] ='<td><label style="margin-top: -5px;" id="Rose1" for="Rose" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Rose" value="Rose"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#F5A9BC; font-size: 25px;"> </span></br></div><b style=" margin-left: 20px;font-size: 12px;" >Rose</b></label>';
                        
                        r[++j] ='</td>';

                                   r[++j] ='<td><label style="margin-top: -5px;" id="Lila1" for="Lila" >';
                          r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Lila" value="Lila" checked ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#BF00FF; font-size: 25px;" ></span></br></div><b style=" margin-left: 25px;font-size: 12px;" >Lila</b></label>';
                          
                        r[++j] ='</td>';

                        r[++j] ='<td><label style="margin-top: -5px;" id="Flieder1" for="Flieder" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Flieder"  value="Flieder"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#DA81F5; font-size: 25px;"> </span></br></div><b style=" margin-left: 15px;font-size: 12px;" >Flieder</b></label>';
                        
                        r[++j] ='</td>';

                        r[++j] ='<td><label style="margin-top: -5px;" id="Hellblau1" for="Hellblau" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Hellblau" value="Hellblau"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#58D3F7; font-size: 25px;"> </span></br></div><b style=" margin-left: 10px;font-size: 12px;" >Hellblau</b></label>';
                        
                        r[++j] ='</td>';

                         r[++j] ='<td><label style="margin-top: -5px;" id="Blau1" for="Blau" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Blau" value="Blau"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#2E2EFE; font-size: 25px;"> </span></br></div><b style=" margin-left: 22px;font-size: 12px;" >Blau</b></label>';
                      
                        r[++j] ='</td>';

                         r[++j] ='<td><label style="margin-top: -5px;" id="Dunkelblau1" for="Dunkelblau" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Dunkelblau" value="Dunkelblau"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#08088A; font-size: 25px;"> </span></br></div><b style=" margin-left: 3px;font-size: 12px;" >Dunkelblau</b></label>';
                       
                        r[++j] ='</td>';

                         r[++j] ='<td><label style="margin-top: -5px;" id="Türkis1" for="Türkis" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Türkis" value="Türkis"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#0489B1; font-size: 25px;"> </span></br></div><b style=" margin-left: 20px;font-size: 12px;" >Türkis</b></label>';
                       
                        r[++j] ='</td>';

                           r[++j] ='<td><label style="margin-top: -5px;" id="Mintgrün1" for="Mintgrün" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Mintgrün" value="Mintgrün"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#2EFEC8; font-size: 25px;"> </span></br></div><b style=" margin-left: 10px;font-size: 12px;" >Mintgrün</b></label>';
                       
                        
                        r[++j] ='</td>';

                           r[++j] ='<td><label style="margin-top: -5px;" id="Grün1" for="Grün" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Grün" value="Grün"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#04B404; font-size: 25px; float:left;"> </span></br></div><b style=" margin-left: 20px;font-size: 12px;" >Grün</b></label>';
                       
                        
                        r[++j] ='</td>';

                           r[++j] ='<td><label style="margin-top: -5px;" id="Dunkelgrün1" for="Dunkelgrün" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Dunkelgrün" value="Dunkelgrün"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#0B610B; font-size: 25px;"> </span></br></div><b style=" margin-left: 5px;font-size: 12px;" >Dunkelgrün</b></label>';
                                            
                        r[++j] ='</td>';


                         r[++j] ='</tr>';
                         r[++j] ='<tr>';

                        r[++j] ='<td><label style="margin-top: -5px;" id="Khaki1" for="Khaki" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Khaki" value="Khaki"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#688A08; font-size: 25px;"> </span></br></div><b style=" margin-left: 20px;font-size: 12px;" >Khaki</b></label>';
                       
                        r[++j] ='</td>';

                         r[++j] ='<td><label style="margin-top: -5px;" id="Braun1" for="Braun" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben"  id="Braun" value="Braun"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#8A4B08; font-size: 25px;"> </span></br></div><b style=" margin-left: 20px;font-size: 12px;" >Braun</b></label>';
                      
                        r[++j] ='</td>';

                         r[++j] ='<td><label style="margin-top: -5px;" id="Senffarben1" for="Senffarben" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Senffarben" value="Senffarben"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#DBA901; font-size: 25px;"> </span></br></div><b style=" margin-left: 5px;font-size: 12px;" >Senffarben</b></label>';
                       
                        r[++j] ='</td>';

                           r[++j] ='<td><label style="margin-top: -5px;" id="Gelb1" for="Gelb" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben"  id="Gelb" value="Gelb"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#FFFF00; font-size: 25px;"> </span></br></div><b style=" margin-left: 22px;font-size: 12px;" >Gelb</b></label>';
                       

                                               r[++j] ='<td><label style="margin-top: -5px;" id="Silber1" for="Silber" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben"  id="Silber" value="Silber"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#A4A4A4; font-size: 25px;"> </span></br></div><b style=" margin-left: 20px;font-size: 12px;" >Silber</b></label>';
                       
                        r[++j] ='</td>';

                         r[++j] ='<td><label style="margin-top: -5px;" id="Gold1" for="Gold" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Gold" value="Gold"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#DBA901; font-size: 25px;"> </span></br></div><b style=" margin-left: 22px;font-size: 12px;" >Gold</b></label>';
                        
                        r[++j] ='</td>';

                           r[++j] ='<td><label style="margin-top: -5px;" id="Bunt1" for="Bunt" >';
                        r[++j] ='<div class="Farbkasten">';
                          r[++j] ='<input   type="radio"  name="Farben" id="Bunt" value="Bunt"  ></br> </span></br></div><b style=" margin-left: 10px;font-size: 12px;" >bunt</b></label>';                        
                        
                        r[++j] ='</td>';                 
                      r[++j] ='</tr>';
                    r[++j] ='</table>';

                     r[++j] ='</div>'; 
                r[++j] ='</div>';



                   $('#EingabeKategorie').html(r.join(''));
                     var idFirst;

                   $("input[name='Farben']").hide();
                    $("input[name='Farben']").on('click', function(){ 
           
    
           var Buchid = this.id;
           //var RB =  document.forms["form1"].elements[""+Buchid].checked;
           //var RB2 =  document.forms["form1"].elements[""+Buchid].value;
          

           $('#'+idFirst+'1').css('border-style','' , 'border-width', '', 'border-color', 'white');

           $('#'+this.id+'1').css('border-style','solid' , 'border-width', '5px', 'border-color', 'blue');

           //document.getElementById(""+this.id).style.border = "thick solid #0000FF";
             var Farben = $('input[for='+this.id+']').css('border-style','solid' , 'border-width', '5px', 'border-color', 'blue');
            // console.log(Farben);

            idFirst = this.id;
           
        });


      }

       function Fahrzeug()
      {
        document.getElementById('Kostenmodelle').style.display = 'none';
         document.getElementById('Buecherdaten').style.display = 'none';

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
                           console.log(bildPfade + " Bildpfade");

                           bildPfade = bildPfade.split('"');

                           var boolean =0; 
                           var l = 0;

                           
                          while(readCookie("Bilder"+[b]) != null)
                           {
                              ca =readCookie("Bilder"+[b]);
                              console.log(ca+" ca Files");

                              var Text = '"'+ca+ '"';
                             
                               if(ca.length > 10) 
                                { Titelbild(Text,0);}

                              if("Bilder"+[b] != 'undefined')
                              {l++;}
                                                             

                            b++;
                           }

                           $('#ladeBilder').html(r.join(''));


                           if(readCookie("Bilder"+[b]) ==  null)

                           { document.cookie = "Bilder"+[b] + "=Hilfsdokumente/" + bildPfade[1]  + "; path=/";}

                              ca =readCookie("Bilder"+[b]);
                              console.log(ca+"ca");

                              var Text = '"'+ca+ '"';

                              Titelbild(Text,l++);                                                  
                                                  
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
      alert("Bitte laden Sie nur Bilder mit einer Größe von max 250 KB hoch. Danke !");
        }
  });


       function Auswahl(Wert, Zahl)
       {
         var z = new Array;
          switch(Wert) 
          {
            case 'Buecher':
                  if(Zahl == 0)
                  {ISBNHinzufuegen();}
                  else
                  {
                    BuecherUebertragen();
                  }

               break;
            case 'ComputerundElektronik':
              
                break;
            case 'Kleidung':
                  if(Zahl == 0)
                  {Kleidung();}
                  else
                  {
                      KleidungUebertragen();
                  }
                  
                break;
            case 'FreizeitundSport':
             Spielzeug();

             
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
             case 'Sonstiges':

                 $('#EingabeKategorie').html(z.join(''));
                 Spielzeug();
              
               break;
            default:    
          }
       }

  });






      

     </script>
  </html> 
