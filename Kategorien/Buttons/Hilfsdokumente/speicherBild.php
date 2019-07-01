<?php


 session_start();


if(isset($_FILES))
{
	// try catch am Ende
	try{

	//print_r($_FILES);


	$extension = strtolower(pathinfo($_FILES['PostImage']['name'], PATHINFO_EXTENSION));
	//print_r($extension);

  		// Überprüfung ob das Bild zu groß ist
	$groesse = Getsize($_FILES['PostImage']['size']);

	// überprüfe die File Endung
	$endung = endung($_FILES['PostImage']['name']);	

	// Überprüfung ob es ein Bild ist
	$pic = isPic($_FILES['PostImage']['tmp_name']);  	
  	
  	// Überprüfung des Myme Types
  	//$MymeType = get_mime_type($_FILES['PostImage']['type']);
  	//echo $MymeType;


	//Eindeutiger Bildname
  	$NeuerName= GUID(); // neuer Name
  	$_FILES['PostImage']['name'] = $NeuerName;  //überschreibung des alten Namen


  	if(($groesse == "true") &&  ($endung == "true") && ($pic == "true"))
  	{
  		$Upload_Ordner = 'uploads/Bilder/';//.$_SESSION['benutzername'].'/';
  		$BildPfad = $Upload_Ordner.$_FILES['PostImage']['name'].'.'.$extension;

  		if(file_exists($BildPfad))
  		{
  			$id = 1;
 			do 
 			{ 			$BildPfad = $Upload_Ordner.$_FILES['PostImage']['name'].'_'.$id.'.'.$extension;
 			 			$id++;
 			} 
 			while(file_exists($new_path));
  		}

  		move_uploaded_file($_FILES['PostImage']['tmp_name'], $BildPfad);

  		
  		
  		$arrayX = array();
  		
  		if (!isset ( $_SESSION['Bilder'] ) )
  		{
  			$arrayX = array("0"=> $BildPfad);
  			$_SESSION['Bilder']  = $arrayX;
  		}
  		else
  		{
  			$AnzahlBilder = count($_SESSION['Bilder']); 	
  			
  			$val = 0;

  			foreach ($_SESSION['Bilder'] as $key) 
  			{
  				$arrayX[$val] = $key; 
  				$val++;
  			}
  			$arrayX[$val++] = $BildPfad;
  			$_SESSION['Bilder'] = $arrayX;  			

  			//alle Bilder werden in einer Session gespeichert
  		}	 	
		var_dump($BildPfad);
  	}

  } // ende try
	catch(Exception $err)
	{echo "[Error] ein Fehler ist aufgetreten";  }
}//ende if 
else
{
	echo " [Error] es sind Keine Daten angekommen";
}


function fehler($var)
{
	switch ($var) {
		case 'Size':
			echo "[Error] Bitte aendern Sie die groesse auf max 250KB pro Bild";
			break;
		case 'tmpName':
			die("[Error] Nur der Upload von Bilddateien ist gestattet");
			break;
		case 'Endung':
			die("[Error] Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
			# code...
			break;
	}
}


function endung($Endung)
{
	$extension = strtolower(pathinfo($Endung, PATHINFO_EXTENSION));
	$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
	if(!in_array($extension, $allowed_extensions)) {
	// die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
	 fehler("Endung");
	 return false;
	}
	return true;
}


  	function get_mime_type($path)
{
	if (version_compare(PHP_VERSION, '5.3.0') < 0) return false;	
	if (!function_exists('finfo_open')) return false;

	if (!$finfo = finfo_open(FILEINFO_MIME_TYPE)) return false;
	$mime_type = finfo_file($finfo, $path);
	finfo_close($finfo);	

	return $mime_type;
}


  function Getsize($groesse)
  {
  	  	if($groesse >250000)
  	{
  		//echo "Bitte aendern Sie die groesse auf max 250KB pro Bild";
  		fehler("Size");
  		return false;
  	}
  	return true;
  }

  function isPic($tmpName)
  {
  	$allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF); // funktioniert
	$detected_type = exif_imagetype($tmpName); // funktioniert

	if(!in_array($detected_type, $allowed_types))
	 {
  	//die("Nur der Upload von Bilddateien ist gestattet");
  	fehler("tmpName");

  	return false;
  	}
  	return true;
  }


	function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
?>
