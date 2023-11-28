<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>O'PEP</title>
</head>
    <?php
     $cnc = mysqli_connect("localhost", "root", "", "opep");
     $user = "SELECT * FROM utilisateur";
     $user_result = mysqli_query($cnc, $user);



     $sqlCountAdmin = "SELECT COUNT(*) as adminCount FROM utilisateur WHERE role_id = 1";
$resultCountAdmin = mysqli_query($cnc, $sqlCountAdmin);

// Count the number of client users
$sqlCountClient = "SELECT COUNT(*) as clientCount FROM utilisateur WHERE role_id = 2";
$resultCountClient = mysqli_query($cnc, $sqlCountClient);

if ($resultCountAdmin && $resultCountClient) {
    $rowAdmin = mysqli_fetch_assoc($resultCountAdmin);
    $adminCount = $rowAdmin['adminCount'];

    $rowClient = mysqli_fetch_assoc($resultCountClient);
    $clientCount = $rowClient['clientCount'];
} else {
    $adminCount = 0; // Default to 0 if there is an error
    $clientCount = 0; // Default to 0 if there is an error
}

     $users =  $adminCount + $clientCount;
 
            while ($user_row = mysqli_fetch_assoc($user_result)) {
                $user_id = $user_row["id"];
                $name_user = $user_row["nom"];
                $name2_user = $user_row["prenom"];
                $email_user = $user_row["email"];
                $user_role = $user_row["role_id"];
               
                
            }

            $product = "SELECT * FROM plante";
            $product_result = mysqli_query($cnc, $product);
            while ($product_row = mysqli_fetch_assoc($product_result)) {
               $product_id = $product_row["id"];
               
            }


            $current_page = basename($_SERVER['PHP_SELF']);
               
      ?>




<body>


    <div class="hidden md:bg-green-100 md:border-2 md:border-green-900 md:h-20 md:flex md:justify-between">
    <img src="images/logo.png" alt="">
    <ul class="mt-5 flex space-x-5 h-9">

        <li class="pt-1 <?php echo ($current_page == 'pageAdmine.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="pageAdmin.php">Dashboard</a>
        </li>

        <li class="pt-1 <?php echo ($current_page == 'AdminProduct.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="AdminProduct.php">Product</a>
        </li>

        <li class="pt-1 <?php echo ($current_page == 'Users.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="#section3">Users</a>
        </li>

    </ul>
</div>
    <div>
         <h1 class=" mt-5  text-center text-3xl underline font-extralight" >welcome <?php echo" $name_user $name2_user " ?></h1>
        </div>
    <div class=" md:ml-24 ml-14 grid grid-cols-1 md:grid-cols-3 gap-4 place-content-center mt-10 mb-10">
        <div class="  w-72  h-64 shadow-lg  rounded-2xl  border border-green-400 text-green-500 text-center hover:bg-green-500 ease-in-out duration-500 hover:text-white   ">
           
                <h1 class="font-sans font-semibold text-4xl mb-4">Users</h1>
                <img src="images/users.png" alt="" class=" mx-auto mb-5">
                <p class="font-sans font-semibold   text-4xl"> <?php echo " $users" ?></p>   
        </div>
         <div class=" w-72 h-64  shadow-2xl rounded-2xl  border border-green-400 text-green-500 text-center hover:bg-green-500 ease-in-out duration-500 hover:text-white ">
            <h1 class="font-sans font-semibold  text-4xl mb-4">Client</h1>
                <img src="images/client2.png" alt="" class=" mx-auto mb-5 h-32">
                <p class="font-sans font-semibold  text-4xl"> <?php echo " $clientCount " ?></p>  
        </div>
        <div class=" w-72 h-64  shadow-2xl rounded-2xl  border border-green-400 text-green-500 text-center hover:bg-green-500 ease-in-out duration-500 hover:text-white ">
            <h1 class="font-sans font-semibold  text-4xl mb-4">Admin</h1>
                <img src="images/admin2.png" alt="" class=" mx-auto mb-5 h-32">
                <p class="font-sans font-semibold  text-4xl"> <?php echo " $adminCount" ?></p>  
        </div>
        <div class=" w-72 h-64  shadow-2xl rounded-2xl border border-green-400 text-green-500 text-center hover:bg-green-500 ease-in-out duration-500 hover:text-white  ">
         
            <h1 class="font-sans font-semibold  text-4xl mb-4">Products</h1>
                <img src="images/product.png" alt="" class=" mx-auto mb-5">
                <p class="font-sans font-semibold   text-4xl"> <?php echo " $product_id " ?></p>  


        </div>
        <div class=" w-72 h-64  shadow-2xl rounded-2xl  border border-green-400 text-green-500 text-center hover:bg-green-500 ease-in-out duration-500 hover:text-white ">
        <h1 class="font-sans font-semibold  text-4xl mb-4">Category</h1>
                <img src="images/category.png" alt="" class=" mx-auto mb-5 h-32">
                <p class="font-sans font-semibold  text-4xl"> <?php echo " " ?></p>  
        </div>
       
       

    </div>
       
       
    
         
               
        
      
 
</body>
</html>