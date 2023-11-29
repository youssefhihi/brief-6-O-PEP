<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>O'PEP</title>
</head>
        <?php
        session_start();
        $idclient=$_SESSION['idclient'];

        $cnc = mysqli_connect("localhost", "root", "", "opep");
             $user = "SELECT * FROM utilisateur ";
            $user_result = mysqli_query($cnc, $user);
           
            $product = "SELECT * FROM plante";
            $product_result = mysqli_query($cnc, $product);
            $categorie = "SELECT * FROM categorie";
            $categorie_result = mysqli_query($cnc, $categorie);

            while ($user_row = mysqli_fetch_assoc($user_result)) {
                $user_id = $user_row["id"];
                $name_user = $user_row["nom"];
                $name2_user = $user_row["prenom"];
                $email_user = $user_row["email"];
                $user_role = $user_row["role_id"];
            }
         
      
           
             if(isset($_POST['basketAdd'])){
                 $product_id = mysqli_real_escape_string($cnc,  $_POST['product_id']);
                  
                $client_id= $idclient;

                
            
                $req_panier = "INSERT INTO panier  (id_plante , id_utilisateur ) VALUES ('$product_id', '$client_id')";  
                $panier = mysqli_query($cnc, $req_panier);
                if($panier){
                   
                    header("location:products.php ");
                    exit;
                }else{
                    echo "error" . mysqli_error($cnc);
                }
         
            }

            $current_page = basename($_SERVER['PHP_SELF']);
           
        ?>
<body>
<div class="hidden md:bg-green-100 md:border-2 md:border-green-900 md:h-20 md:flex md:justify-between">
    <img src="images/logo.png" alt="">
    <ul class="mt-5 flex space-x-5 h-9 mr-3">

        <li class="pt-1 <?php echo ($current_page == 'pageClient.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="pageClient">Home</a>
        </li>

        <li class="pt-1 <?php echo ($current_page == 'products.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="products.php">Our Product</a>
        </li>

        <li class="pt-1 <?php echo ($current_page == 'test.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="test.php">Contact</a>
        </li>
   
      <a class=" w-12 h-12 " href="basket.php"><img src="images/panier.png" alt=""></a>
     </ul>
          
    </div>
  <div class="flex mt-5 md:justify-between flex-col gap-4 ">
         <h1 class=" ml-4   max-w-xl  text-left text-xl underline font-mono font-bold" >welcome <?php echo" $name_user  " ?></h1>
        
    <form method="post" action="search.php" class="flex space-x-3 mr-3 justify-end">
        <input class="border border-black bg-gray-200 rounded-xl" type="text" name="search" id="search" placeholder="search for a plant" required>
        
        <button type="submit" class="bg-black text-white rounded-xl w-14 h-8">search </button>
    </form>
  </div>

 


    <div class="flex mt-5 justify-between ">
    <div class="bg-white border w-56    border-black " >
        <form action="products.php" method="post">
            <div class="h-28 grid grid-cols-1 px-10 py-5 gap-5  items-center  ">
                <h1 class=" font-semibold underline text-2xl ">Categories</h1>
                <button name="product" value="all" class="filter-button  bg-white border rounded-xl border-green-500 text-green-500 h-14 w-28  hover:bg-green-400  ease-in-out duration-300 hover:text-white active:bg-green-400">All</button>

                <?php
                    
                    mysqli_data_seek($categorie_result, 0);
                    $selected_product_id = 'all';

                    while ($categorie_row = mysqli_fetch_assoc($categorie_result)) {
                        $categorie_id = $categorie_row["id"];
                        $name_categoriee = $categorie_row["nom"];
                ?>
                    <button name="product" value="<?php echo  $categorie_id; ?>" class="filter-button bg-white border rounded-xl border-green-500 text-green-500 h-14 w-28 hover:bg-green-400 ease-in-out duration-300 hover:text-white "  ><?php echo  $name_categoriee; ?></button>
                <?php
                    }
                ?>
            </div>
         
    </form>
    </div>
   
    <?php
if (isset($_POST["product"]) && $_POST["product"] != 'all' ) {
     
     $selected_product_id = $_POST["product"];
    $categorie_show_query = "SELECT * FROM plante WHERE categorie_id = $selected_product_id";
    $categorie_show_result = mysqli_query($cnc, $categorie_show_query);
    ?>
    <div class="flex ">
        <div class="md:ml-24 mr-14 grid grid-cols-1 md:grid-cols-3 gap-4 place-content-center mt-10 mb-10">
            <?php
            while ($product_row = mysqli_fetch_assoc($categorie_show_result)) {
                $product_id = $product_row["id"];
                $product_name = $product_row["nom"];
                $product_image = $product_row["image"];
                $product_price = $product_row["prix"];
            ?>
                <div class="w-64 h-80 shadow-lg rounded-2xl border border-green-400">
                    <img  src="<?php echo "$product_image" ?>" alt="" class="w-56 h-40 mt-3 rounded-xl mx-auto">
                    <h1 class="font-mono text-center mt-3"> <?php echo" $product_name" ?></h1>
                    <p class="font-sans pl-4"> Price: <?php echo " $product_price " ?> DH</p>
                    <form action="" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="idclient" value="<?php echo $idclient; ?>">
                <input type="submit" value="Add to basket" name="basketAdd"  class="bg-green-400 ml-16 mt-3 font-mono text-white border border-green-400 rounded-xl w-32 h-8 hover:shadow-2xl hover:bg-white hover:text-green-400 ease-in-out duration-300 ">
           <!--  final-->
            </form>
         </div>
                <?php
            }
      

            ?>
        </div>
    </div>
    <?php
} elseif ($selected_product_id === 'all') {
    ?>
    <div class="md:ml-24  mr-14 grid grid-cols-1 md:grid-cols-3 gap-4 place-content-center mt-10 mb-10">
        <?php
        while ($product_row = mysqli_fetch_assoc($product_result)) {
            $product_id = $product_row["id"];
            $product_name = $product_row["nom"];
            $product_image = $product_row["image"];
            $product_price = $product_row["prix"];
            $product_category_id = $product_row["categorie_id"];
            ?>
            <div class="w-64 h-80 shadow-lg rounded-2xl border border-green-400">
                <img src="<?php echo "$product_image" ?>" alt="" class="w-56 h-36  mt-3 rounded-xl mx-auto">
                <h1 class="font-mono font-bold text-center mt-3"> <?php echo" $product_name" ?></h1>
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

                <p class="font-sans pl-4"> Price: <span class=" font-mono font-semibold"> <?php echo " $product_price " ?> DH</span></p>
                <form action="" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="idclient" value="<?php echo $idclient; ?>">
                <input type="submit" value="Add to basket" name="basketAdd"  class="bg-green-400 ml-16 mt-3 font-mono text-white border border-green-400 rounded-xl w-32 h-8 hover:shadow-2xl hover:bg-white hover:text-green-400 ease-in-out duration-300 ">
           
            </form>
          </div>
            <?php
        }
        ?>
    </div>
   
   
 <?php
}
?>


    </div>
        </div>
            


   
            
    </div>
</div>



</body>
</html>