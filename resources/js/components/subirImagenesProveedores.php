<?php 
  header('Access-Control-Allow-Origin: *');  
  
  $uploadedfileload="true";
  $uploadedfile_size=$_FILES['file']['size'];
  

  $file_name=$_FILES['file']['name'];
  $add="../../images/proveedores/$file_name";
  if($uploadedfileload=="true"){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "../../images/proveedores/".$_FILES['file']['name'])) {
      echo "success";
      exit;
    }
  }else{
  }

  return $decision;
  



  
  
?>
