<?php 
  header('Access-Control-Allow-Origin: *');  
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  $uploadedfileload="true";
  $uploadedfile_size=$_FILES['file']['size'];
  

  $file_name=$_FILES['file']['name'];
  if($uploadedfileload=="true"){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/SistemaGestor/gestiondeservicios/public/images/prestadores/".$_FILES['file']['name'])) {
      echo "success";
      exit;
    }else{
      echo "error";
      exit;
    }
  }else{
    echo "error";
    exit;
  }

  return $decision;
  



  
  
?>


