<?php 
  header('Access-Control-Allow-Origin: *');  
  
  $uploadedfileload="true";
  $uploadedfile_size=$_FILES['file']['size'];
  $decision='success';

  if ($_FILES['file']['size']>400000 OR !($_FILES['file']['type'] =="image/jpeg" OR $_FILES['file']['type'] =="image/png")){
    echo "error";
    $uploadedfileload="false";
    $decision='error';
  }else{
      echo 'success';
      $decision='success';
  }



  return $decision;
  
