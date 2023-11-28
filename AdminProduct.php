<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>O'PEP</title>
</head>

<?php
     $current_page = basename($_SERVER['PHP_SELF']);
     

     $cnc = mysqli_connect("localhost", "root", "", "opep");
     $product = "SELECT * FROM plante";
     $product_result = mysqli_query($cnc, $product);
     $categorie = "SELECT * FROM categorie";
     $categorie_result = mysqli_query($cnc, $categorie);

     if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['buttonupdat']))) {
        if (isset($_POST["edit_product_id"])) {
            // Get data from the form
            $editProductId = $_POST["edit_product_id"];
            $newName = mysqli_real_escape_string($cnc, $_POST["name"]);
            $newPrice = mysqli_real_escape_string($cnc, $_POST["price"]);
            
            // Handle file upload
            $newImage = basename($_FILES["image"]["name"]);
            $targetDir = "../images/";
            $targetFile = $targetDir . $newImage;
    
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "Image uploaded successfully.";
            } else {
                echo "Error uploading image.";
            }
    
            // Update the record in the database using prepared statements
            $updateQuery = "UPDATE plante SET nom = ?, prix = ?, image = ? WHERE id = ?";
            $stmt = mysqli_prepare($cnc, $updateQuery);
    
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sssi", $newName, $newPrice, $targetFile, $editProductId);
    
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
    if (isset($_POST["delete_product_id"])) {
        $deleteProductId = $_POST["delete_product_id"];
        echo "$deleteProductId ";
        $deleteQuery = "DELETE FROM plante WHERE id = $deleteProductId";
        $deleteResult = mysqli_query($cnc, $deleteQuery);
    
        if ($deleteResult) {
            echo "Product deleted successfully.";
            header("Refresh: 2; URL=AdminProduct.php");
            exit();
        } else {
            echo "Error deleting product: " . mysqli_error($cnc);
            header("location: AdminProduct.php");
            exit();
        }
    }
    
    if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['addproduct'])) && ($_POST['categorie_plant'] !== 'choose your category' ) ) {
        

        
        $name_add = mysqli_real_escape_string($cnc, $_POST['name_add']);
        $price_add = mysqli_real_escape_string($cnc, $_POST['price_add']);
        $category_add = mysqli_real_escape_string($cnc, $_POST['categorie_plant']);
        $newImage_add = basename($_FILES["image_add"]["name"]);
        $targetDir_add = "../images/";
        $targetFile_add = $targetDir_add . $newImage_add;

        
       
        $product_add = "INSERT INTO plante (image, nom, prix, categorie_id) VALUES ('$targetFile_add','$name_add', '$price_add', '$category_add')";
        $product_add_result = mysqli_query($cnc, $product_add, $category_add );

        if (  $product_add_result ) {
            echo "hhhhhhhhhh";
            header("Refresh: 1; URL=AdminProduct.php");
            exit();
        } else {
           
            echo "Error: " . mysqli_error($cnc);
        }
    }



    

     ?>
    
    

<body>
     <!-- Popup -->
     <div id="popupEdit"
      class="fixed w-full h-full top-0 left-0  items-center flex justify-center bg-black bg-opacity-50 hidden z-20">
      <!-- Popup content -->
      <div id="myPopupEdit" class="bg-white  pb-10 pt-10  flex space-x-5   justify-start items-center  overflow-y-auto md:h-fit">
        <div class="flex flex-col gap-3 w-72 ml-5 text-center">
            <img class="  rounded-xl" id="imgProduct"  >
            <h4 id="nameProduct" class=" font-sans font-semibold"></h4>
            <p id="categoryProduct" ></p>
            <p id="priceProduct"  ></p>
         </div>
         <div class="w-72  text-center">
            <form action="AdminProduct.php" method="post" enctype="multipart/form-data">
            <label for="image"></label>

                <div id="addImg" class =" m-0 h-48 border border-black rounded-xl mr-5 cursor-pointer mt-3 "><img class="w-20 h-20 mx-auto m-14" src="images/plus.png" alt=""> </div>
                <input type="hidden" name="edit_product_id" id="edit_product_id" name="id" value="">
                 <input type="file" name="image" >
                <input class=" border border-black bg-slate-500 h-8 rounded-xl mt-3 " type="text" name="name" placeholder="Name Product" required><br>
              
                <input class=" border border-black bg-slate-500 h-8 rounded-xl mt-3 " type="text" name="price" placeholder="Price"required><br>
                <input class="bg-green-300 rounded-xl h-8 w-36 mt-5 " name="buttonupdat" type="submit" value="Update Product">
            </form>
        </div>
      </div>
    </div>
    <!-- End of Popup -->


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
        <div class="md:ml-24 ml-14 grid grid-cols-1 md:grid-cols-4 gap-4 place-content-center mt-10 mb-10">
            <!-- add plant -->
            <div class="hover:bg-green-200 bg-gray-400   border border-green-600  shadow-2xl  rounded-2xl  w-64 h-96 cursor-pointer " onclick="openPopup()" >
            <img class="mx-auto my-20  " src="images/plus.png" alt="">
            <!--    popup to add plant -->
             <div id="popupAdd"
                class="fixed w-full h-full top-0 left-0  items-center flex justify-center bg-black bg-opacity-50 hidden z-20">
              
                <div id="popupAdd" class="bg-white pb-10 pt-10   overflow-y-auto md:h-fit">

                <form class="flex flex-col ml-5 mr-5 " action="AdminProduct.php" method="post" enctype="multipart/form-data">
                <label for="product"></label>
                <input type="hidden" name="add_product_id" id="add_product_id" value="">
                 <input type="file" name="image_add" >
                <input class=" border border-black bg-slate-500 h-8 rounded-xl mt-3 " type="text" name="name_add" placeholder="Name Product" required><br>
              
                <?php
                    // Reset the internal pointer of $categorie_result
                    mysqli_data_seek($categorie_result, 0);
                    
                  
            ?>
                   
                   <select name="categorie_plant" id="">
                    <option selected> choose your category</option>

                  
                  
                    <?php
                    while ($categorie_row = mysqli_fetch_assoc($categorie_result)) {
                        $categorie_id = $categorie_row["id"];
                        $name_categoriee = $categorie_row["nom"];
                        ?>
                        <option value=" <?php echo $categorie_id ?> "> <?php echo  $name_categoriee ?> </option>
                        <?php
                    }
                
                ?>
                
                </select>
                <input class=" border border-black bg-slate-500 h-8 rounded-xl mt-3 " type="text" name="price_add" placeholder="Price"required><br>
                <input class="bg-green-300 rounded-xl h-8 w-36 mt-5 mx-auto " name="addproduct" type="submit" value="Add Product">
            </form>
               
            </div>
            </div>
       
        </div>
        
            <?php 
                while ($product_row = mysqli_fetch_assoc($product_result)) {
                $product_id = $product_row["id"];
                $product_name = $product_row["nom"];
                $product_image = $product_row["image"];
                $product_price = $product_row["prix"];
                $product_category_id= $product_row["categorie_id"];
           ?>
          
            <div class=" w-64 h-96 shadow-lg  rounded-2xl  border border-green-400    ">
            <form class="text-center" action="AdminProduct.php" method="post">
            <input type="hidden" name="delete_product_id" value="<?php echo $product_id; ?>">
            <button type="submit" class="bg-red-700 rounded-xl mx-auto w-20  cursor-pointer mt-4 text-center">Delete</button>
        </form>

           <img  src="<?php echo "$product_image" ?>" alt="" class=" w-56 h-40 mt-3 rounded-xl mx-auto ">
           <h1 class="font-sans font-semibold text-center  mt-3 "> Name :<?php echo" $product_name" ?></h1>
           <?php
                $category_query = "SELECT * FROM categorie WHERE id = $product_category_id";
                $category_result = mysqli_query($cnc, $category_query);

                if ($category_result) {
                    $category_row = mysqli_fetch_assoc($category_result);
                    $naame_categorie = $category_row["nom"];
                    ?>
                    <h1 class="font-sans pl-4 mt-3"> Category: <span class=" font-mono font-semibold"><?php echo" $naame_categorie" ?></span></h1>
                    <?php
                } else {
                    // Handle the case where the query fails
                    echo "Error retrieving category information.";
                }
                ?>
           
           <p class="font-sans pl-4 "> price :<?php echo " $product_price " ?> DH</p>  
           <p class="bg-green-700 mx-auto w-20 text-center rounded-xl mt-4 cursor-pointer" onclick="open_editing_Popup('<?php echo $product_id; ?>', '<?php echo $product_image; ?>', '<?php echo $product_name; ?>', '<?php echo $product_name; ?>', '<?php echo $product_price; ?>')"> Edit</p>


            </div>
             <?php
             }
             ?>
            
        </div>











        <script>
    // Open the popup

    function open_editing_Popup(id, img, name, category, price) {
    document.getElementById("edit_product_id").value = id;
    document.getElementById("imgProduct").src = img;
    document.getElementById("nameProduct").innerText = name;
    document.getElementById("categoryProduct").innerText = "category: " + category;
    document.getElementById("priceProduct").innerText = "price : " + price;
    document.getElementById("popupEdit").classList.remove("hidden");
}

 
  // Open the popup
  function openPopup() {
    document.getElementById("popupAdd").classList.remove("hidden");
  }

  // Close the popup when clicking outside the popup content
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