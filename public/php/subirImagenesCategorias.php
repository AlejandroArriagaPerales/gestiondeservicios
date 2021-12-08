<?php 
  header('Access-Control-Allow-Origin: *');  
  
  $uploadedfileload="true";
  $uploadedfile_size=$_FILES['file']['size'];
  

  $file_name=$_FILES['file']['name'];
  if($uploadedfileload=="true"){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "../images/categorias/".$_FILES['file']['name'])) {
      echo "success";
      exit;
    }
  }else{
  }

  return $decision;
  



  
  
?>
