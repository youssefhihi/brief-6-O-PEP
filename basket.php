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

// Check connection
if (!$cnc) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
$idclient = $_SESSION['idclient'];

if (isset($_POST["delete_panier_id"])) {
    $deletepanierId = $_POST["delete_panier_id"];
    $delete = $cnc->prepare("DELETE FROM panier WHERE id = ?");
    $delete->bind_param("i", $deletepanierId);
    if ($delete->execute()) {
        // Success
    } else {
        echo "Error deleting: " . $delete->error;
    }
}

if (isset($_POST["checkout"])) {
    $moveQuery = "INSERT INTO commande (utilisateur_id, plante_id) 
                  SELECT id_utilisateur, id_plante
                  FROM panier WHERE id_utilisateur = ?";
    $moveStmt = $cnc->prepare($moveQuery);
    $moveStmt->bind_param("i", $idclient);
    if ($moveStmt->execute()) {
        // Success
        $deleteQuery = "DELETE FROM panier WHERE id_utilisateur = $idclient";
        if (mysqli_query($cnc, $deleteQuery)) {
            
            header("Location: thanks.php");
            exit();
        } else {
            echo "Error deleting items from panier: " . mysqli_error($cnc);
        }
    } else {
        echo "Error moving items to commande: " . $moveStmt->error;
    }

  
    $moveStmt->close();
}
?>

<body>
    <div class="flex justify-between">
         <h1 class="text-3xl font-semibold mb-6 ">Shopping Cart</h1>
        <a class="bg-green-400 border border-green-500 w-20 text-center rounded-2xl text-white pt-1  mt-5 mr-14 " href="products.php"> return </a>
     </div>
     <form action="basket.php" method="post" >
        <button type="submit" name="checkout" class=" bg-white border mb-7 border-green-700 text-xl w-96 h-12 ml-96  text-green-500 rounded-md mt-10 hover:bg-green-600 hover:text-white">Checkout</button>
    </form>


    <?php
    // Assuming $idclient is available on this page
    $cart_query = "SELECT plante.*, panier.id as idPanier FROM panier JOIN plante ON panier.id_plante = plante.id WHERE panier.id_utilisateur = $idclient;";
    $cart_result = mysqli_query($cnc, $cart_query);

    if (mysqli_num_rows($cart_result) > 0) {
        while ($cart_row = mysqli_fetch_assoc($cart_result)) {
            ?>
            <div class="bg-white flex flex-col ml-4 p-4 mb-4 rounded-md shadow-md max-w-xl mx-auto">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="<?php echo $cart_row['image']; ?>" alt="<?php echo $cart_row['nom']; ?>" class="w-16 h-16 object-cover rounded-md">
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold"><?php echo $cart_row['nom']; ?></h2>
                        </div>
                    </div>
                    <p class="text-xl font-semibold"><?php echo $cart_row['prix']; ?> DH</p>
                    <form class="text-center" method="post">
                        <button name="delete_panier_id" value="<?php echo $cart_row['idPanier']; ?>" class="bg-red-700 rounded-xl mx-auto w-20  mt-4 text-center">Delete</button>
                    </form>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <p class="text-gray-600">Your shopping cart is empty.</p>
        <?php
    }
    ?>

    
    </div>
</body>
</html>
