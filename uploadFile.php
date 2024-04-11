<?php 
function uploadFile($fileObject){
 echo "comes inside uploadFile";
  $target_path = "e:/"; 
  $uploadFileDir = "images/";
  if(file_exists($fileObject['tmp_name'])){
    $fileTmpPath = $fileObject['tmp_name'];
    $fileName = $fileObject['name'];
    $target_path = $target_path.basename($fileObject['name']); 
    $dest_path = $uploadFileDir . $fileName;
    if(move_uploaded_file($fileTmpPath, $dest_path)) {
          echo "File uploaded successfully";
          return $fileName;
    }else{
       throw new Exception();
    }
  }else{
    echo "no file uploaded";
  }
}

?>