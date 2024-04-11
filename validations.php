 <?php
  function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  } 
  
  function isAddProduct(){
    return $_SERVER["PHP_SELF"]==="/Test/addProduct.php";
  }

?>