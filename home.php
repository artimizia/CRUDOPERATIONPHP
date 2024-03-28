
<?php
session_start();
include "db_conn.php";
$stmt = "SELECT * from  products";
$usrstmt = "SELECT * from  users";
$products=mysqli_query($conn,$stmt);
$users=mysqli_query($conn,$usrstmt);?>
<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

// // function filterTable(filterValue) {
//   console.log("filter value"+filterValue);
//   table = document.getElementById("productTable");
//   tr = table.getElementsByTagName("tr");
//   for (i = 1; i < tr.length; i++) {
//     td = tr[i].getElementsByTagName("td")[4];
//     if (td) {
//       txtValue = td.textContent || td.innerText;
//       console.log("txtValue"+txtValue);
//       if(filterValue.toUpperCase()==="ALL"){
//         tr[i].style.display = "";
//       }
//       else if (txtValue.toUpperCase()===filterValue.toUpperCase()) {
//         tr[i].style.display = "";
//       } else {
//         tr[i].style.display = "none";
//       }
//     }
//   }
// }
function confirmationBox(sku) {
  if (confirm('delete?')) {
  deleteProduct(sku);
  } 
}

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
                     var productName = result[item].Product_Name;
                     var image = result[item].Image;
                     console.log("test"+result[item].Product_Name);
                     var img = document.createElement("img"); 
                     img.alt= productName;

                     img.src =image;
                    var sku = result[item].SKU;
                    imageCell.appendChild(img);
                    imageCell.onclick=function(){ updateProduct(sku); } ;
                    row.appendChild(imageCell); 
                    var nameCell = document.createElement("td"); 
                    nameCell.textContent = result[item].Product_Name; 
                    nameCell.onclick=function(){ updateProduct(sku); } ;

                    row.appendChild(nameCell); 
                    var priceCell = document.createElement("td"); 
                    priceCell.textContent = result[item].sale_price >0? result[item].sale_price:result[item].regular_price;
                    priceCell.onclick=function(){ updateProduct(sku); } ;
                    row.appendChild(priceCell); 
                    var skuCell = document.createElement("td"); 
                    skuCell.textContent = result[item].SKU; 
                    skuCell.onclick=function(){ updateProduct(sku); } ;
                    row.appendChild(skuCell); 

                    var categoryCell = document.createElement("td"); 
                    categoryCell.textContent = result[item].Category;
                    categoryCell.onclick=function(){ updateProduct(sku);} ;
                    row.appendChild(categoryCell); 
                    var actionCell = document.createElement("td"); 
                    var viewProductButton = document.createElement('input');
                    viewProductButton.type = "button";
                    viewProductButton.value="view";
                    viewProductButton.onclick = function() {viewProduct(sku);};
                    actionCell.appendChild(viewProductButton);
                    var admin = '<?php echo $_SESSION['admin']?>';
                    if(admin == 1){
                        console.log("comes in admin");
                        var updateProductButton = document.createElement('input');
                        updateProductButton.type = "button";
                        updateProductButton.value="update";
                        updateProductButton.onclick = function() {updateProduct(sku);}
                        actionCell.appendChild(updateProductButton);
                        var btn = document.createElement('input');
                        btn.type = "button";
                        btn.value = "delete";
                        btn.onclick = function() {confirmationBox(sku);};
                    }
                    console.log(typeof admin);
                    actionCell.appendChild(btn);
                    row.appendChild(actionCell);
                    tableBody.appendChild(row); 
                }
              
             }
            },
            error:function(result){
                $("#productTable tbody tr").remove(); 
                     console.log("filter failure"+JSON.stringify(result));
            }
        });
   }

function updateProduct(sku){
	window.location.href="updateProduct.php?sku="+sku;
}

function viewProduct(sku){
    window.location.href="viewProduct.php?sku="+sku;
}

function deleteProduct(sku){
	     $.ajax({
            url:"deleteProducts.php",    
            type: "post",    
            data: ({sku: sku}),
            timeout:5000,
            success:function(result){
               window.location.reload();
            },
            error:function(result){
             window.location.reload();
            }
        });
}

function deleteUser(username){
	    $.ajax({
            url:"deleteUser.php",    
            type: "post",
            data: ({user_name: username}),
            timeout:5000,
            success:function(result){
                window.location.reload();
            },
            error:function(result){
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
<?php if(isset($_SESSION['user_name']) && isset($_SESSION['password'])){?>
<body>
<div class="flex header">	<h1>Hello, <?php echo $_SESSION['user_name'];?></h1>
	<a href="logout.php">Logout</a></div>
	<?php if($_SESSION['admin']==1){?>
	<p>
     <a href="addUser.php" type="button" class="btn btn-sm btn-success">Add New User</a>
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
            <td><?php echo $user['user_name'] ?></td>
            <td><?php echo  crypt($user['password'] , 'st')?></td>
            <td>
            	
                <a href="editUser.php?user_name=<?php echo $user['user_name'] ?>" >Edit</a>
                <button onclick="deleteUser('<?php echo $user['user_name'];?>')">Delete</button>
                
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php } ?>
<br/>
<br/>
</br/>
<?php if($_SESSION['admin']==1){?>
    <a href="addProduct.php" type="button" class="btn btn-sm btn-success">Add New Product</a>
<?php } ?>
    <label for="category">Choose a category:</label>
    <select name="category" id="category" onchange="filterTable(this.value)">
    <option value="all">all</option>
    <option value="grocery">grocery</option>
    <option value="toiletries">toiletries</option>
    <option value="misc">misc</option>
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
                <?php if ($product['Image']): ?>
                    <img src="/<?php echo $product['Image'] ?>" alt="<?php echo $product['Product_Name'] ?>" >
                <?php endif; ?>
            </td>
            <td onclick="updateProduct('<?php echo $product['SKU'];?>')"><?php echo $product['Product_Name'] ?></td>
            <td onclick="updateProduct('<?php echo $product['SKU'];?>')"><?php echo $product['sale_price'] >0 ?$product['sale_price']:$product['regular_price']?></td>
            <td onclick="updateProduct('<?php echo $product['SKU'];?>')"><?php echo $product['SKU'] ?></td>
            <td onclick="updateProduct('<?php echo $product['SKU'];?>')"><?php echo $product['Category'] ?></td>
            <td>
            	<button onclick="viewProduct('<?php echo $product['SKU'];?>')">View</button>
            	<?php if($_SESSION['admin']==1){?>
                <button onclick="updateProduct('<?php echo $product['SKU'];?>')">Update</button>
                <button onclick="confirmationBox('<?php echo $product['SKU'];?>')">Delete</button>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
<?php } ?>
</html>

