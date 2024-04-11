
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


function populateProductTable(products){
         tableBody = document.getElementById("tableBody");
             if(Object.keys(products).length> 0){
                for(var item in products) {
                     var row = document.createElement("tr"); 
                     var imageCell = document.createElement("td"); 
                     var productName = products[item].productName;
                     var image = products[item].image;
                     var img = document.createElement("img"); 
                     img.alt= productName;
                     img.src ='images/'+image;
                     img.style ="width:55px;height:56px;"
                    var sku = products[item].sku;
                    imageCell.value=sku;
                    imageCell.id=sku;
                    imageCell.appendChild(img);

       
                    row.appendChild(imageCell); 
                    imageCell.onclick=function(currentRow){

                     console.log( $(this).attr('id'));
                     addProduct($(this).attr('id'),"update");
                      } ;
                    var nameCell = document.createElement("td"); 
                    nameCell.id=sku;
                    nameCell.textContent = products[item].productName; 
                    nameCell.onclick=function(){ addProduct($(this).attr('id'),"update"); } ;

                    row.appendChild(nameCell); 
                    var priceCell = document.createElement("td"); 
                    priceCell.textContent = products[item].salePrice >0? products[item].salePrice:products[item].regularPrice;
                    priceCell.id=sku;
                    priceCell.onclick=function(){ addProduct($(this).attr('id'),"update"); } ;
                    row.appendChild(priceCell); 
                    var skuCell = document.createElement("td"); 
                
                    skuCell.textContent = escapeHtml(products[item].sku); 
                    skuCell.id=sku;
                    skuCell.onclick=function(){ addProduct($(this).attr('id'),"update"); } ;
                    row.appendChild(skuCell); 

                    var categoryCell = document.createElement("td"); 
                    categoryCell.id=sku;
                    categoryCell.textContent = products[item].category;
                    categoryCell.onclick=function(){ addProduct($(this).attr('id'),"update");} ;
                    row.appendChild(categoryCell); 
                    var actionCell = document.createElement("td"); 
                    var viewProductButton = document.createElement('input');
                    viewProductButton.type = "button";
                    viewProductButton.value="view";
                    viewProductButton.id=sku;
                    viewProductButton.onclick = function() {
                    viewProduct($(this).attr('id'));};
                    actionCell.appendChild(viewProductButton);
                    var admin = '<?php echo $_SESSION['admin']?>';
                    if(admin == 1){
                        var updateProductButton = document.createElement('input');
                        updateProductButton.type = "button";
                        updateProductButton.value="update";
                        updateProductButton.id=sku;
                        updateProductButton.onclick = function() {
                            addProduct($(this).attr('id'),"update");
                        }
                        actionCell.appendChild(updateProductButton);
                        var btn = document.createElement('input');
                        btn.type = "button";
                        btn.value = "delete";
                        btn.id=sku;
                        btn.onclick = function() {confirmationBox($(this).attr('id'));};
                        actionCell.appendChild(btn);
                    }
                    row.appendChild(actionCell);
                    tableBody.appendChild(row); 
                }
              
             }

}
function populateUserTable(users){
      tableBody = document.getElementById("userBody");
      console.log(Object.keys(users).length);

             if(Object.keys(users).length> 0){
                console.log("comes inside users"+users);
                for(var user in users) {
                     var row = document.createElement("tr"); 
                     var userCell = document.createElement("td"); 
                     userCell.id=users[user].userName;
                     userCell.textContent = escapeHtml(users[user].userName); 
                     row.appendChild(userCell); 
                     var actionCell = document.createElement("td"); 
                    var editButton = document.createElement('input');
                    editButton.type = "button";
                    editButton.value="edit";
                    editButton.id=users[user].userName;
                    editButton.onclick = function() {
                    addUser($(this).attr('id'),"edit");};
                    actionCell.appendChild(editButton);
                    var admin = '<?php echo $_SESSION['admin']?>';
                    var deleteUserButton = document.createElement('input');
                        deleteUserButton.type = "button";
                        deleteUserButton.value="delete";
                        deleteUserButton.id=users[user].userName;
                        deleteUserButton.onclick = function() {
                            confirmationUserDelete($(this).attr('id'));
                        }
                        actionCell.appendChild(deleteUserButton);

                    row.appendChild(actionCell);
                    tableBody.appendChild(row); 
                }
              
             }
}

function populateUsers(filterValue){
       $.ajax({
            url:"fetchUsers.php",    
            type: "post",
            dataType: "json",    
            data: {},
            timeout:5000,
            success:function(result){
                console.log("success"+JSON.stringify(result));
                 $("#userTable tbody tr").remove(); 
                  populateUserTable(result);
           
            },
            error:function(result){
                console.log("exception"+JSON.stringify(result));
                  $("#userTable tbody tr").remove(); 
            }
        });
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
                populateProductTable(result);
           
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
    console.log("sku is "+sku);
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
$(document).ready(function(){
    $('#addNewUser').on('click',function() {
       addUser('','add');
    });
    $('#addNewProduct').on('click',function(){
        addProduct('','add');
    })
    $('#editUser').on('click',function(){
        console.log($(this).attr('value'));
          //addUser($(this).attr('value'),'edit')"
    })
 
    filterTable("all");
    populateUsers();
});


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
    .productTable{
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
     <button id="addNewUser" >Add New user</button>
    </p>
		<table id="userTable" class="table">
    <thead>
    <tr>
        <th scope="col">UserName</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody id="userBody">
  
    </tbody>
</table>
<?php } ?>
<br/>
<br/>
</br/>
<?php {?>
    <button id="addNewProduct">Add New Product</button>
<?php } ?>
    <label for="category">Choose a category:</label>
    <select name="category" id="category" onchange="filterTable(this.value)">
        <option value="all">all</option>
    <?php foreach ($categories as $row){ ?>
      <option value="<?= $row['categoryName'] ?>">
        <?= $row['categoryName']?>
      </option>
      <?php  } ?>
   </select>
   <br/>
   <br/>
	<table id ="productTable"class="productTable">
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
    
    </tbody>
</table>
</body>
</html>

