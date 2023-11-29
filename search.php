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
if (!$cnc) {
    die("Connection failed: " . mysqli_connect_error());
}


$searchResult = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {

    $searchTerm = $_POST['search'];
   

  
    $searchQuery = "SELECT * FROM plante WHERE nom LIKE '%$searchTerm%'";
    $searchResult = mysqli_query($cnc, $searchQuery);

    if (!$searchResult) {
        echo "Error in search query: " . mysqli_error($cnc);
    }
    
}
?>


<body>

<div class="md:ml-24 mr-14 grid grid-cols-1 md:grid-cols-2 gap-4 place-content-center mt-10 mb-10">
         
    <?php
    if ($searchResult) {
        while ($plant = mysqli_fetch_assoc($searchResult)) {
            ?>
            <div class="w-64 h-80 shadow-lg rounded-2xl border border-green-400">
            <p class="font-mono text-center mt-3" ><?php echo $plant['nom']; ?> </p>
            <p><img class="w-56 h-40 mt-3 rounded-xl mx-auto" src="<?php echo $plant['image']; ?>" alt="<?php echo $plant['nom']; ?>"></p>
            <p class="font-sans pl-4" > prix: <?php echo $plant['prix']; ?> DH</p>
            <hr>
        </div>
            <?php
        }
    } else {
        
        echo "No matching plants found.";
    }
    ?>
   
</div>
 <button class="bg-white border w-80 h-10 border-green-500  text-center rounded-2xl  text-green-500  hover:bg-green-600  hover:text-white ml-96 ">   <a href="products.php"> return </a></button>

</body>
</html>
