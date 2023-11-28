<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">   
    <title>O'PEP</title>
</head>

<body>
    <?php
        session_start();
        $idUser = $_SESSION['iduser'];
       
        if (isset($_POST["submit"])) {
        $role = $_POST["role"];
  
         
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "opep";
        $conn = new mysqli ($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

 

      
        // Insert user data into the database
        $sql = "update utilisateur set role_id = ? where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $role,$idUser);

        

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: login.php");
        } else {
            echo "Error ";
        }

        $stmt->close();
        $conn->close();
        
    }

 ?>

    <div class=" bg-white rounded-2xl max-w-xl p-10 mx-auto m-80 my-24 shadow-2xl shadow-green-800 flax flax-col  ">
        <label for="role" class="text-2xl font-semibold">Choose what you want to be with us:</label>
        <form action="choose.php" method="post">
            <div class="flex space-x-5 mt-20  ">
            <img src="images/client.png" alt="">
            <label for="client" class="mt-3">Client</label>
            <input type="radio" id="client" name="role" value="2" required>
            </div>
            <div class="flex space-x-5 mt-5">
            <img src="images/admin.png" alt="">
            <label for="admin" class="mt-3">Admin</label>
            <input type="radio" id="admin" name="role" value="1" required>
            </div>  
            <input type="submit" value="go" name="submit"  required 
            class=" mt-10 ml-28 w-28 h-10 bg-green-800 text-white rounded-md hover:bg-transparent border border-green-400 hover:text-green-800 ease-in-out duration-500">  
        </form>
    
    </div>
</body>
</html>