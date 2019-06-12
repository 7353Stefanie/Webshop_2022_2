<?php
 session_start();
?>

<html lang="de">
  <head>
            <meta charset="utf-8"/>
            <title>Zahlungsbestätigung</title>                               
             

             <link rel="stylesheet" href="Hilfsdokumente/willkommenStyle.css"> 
             <link rel="stylesheet" href="Hilfsdokumente/ZumKauf.css">
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
        
       <header style="margin-left: 5%; margin-right: 5%;">
            <div class="container-fluid" style=" background-color: #f5f5ff;"">
              <div class='row' style=" margin-left: 0; margin-right: 0; ">

                     <button class="col-md-4" onclick="location.href='ZumKauf.php'"   style=" background-color: #f5f5f5;">Kaufübersicht</button>                        
                                    
                    
                     <button class="col-md-4" onclick="location.href='ZuDenZahlungsdetails.php'" style="background-color: #f5f5f5;">                    
                                    Zahlungsdetails
                     </button>
                     <button class="col-md-4" onclick="location.href='ZurZahlungsbestaetigung.php'" style="background-color: #f5f5f5;">
                                    Zahlungsbestätigung
                     </button>                       
                         
                </div> <!-- row-->                
              </div> <!-- container fluid-->

      </header>        
</body>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
     <script src="Hilfsdokumente/js/bootstrap.min.js"></script> 
     <script src="Hilfsdokumente/js/jquery.min.js"></script>
    
</html>