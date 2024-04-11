
<?php
if( !isset($_SESSION) || session_id() == '' ||session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "db_conn.php";
include "validations.php";
include "dbController.php";
if(!isset($_SESSION['userName']) || !isset($_SESSION['password'])){
    header("Location:index.php");
    exit();
}
try{
    $categories=fetchCategories($conn);
    $products=fetchAllProducts($conn);
    if($_SESSION['admin']==1){
        $users=fetchAllUsers($conn);
    }

}catch(Exception $e){
   echo '<script>
      alert("Error occured");</script>'; 
}

?>

<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

function confirmationBox(sku) {
  console.log("comes in confirmation box");
  if (confirm('delete?')) {
    deleteProduct(sku);
  } 
}

var escapeHtml = function (html) {
    var txt = document.createElement('textarea');
    txt.innerHTML = html;
    return txt.value;
};

function filterTable(filterValue){
       $.ajax({
            url:"filterValue.php",    
            type: "post",
            dataType: "json",    
            data: ({category: filterValue}),
            timeout:5000,
            success:function(result){
                $("#productTable tbody tr").remove(); 
                tableBody = document.getElementById("tableBody");
             if(Object.keys(result).length> 0){
                for(var item in result) {
                     var row = document.createElement("tr"); 
                     var imageCell = document.createElement("td"); 
                     var productName = result[item].productName;
                     var image = result[item].image;
                     var img = document.createElement("img"); 
                     img.alt= productName;
                     img.src ='images/'+image;
                     img.style ="width:55px;height:56px;"
                    var sku = result[item].sku;
                    imageCell.appendChild(img);
                    imageCell.onclick=function(){ addProduct(sku); } ;
                    row.appendChild(imageCell); 
                    var nameCell = document.createElement("td"); 
                    nameCell.textContent = result[item].productName; 
                    nameCell.onclick=function(){ addProduct(sku,"update"); } ;

                    row.appendChild(nameCell); 
                    var priceCell = document.createElement("td"); 
                    priceCell.textContent = result[item].salePrice >0? result[item].salePrice:result[item].regularPrice;
                    priceCell.onclick=function(){ addProduct(sku,"update"); } ;
                    row.appendChild(priceCell); 
                    var skuCell = document.createElement("td"); 
                    console.log("skucell"+escapeHtml(result[item].sku));
                    skuCell.textContent = escapeHtml(result[item].sku); 
                    skuCell.onclick=function(){ addProduct(sku,"update"); } ;
                    row.appendChild(skuCell); 

                    var categoryCell = document.createElement("td"); 
                    categoryCell.textContent = result[item].category;
                    categoryCell.onclick=function(){ addProduct(sku,"update");} ;
                    row.appendChild(categoryCell); 
                    var actionCell = document.createElement("td"); 
                    var viewProductButton = document.createElement('input');
                    viewProductButton.type = "button";
                    viewProductButton.value="view";
                    viewProductButton.onclick = function() {viewProduct(sku);};
                    actionCell.appendChild(viewProductButton);
                    var admin = '<?php echo $_SESSION['admin']?>';
                    if(admin == 1){
                        var updateProductButton = document.createElement('input');
                        updateProductButton.type = "button";
                        updateProductButton.value="update";
                        updateProductButton.onclick = function() {addProduct(sku,"update");}
                        actionCell.appendChild(updateProductButton);
                        var btn = document.createElement('input');
                        btn.type = "button";
                        btn.value = "delete";
                        btn.onclick = function() {confirmationBox(sku);};
                        actionCell.appendChild(btn);
                    }
                    row.appendChild(actionCell);
                    tableBody.appendChild(row); 
                }
              
             }
            },
            error:function(result){
                console.log("exception");
                $("#productTable tbody tr").remove(); 
                     console.log("filter failure"+JSON.stringify(result));
            }
        });
   }

function updateProduct(sku){
    console.log("comes to updatye");
    window.location.href="updateProduct.php?sku="+encodeURIComponent(sku);
}

function addProduct(sku,type){
    console.log("add product");
    window.location.href="addProduct.php?type="+type+"&sku="+encodeURIComponent(sku);
}

function addUser(userName,type){
    console.log("add user");
    window.location.href="addUser.php?type="+type+"&username="+encodeURIComponent(userName);
}

function viewProduct(sku){
    window.location.href="viewProduct.php?sku="+encodeURIComponent(sku);
}

function deleteProduct(sku){
	     $.ajax({
            url:"deleteProducts.php", 
            dataType: 'json',   
            type: "post",      
            data: ({sku: sku}),
            timeout:5000,
            success:function(result){
                if(result["error"]){
                  alert("Error occured");
                }
               window.location.reload();
            },
            error:function(result){
                 alert("error occured");
                 window.location.reload();
            }
        });
}

function confirmationUserDelete(username) {
  if (confirm('delete user?')) {
     deleteUser(username);
  } 
}

function deleteUser(username){
	    $.ajax({
            url:"deleteUser.php",    
            type: "post",
            dataType:'json',
            data: ({userName: username}),
            timeout:5000,
            success:function(result){
                console.log("success");
                if(result["error"]){
                  alert("Error occured");
                }
                window.location.reload();
            },
            error:function(result){
                 console.log("result is"+result);
                 alert(result);
                 window.location.reload();
            }
        });
}



</script>
<title>Home</title>
<style type="text/css">
	.flex 
	{
		display:flex;

	}
	.header {
	justify-content: space-between;
    align-items: center;
    }
    .table{
    	 width: 100%;
         background: #f9f9f9;
    }
    tr:nth-child(odd) {
    	background: white;
    }
</style>
</head>
<body>
<div class="flex header"><h1>Hello, <?php echo $_SESSION['userName'];?></h1>
	<a href="logout.php">Logout</a></div>
	<?php if($_SESSION['admin']==1){?>
	<p>
     <button onclick="addUser('','add')">Add New user</button>
    </p>
		<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">UserName</th>
        <th scope="col">Password</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $i => $user) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $user['userName'] ?></td>
            <td><?php echo  $user['password'] ?></td>
            <td>
            	
               <button onclick="addUser('<?php echo validateInput($user['userName']);?>','edit')">edit </button>
                <button onclick="confirmationUserDelete('<?php echo validateInput($user['userName']);?>')">Delete</button>
                
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php } ?>
<br/>
<br/>
</br/>
<?php {?>
    <button onclick="addProduct('','add')">Add New Product</button>
<?php } ?>
    <label for="category">Choose a category:</label>
    <select name="category" id="category" onchange="filterTable(this.value)">
    <?php foreach ($categories as $row){ ?>
      <option value="<?= $row['categoryName'] ?>">
        <?= $row['categoryName']?>
      </option>
      <?php  } ?>
    <option value="all">all</option>
   </select>
   <br/>
   <br/>
	<table id ="productTable"class="table">
    <thead>
    <tr>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">SKU</th>
        <th scope="col">Category</th>
        <th scope="col">Actions</th>
   
    </tr>
    </thead>
    <tbody id="tableBody">
    <?php foreach ($products as $i => $product) { ?>
        <tr  >
            <td>

             <img src=<?php echo 'images/'.$product['image'];?>  style="width:55px;height:56px;"> 
               
            </td>
            <td onclick="addProduct('<?php echo validateInput($product['sku']);?>','update')"><?php echo $product['productName'] ?></td>
            <td onclick="addProduct('<?php echo validateInput($product['sku']);?>','update')"><?php echo $product['salePrice'] >0 ?$product['salePrice']:$product['regularPrice']?></td>
            <td onclick="addProduct('<?php echo validateInput($product['sku']);?>','update')"><?php echo $product['sku'];?></td>
            <td onclick="addProduct('<?php echo validateInput($product['sku']);?>','update')"><?php echo $product['category'] ?></td>
            <td>
            	<button onclick="viewProduct('<?php echo validateInput($product['sku']);?>')">View</button>
            	<?php if($_SESSION['admin']==1){?>
                   <button onclick="addProduct('<?php echo validateInput($product['sku']);?>','update')">Update</button>
            
                <button onclick="confirmationBox('<?php echo validateInput($product['sku']);?>')">Delete</button>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>

