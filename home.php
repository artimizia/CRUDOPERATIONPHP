
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
<script>
function filterTable(filterValue) {
  console.log("filter value"+filterValue);
  table = document.getElementById("productTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      console.log("txtValue"+txtValue);
      if(filterValue.toUpperCase()==="ALL"){
        tr[i].style.display = "";
      }
      else if (txtValue.toUpperCase()===filterValue.toUpperCase()) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function updateRow(sku){
	window.location.href="updateProduct.php?sku="+sku;

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
            <td><?php echo $user['password'] ?></td>
            <td>
            	
                <a href="editUser.php?user_name=<?php echo $user['user_name'] ?>" >Edit</a>
                <form method="post" action="deleteUser.php" style="display: inline-block">
                    <input  type="hidden" name="user_name" value="<?php echo $user['user_name'] ?>"/>
                    <button type="submit" >Delete</button>
                </form>
                
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

	 <?php } ?>
	
<br/>
<br/>
</br/>
    <a href="addProduct.php" type="button" class="btn btn-sm btn-success">Add New Product</a>
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
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">SKU</th>
        <th scope="col">Category</th>
        <th scope="col">Actions</th>
   
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $i => $product) { ?>
        <tr onclick="updateRow('<?php echo $product['SKU'];?>')" >
            <th scope="row"><?php echo $i + 1 ?></th>
            <td>
                <?php if ($product['Image']): ?>
                    <img src="/<?php echo $product['Image'] ?>" alt="<?php echo $product['Product_Name'] ?>" >
                <?php endif; ?>
            </td>
            <td><?php echo $product['Product_Name'] ?></td>
            <td><?php echo $product['Price'] ?></td>
            <td><?php echo $product['SKU'] ?></td>
            <td><?php echo $product['Category'] ?></td>
            <td>
            	<a href="viewProduct.php?sku=<?php echo $product['SKU'] ?>" >View</a>
            	<?php if($_SESSION['admin']==1){?>
                <a href="updateProduct.php?sku=<?php echo $product['SKU'] ?>" >Update</a>
                <form method="post" action="deleteProducts.php" style="display: inline-block">
                    <input  type="hidden" name="sku" value="<?php echo $product['SKU'] ?>"/>
                    <button type="submit" >Delete</button>
                </form>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>

