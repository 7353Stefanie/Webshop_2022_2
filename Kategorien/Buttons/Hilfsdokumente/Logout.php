 <?PHP 
 	session_start();

  session_unset($_Session['idBenutzer']);
   session_unset($_Session['benutzername']);
   session_unset($_Session['Bilder']);
   session_unset($_Session['hochgeladenesBuch']);
   session_unset($_Session['ArtikelInfos']); 
   

  session_destroy();
  
   header('Location: http://' . $_SERVER['HTTP_HOST'] . __DIR__);
?>