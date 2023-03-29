 <?PHP 
 	session_start();

 
   if (isset($_SESSION['idBenutzer']))
   {
    session_unset($_SESSION['idBenutzer']);
   }

if (isset($_SESSION['benutzername']))
   {
    $_SESSION['benutzername'] = [];
   }

   if (isset($_SESSION['Bilder']))
   {
    $_SESSION['Bilder'] = [];
   }

   if (isset($_SESSION['hochgeladenesBuch']))
   {
   $_SESSION['hochgeladenesBuch'] = [];

   }
   if (isset($_SESSION['ArtikelInfos']))
   {
    $_SESSION['ArtikelInfos']  = [];
   }

   if (isset($_SESSION['RegistrierungStatus']))
   {
   $_SESSION['RegistrierungStatus']  = [];
   }

     if (isset($_SESSION['RegistrierungStatus']))
   {
     $_SESSION['LoginDat']   = [];
   }
   

  

  session_destroy();

  if(  strpos(__DIR__,'Final') == false)
  {
     header('Location: https://sb-box42.de/Webshop/Final.php');
  }
  else
  {
    //header('Location: http://' . $_SERVER['HTTP_HOST'] . __DIR__);
    header('Location: http://Localhost/Final/Final.php');
  }
  
   
  ?>