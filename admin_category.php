<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>O'PEP</title>
</head>
<?php
  $current_page = basename($_SERVER['PHP_SELF']);
     
    $cnc = mysqli_connect("localhost", "root", "", "opep");
    $category = "SELECT * FROM categorie";
    $category_result = mysqli_query($cnc, $category);



    if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['addcategory']))) {
        

        
        $name_add = mysqli_real_escape_string($cnc, $_POST['category_add']);
   

        
       
        $category_add = "INSERT INTO categorie (nom) VALUES ('$name_add')";
        $category_add_result = mysqli_query($cnc, $category_add );

        if (  $category_add_result ) {
            
           header("location: admin_category.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($cnc);
        }
    }


  
    if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['buttonupdat']))) {
        if (isset($_POST["edit_category_id"])) {
            // Get data from the form
            $editcategoryId = $_POST["edit_category_id"];
            $newName = mysqli_real_escape_string($cnc, $_POST["name"]);
    
            // Update the record in the database using prepared statements
            $updateQuery = "UPDATE categorie SET nom = ? WHERE id = ?";
            $stmt = mysqli_prepare($cnc, $updateQuery);
    
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "si", $newName, $editcategoryId);
    
            // Execute the statement
            $updateResult = mysqli_stmt_execute($stmt);
    
            if ($updateResult) {
                echo "Product updated successfully.";
                header("Refresh: 2; URL=AdminProduct.php");
            } else {
                echo "Error updating product: " . mysqli_error($cnc);
                header("location: AdminProduct.php");
            }
    
            // Close the statement
            mysqli_stmt_close($stmt);
        }
    }
?>
<body>
<div class="hidden md:bg-green-100 md:border-2 md:border-green-900 md:h-20 md:flex md:justify-between">
    <img src="images/logo.png" alt="">
    <ul class="mt-5 flex space-x-5 h-9">

        <li class="pt-1 <?php echo ($current_page == 'pageAdmine.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="pageAdmine.php">Dashboard</a>
        </li>

        <li class="pt-1 <?php echo ($current_page == 'AdminProduct.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="AdminProduct.php">Product</a>
        </li>

        <li class="pt-1 <?php echo ($current_page == 'Admin_category.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="Admin_category.php">Category</a>
        </li>

    </ul>
</div>


<div class="md:ml-24 mr-14 grid grid-cols-3 md:grid-cols-5 gap-4 place-content-center mt-10 mb-10">
            <div class="bg-white border rounded-xl border-green-500 text-green-500 h-14 w-28 hover:bg-green-400 ease-in-out duration-300 hover:text-white cursor-pointer" onclick="openPopup()" >
                <img class="h-7 w-7 mx-auto mt-3 " src="images/plus.png" alt=""> 
                <div id="popupAdd"
                class="fixed w-full h-full top-0 left-0  items-center flex justify-center bg-black bg-opacity-50 hidden z-20">  
                <div id="popupAdd" class="bg-white pb-10 pt-10   overflow-y-auto md:h-fit">
                <form class="flex flex-col ml-5 mr-5 " action="admin_category.php" method="post">
                <label for="category"></label>
                <input type="hidden" name="add_category_id" id="add_category_id" value="">              
                <input class=" border border-black bg-slate-500 h-8 rounded-xl mt-3 " type="text" name="category_add" placeholder="category " required><br>               
                <input class="bg-green-300 rounded-xl h-8 w-36 mt-5 mx-auto " name="addcategory" type="submit" value="Add Category">
            </form>
                
            </div>
            </div>


            </div>

    <?php
            
            while ($category_row = mysqli_fetch_assoc($category_result)) {
                $category_id = $category_row["id"];
                $category_name = $category_row["nom"];
               
                ?>
                <div class="flex flex-col gap-3">
                <p class="bg-green-700  ml-3 w-20 text-center rounded-xl mt-4 cursor-pointer" onclick="open_editing_Popup('<?php echo $category_id; ?>', '<?php echo $category_name; ?>')"> Edit</p>


                    <div class= " bg-white border rounded-xl border-green-500 text-green-500 h-14 w-28 hover:bg-green-400 ease-in-out duration-300 hover:text-white focus:bg-green-400 " >
                   

                    
                    <h1 class="font-mono text-center mt-3"> <?php echo"  $category_name" ?></h1>

                    </div>  
                 </div>
                <?php
            }
           
            ?>
             </div>









              <!-- Popup -->
     <div id="popupEdit"
      class="fixed w-full h-full top-0 left-0  items-center flex justify-center bg-black bg-opacity-50 hidden z-20">
      <!-- Popup content -->
      <div id="myPopupEdit" class="bg-white  pb-10 pt-10  flex space-x-5   justify-start items-center  overflow-y-auto md:h-fit">
        <div class="flex flex-col gap-3 w-72 ml-5 text-center">
           
            <h4 id="namecategory" class=" font-sans font-semibold"></h4>
            
         </div>
         <div class="w-72  text-center">
            <form action="admin_category.php" method="post" enctype="multipart/form-data">
          

            
                <input type="hidden" name="edit_category_id" id="edit_category_id" name="id" value="">
                
                <input class=" border border-black bg-slate-500 h-8 rounded-xl mt-3 " type="text" name="name" placeholder="New name of category" required><br>
              
              
                <input class="bg-green-300 rounded-xl h-8 w-36 mt-5 " name="buttonupdat" type="submit" value="Update Product">
            </form>
        </div>
      </div>
    </div>

    <script>
function open_editing_Popup(id, name) {
    document.getElementById("edit_category_id").value = id;
    document.getElementById("namecategory").innerText = name; // Corrected id to "namecategory"
    document.getElementById("popupEdit").classList.remove("hidden");
}

function openPopup() {
    document.getElementById("popupAdd").classList.remove("hidden");
}

window.onclick = function (event) {
    var popupAdd = document.getElementById("popupAdd");
    var popupEdit = document.getElementById("popupEdit");

    if (event.target == popupAdd) {
        popupAdd.classList.add("hidden");
    }

    if (event.target == popupEdit) {
        popupEdit.classList.add("hidden");
    }
};
</script>


</body>
</html>