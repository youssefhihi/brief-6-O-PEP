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
            while ($user_row = mysqli_fetch_assoc($user_result)) {
                $user_id = $user_row["id"];
                $name_user = $user_row["nom"];
                $name2_user = $user_row["prenom"];
                $email_user = $user_row["email"];
                $user_role = $user_row["role_id"];
               
                
            }




            $current_page = basename($_SERVER['PHP_SELF']);
        ?>
<body>
<div class="hidden md:bg-green-100 md:border-2 md:border-green-900 md:h-20 md:flex md:justify-between">
    <img src="images/logo.png" alt="">
    <ul class="mt-5 flex space-x-5 h-9">

        <li class="pt-1 <?php echo ($current_page == 'pageClient.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="pageAdmin.php">Home</a>
        </li>

        <li class="pt-1 <?php echo ($current_page == 'gallerie.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="products.php">Our Product</a>
        </li>

        <li class="pt-1 <?php echo ($current_page == 'contact.php') ? 'bg-green-500' : ''; ?> rounded-xl mx-auto border border-green-700 hover:bg-white w-28 hover:text-green-700 ease-in-out duration-300 text-center">
            <a class="font-medium" href="contact.php">Contact</a>
        </li>

    </ul>
    </div>
    <div>
         <h1 class=" mt-5  text-center text-3xl underline font-extralight" >welcome <?php echo" $name_user $name2_user " ?></h1>
    </div>



























    <!-- <div class=" max-w-md   bg-green-600">
    <form class="" action="" method="post">
                <label for="" class="text-white p-3 h1 display-6">filter</label> <br>
                <select class="col-10" name="groupe" class="form-select">
                    <option value="1"></option>
                    <option value="2"></option>
                    <option value="3"></option>
                    <option value="4"></option>
                    <option value="5"></option>
                    <option value="6"></option>
                    <option value="7"></option>
                    <option value="8"></option>
                </select>
                <input type="submit" value="go" name="go">
            </form>

    </div> -->
    
</body>
</html>