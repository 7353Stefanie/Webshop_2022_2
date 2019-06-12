
<?php


 session_start();

    if(isset($_POST['Buch']))
         {
          $Erg = mySql();
        //  var_dump($Erg);                
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
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <link rel="stylesheet" href="Hilfsdokumente/css/willkommenStyle.css"> 
             <link rel="stylesheet" href="Hilfsdokumente/css/Bilder2.css">
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
     
        <div class="ueberschrift" style="margin-left: 15px; margin-right: 15px; margin-top: 10px; padding-left: 10px; margin-bottom: 10px; border-width: 1px; border-style: solid; border-radius: 4px;">
            <h4>Artikel einstellen</h4>
          </div>
    </header>

<div class="container-fluid" style="display: flex;  flex-flow: row wrap;  margin-left: 15px; border-radius: 3px; margin-top: 3%; margin-right: 15px;">

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
              
                                                     <div class='innerContent' name="Titelbild" id=<?php  echo  $Erg['0']['Artikelbild'];?> style=' background-image: url(<?php echo  $Erg['0']['Artikelbild'];?> )'></div>             
                                                 </a>                 
                
                                                 </div>  
                                                 </div>   
                                       <?php
                                       
                                         }} ?>
                            </div>
                           <!-- </div> galery-container-->
                  </div> <!--col-md-4-->
          </form>
         <div class="col-md-8" style="float:right;">                                               
                 <div class="well">   
                      <form id="form1" name="form1" class="form-horizontal" >
                                           <div class="form-group ">
                                                                         <label  for="Kategorie" class="col-sm-1 control-label">Kategorie</label>
                                                                         <div class="col-sm-10 col-md-offset-1">
                                                                            <select class="form-control"  id="Kategorie">
                                                                                  <option value="Buecher">Bücher</option> 
                                                                                  <option selected value="Kleidung">Kleidung</option> 
                                                                                  <option value="FreizeitundSport">Freizeit und Sport</option> 
                                                                                  <option value="Spielzeug">Spielzeug</option> 
                                                                                  <option value="Fahrzeug">Fahrzeug</option> 
                                                                                  <option value="HaushaltundGarten">Haushalt und Garten</option> 
                                                                                  <option value="Sonstiges">Sonstiges</option> 
                                                                           </select>
                                                                        </div>
                                           </div>  <!--form-group-->
                             

                      <div id="EingabeKategorie"> 


            <div class="form-group row" style=" margin-top: 20px; margin-bottom: 20px;"> 
                  <label style="margin-top: -5px;" for="Damenmode"  class="col-sm-1 col-md-offset-2  control-label">Damenmode </label> 
                <div class="col-sm-1 col-md-offset-1">
                 <input   type="radio" id="Damenmode" name="mode" value="Damenmode" checked > 
                </div>
                

               
                  <label style="margin-top: -5px;" for="Herrenmode"  class="col-sm-1 col-md-offset-2  control-label">  Herrenmode </label> 
                <div class="col-sm-1 col-md-offset-1"> 
                 <input   type="radio" id="Herrenmode" name="mode" value="Herrenmode" > 
                </div> 
                </div>   

                 <div class="form-group row"> 
                             <label for="Autor"  class="col-sm-1  control-label">Marke</label> 
                      <div class="col-sm-5 col-md-offset-1"> 
                            <input class="form-control" id="Autor"  name="Autor">  
                      </div> 


                            <label for="Größe"  class="col-sm-1  control-label"> Größe</label>  
                      <div class="col-sm-4 ">  
                             <select class="form-control"  id="Größe"> 
                                                                                   <option value=" 4 / 32 / XXS"> 4 / 32 / XXS </option>  
                                                                                   <option value=" 6 / 34 / XS"> 6 / 34 / XS </option>  
                                                                                   <option value=" 8 / 36 / S"> 8 / 36 / S </option>  
                                                                                   <option value=" 10 / 38 / S/M"> 10 / 38 / S/M </option>  
                                                                                   <option value=" 12 / 40 / M"> 12 / 40 / M </option>  
                                                                                   <option value=" 14 / 42 / L"> 14 / 42 / L</option>  
                                                                                   <option value=" 16 / 44 / XL"> 16 / 44 / XL </option>  
                                                                                   <option value=" 18 / 46 / XXL"> 18 / 46 / XXL </option>  
                                                                                   <option value=" 20 / 48 / 3XL"> 20 / 48 / 3XL</option>  
                                                                                   <option value=" 22 / 50 / 4XL"> 22 / 50 / 4XL</option>  
                                                                                   <option value=" 24 / 52 / 5XL"> 24 / 52 / 5XL </option>  
                                                                                   <option value=" 26 / 54 / 6XL"> 26 / 54 / 6XL </option>  
                                                                                   <option value=" Uni"> Uni </option>  
                                                                                   <option value="Sonstiges">Sonstiges</option>  
                             </select>                             
                      </div>
                    </div> 

                    <div class="form-group row" id="andereGroesse">                       
                         <label for="Größe2" class="col-sm-8 col-md-offset-1 control-label"> andere Größe : </label>   
                         <div class="col-sm-3"> 
                            <input class="form-control" id="Größe2"  name="Groesse2">  
                          </div>                      
                    </div>
                   

                <div class="form-group row"> 
                  <label  for="Tauschtitel"  class="col-sm-1 control-label">Verkaufs-/</br>Tauschtitel:</label> 
                <div class="col-sm-10 col-md-offset-1"> 
                <input class="form-control" id="Tauschtitel" style="margin-top: 5;"  name="Tauschtitel">              

                 </div> 
                 </div> 

                  <div class="form-group row"> 
                              <label   class="col-sm-2 control-label" style="text-align: left;">Farbe
                               <button type="button" class="btn btn-default" id='reverse'><span class="glypho icon-go-back-arrow" style="font-size: 20px; " > </span></button></label> 

                      <div class="form-group row"> 

                          <div class="col-sm-8 col-md-offset-0" > 
                            <div class="FarbenAuswahl">
                            <label style="float: left;"  name="Farbauswahl" id="Farbauswahl">Farbenauswahl</label>
                            </div>

                           
                          </div>

                       </div>

                          <div class="col-sm-10 col-md-offset-2  "> 

                          <label style="margin-top: -5px;" id="Schwarz1" for="Schwarz" > 
                           <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Schwarz" value="Schwarz" checked ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="font-size: 25px;" ></span></br></div> <b  >Schwarz</b></label> 

                             <label style="margin-top: -5px;" id="Weiß1" for="Weiß" > 
                           <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Weiß" value="Weiß"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:white; background-color:grey;  font-size: 25px;" ></span></br></div><b  >weiß</b></label> 
                          
                          <label style="margin-top: -5px;" id="Grau1" for="Grau" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Grau" value="Grau"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:grey; font-size: 25px;"> </span></br></div><b  >Grau</b></label> 

                           <label style="margin-top: -5px;" id="Creme1" for="Creme" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Creme" value="Creme"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#ffefd5; font-size: 25px;"> </span></br></div><b>Creme</b></label> 
                        
                          <label style="margin-top: -5px;" id="Nude1" for="Nude" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Nude" value="Nude"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#ffe7d6; font-size: 25px;"> </span></br></div><b>Nude</b></label> 
                      
                         
                         <label style="margin-top: -5px;" id="Apricose1" for="Apricose" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben"  id="Apricose" value="Apricose"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#ffcc99; font-size: 25px;"> </span></br></div><b>Apricose</b></label> 
                        
                          <label style="margin-top: -5px;" id="Orange1" for="Orange" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Orange"  value="Orange"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#FF8000; font-size: 25px;"> </span></br></div><b  >Orange</b></label> 
                      
                       <label style="margin-top: -5px;" id="Rot1" for="Rot" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Rot" value="Rot"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#FE2E2E; font-size: 25px;"> </span></br></div><b  >Rot</b></label> 
                        
                        
                      <label style="margin-top: -5px;" id="Dunkelrot1" for="Dunkelrot" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Dunkelrot" value="Dunkelrot"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#B40404; font-size: 25px; "> </span></br></div><b  >Dunkelrot</b></label> 
                        
                        
                       <label style="margin-top: -5px;" id="Pink1" for="Pink" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Pink" value="Pink"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#FF00BF; font-size: 25px;"> </span></br></div><b >Pink</b></label> 
                                             
                      <label style="margin-top: -5px;" id="Rose1" for="Rose" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Rose" value="Rose"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#F5A9BC; font-size: 25px;"> </span></br></div><b  >Rose</b></label> 
                   
                   <label style="margin-top: -5px;" id="Lila1" for="Lila" > 
                           <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Lila" value="Lila" checked ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#BF00FF; font-size: 25px;" ></span></br></div><b >Lila</b></label> 
                          
                        <label style="margin-top: -5px;" id="Flieder1" for="Flieder" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Flieder"  value="Flieder"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#DA81F5; font-size: 25px;"> </span></br></div><b  >Flieder</b></label> 
                        
                        <label style="margin-top: -5px;" id="Hellblau1" for="Hellblau" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Hellblau" value="Hellblau"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#58D3F7; font-size: 25px;"> </span></br></div><b  >Hellblau</b></label> 
                        
                      <label style="margin-top: -5px;" id="Blau1" for="Blau" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Blau" value="Blau"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#2E2EFE; font-size: 25px;"> </span></br></div><b  >Blau</b></label> 
                      
                        <label style="margin-top: -5px;" id="Dunkelblau1" for="Dunkelblau" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Dunkelblau" value="Dunkelblau"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#08088A; font-size: 25px;"> </span></br></div><b  >Dunkelblau</b></label> 
                       
                         <label style="margin-top: -5px;" id="Türkis1" for="Türkis" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Türkis" value="Türkis"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#0489B1; font-size: 25px;"> </span></br></div><b  >Türkis</b></label> 
                       
                     <label style="margin-top: -5px;" id="Mintgrün1" for="Mintgrün" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Mintgrün" value="Mintgrün"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#2EFEC8; font-size: 25px;"> </span></br></div><b >Mintgrün</b></label> 
                       
                        <label style="margin-top: -5px;" id="Grün1" for="Grün" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Grün" value="Grün"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#04B404; font-size: 25px; "> </span></br></div><b >Grün</b></label> 
                       
                        
                      <label style="margin-top: -5px;" id="Dunkelgrün1" for="Dunkelgrün" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Dunkelgrün" value="Dunkelgrün"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#0B610B; font-size: 25px;"> </span></br></div><b >Dunkelgrün</b></label> 
                                            
                        <label style="margin-top: -5px;" id="Khaki1" for="Khaki" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Khaki" value="Khaki"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#688A08; font-size: 25px;"> </span></br></div><b  >Khaki</b></label> 
                       
                       <label style="margin-top: -5px;" id="Braun1" for="Braun" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben"  id="Braun" value="Braun"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#8A4B08; font-size: 25px;"> </span></br></div><b  >Braun</b></label> 
                      
                        <label style="margin-top: -5px;" id="Senffarben1" for="Senffarben" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Senffarben" value="Senffarben"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#DBA901; font-size: 25px;"> </span></br></div><b >Senffarben</b></label> 
                       
                       <label style="margin-top: -5px;" id="Gelb1" for="Gelb" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben"  id="Gelb" value="Gelb"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#FFFF00; font-size: 25px;"> </span></br></div><b >Gelb</b></label>                       

                                                
                           <label style="margin-top: -5px;" id="Silber1" for="Silber" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben"  id="Silber" value="Silber"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#A4A4A4; font-size: 25px;"> </span></br></div><b >Silber</b></label> 
                       
                        <label style="margin-top: -5px;" id="Gold1" for="Gold" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Gold" value="Gold"  ></br><span class="glyphicon glyphicon-tint" aria-hidden="true" style="color:#DBA901; font-size: 25px;"> </span></br></div><b >Gold</b></label> 
                        
                      <label style="margin-top: -5px;" id="Bunt1" for="Bunt" > 
                         <div class="Farbkasten"> 
                           <input   type="radio"  name="Farben" id="Bunt" value="Bunt"  ></br> </span></br></div><b  >bunt</b></label>                         
                        

                      </div>  
                 </div>                        
          </div> <!--EingabeKategorie-->
              
</form>
                      <form id="form2" name="form2" class="form-horizontal" >
                    

                      <div id="Kostenmodelle">

                         <table class="table" style="font-size:90%; width:82.5%; margin-left:17.5%; margin-top:20px; margin-bottom:20px; background-color:white;"> 
                           <thead> 
                             <tr> 
                   
                     <th>Maße </th> 
                     <th>Gewicht </th> 
                     <th>Kosten </th> 
                     <th>Briefart/Päckchen</th> 
                     </tr> 
                     </thead> 
                            
                     <tbody> 
                     <tr> 

                   
                     <td> 
                      L: 10 - 23,5 cm<br> 
                     B: 7 - 12,5 cm<br> 
                     H: 0 bis 1 cm<br> 
                     </td> 

                     <td>bis 50 g  </td> 
                     <td>0,85 €</td> 
                     <td><input type="radio" name="Versandart" value="0.85" checked> Kompaktbrief</td> 
                     </tr> 

                     <tr> 
                   
                     <td> 
                     L: 10 - 35,3 cm<br> 
                      B: 7 - 25 cm<br> 
                     H: 0 bis 20 cm<br> 
                     </td> 
                     <td> 
                     bis 500 g     
                     </td> 
                     <td> 
                     1,45 € 
                     </td> 
                      <td> 
                    <input type="radio" name="Versandart" value="1.45"> Großbrief  
                     </td> 
                     </tr> 

                     <tr>                    
                     <td> 
                     L: 10 - 35,3 cm<br> 
                      B: 7 - 25 cm<br> 
                     H: 0 bis 50 cm<br> 
                     </td> 
                     <td> 
                     bis 1000 g     
                     </td> 
                     <td> 
                     2,60 € 
                     </td> 
                      <td> 
                    <input type="radio" name="Versandart" value="2.60"> Maxibrief  
                     </td> 
                     </tr> 


                     <tr> 
                     <td> 
                     L: 15 - 60 cm<br> 
                      B: 11 - 30 cm<br> 
                     H: 1 - 15 cm<br>                   
                     </td> 
                    <td> 
                     bis 2.000 g       
                    </td> 
                   <td> 
                     4,50 € 
                     </td> 
                     <td> 
                     <input type="radio" name="Versandart" value="4.50"> Päckchen 
                    </td> 
                    </tr> 
                     </tbody> 
                        
                   </table> <!-- row--> 


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
              <a   id="abschicken" class="btn btn-primary" style=" float: right;" >Artikeldaten speichern und Veröffentlichen</a> 
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
   $("#andereGroesse").hide(); 

    var p =0;
    var ca ="";
    var r = new Array;
    var j = -1;

    var rr = new Array;
    var jj = -1;

    Bilderladen();

    $( "#Größe" ).change(function() {
      console.log(this.value);

    if(this.value == "Sonstiges")
    {
      $("#andereGroesse").show();
    }
    else
    {
       $("#andereGroesse").hide(); 
    }
});

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
          if(form1laenge.length == 6)
          {
             if( form1laenge[i].value == "" )
              {  
                  g = 1;  
              }

              if(i == 6)
              {
                break;
              }
              
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
       KleidungUebertragen(); 
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

            if(form1laenge[4].value =='Sonstiges')
            {
              formData.append("Groesse", form1laenge[5].value);
              formData.append("Titel", form1laenge[6].value);
             
            }
            else
            {
               formData.append("Groesse", form1laenge[4].value);
                formData.append("Titel", form1laenge[6].value);

            }

            

            // marke, groesse, Verkaufstitel
            // 27 Farben (von 6 bis 32)
             myname = document.getElementById('Farbauswahl').innerHTML;

                      
            formData.append("Farbe", myname);
            

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

                                  window.location.href = "../MeineVerkaufsartikel.php";
                              } 
              }; // schliesse onload
              xhr.send(formData);// ende for

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
      {rr[++jj] =  "<img style='padding-left:20px;' id='Vorschaubild' class='media-object' src="+Text+" alt='Ihr hochgeladenes Bild'>";}
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

 
    z = new Array();

     $('#reverse' ).click(function() {

      console.log('zurück');

       r = new Array();
       var j = 0;
     z = new Array();
        

       r[++j] = '<label name="" id="Farbauswahl" ></label>';

     $('.FarbenAuswahl').html(r.join(''));

 
        
     });


    

 $("input[name = 'Farben']" ).click(function() {

       console.log( this.id);     
           
         z.push(" " +this.id);
       
         laenge = z.length;

       r = new Array();
       var j = 0;
     
      r[++j] = '<label  name="'+z+'" id="Farbauswahl" >'+z+'</label>';

    
    //  console.log('<label value="'+z+'">'+z+'</label>');

     $('.FarbenAuswahl').html(r.join(''));

     

});  

function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0){ return null;}
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



       $("select[id='Kategorie']").on('change', function() 
        {
                var Ausgabe =  document.forms["form1"].elements["Kategorie"].value ;
                // Auswahl(Ausgabe,0);
                if(Ausgabe == 'Buecher')
                window.location.href = "ArtikelHinzufügen_Buecher.php";
        });



       var idFirst;

      $("input[name='Farben']").hide();

      $("input[name='Farben']").on('click', function(){ 
               
           var Buchid = this.id;
               

           $('#'+idFirst+'1').css('border-style','' , 'border-width', '', 'border-color', 'white');

           $('#'+this.id+'1').css('border-style','solid' , 'border-width', '5px', 'border-color', 'blue');

           //document.getElementById(""+this.id).style.border = "thick solid #0000FF";
             var Farben = $('input[for='+this.id+']').css('border-style','solid' , 'border-width', '5px', 'border-color', 'blue');
            // console.log(Farben);

            idFirst = this.id;
           
        });



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


  });


  

     </script>
  </html> 
