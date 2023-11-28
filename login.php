<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
     session_start();
     $idUser = $_SESSION['iduser'];
     $role =$_SESSION['role'] ;
    if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
    
        // Database connection
        $servername = "localhost";
        $username = "root";
        $dbpassword = "";
        $dbname = "opep";
    
        $conn = new mysqli($servername, $username, $dbpassword, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Retrieve user data from the database
        $sql = "SELECT * FROM utilisateur WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row["password"];

    
            // Verify the password
            if (password_verify($password, $stored_password)) {
                // Redirect based on user role
                if ($row["role_id"] == 1) {

                    header("Location: pageAdmine.php");
                } elseif ($row["role_id"] == 2) {
                    $_SESSION['idclient']=$row['id'];
                  header("Location: products.php");
                } else {
                    echo "Invalid role";
                }
                exit(); 
            } else {
                echo '<div class="bg-red-500 rounded-xl text-white p-2 my-2">Incorrect password</div>';
            }
        } else {
            echo '<div class="bg-red-500 rounded-xl text-white p-2 my-2">User not found</div>';
        }
    
        $stmt->close();
        $conn->close();
    }
    ?>
<div class=" bg-white rounded-2xl max-w-xl p-10 mx-auto m-80 my-10 shadow-2xl shadow-green-800  ">
    <h1 class="text-center text-4xl font-bold text-green-800 pb-10 "> LOGIN </h1>
    
<form  action="login.php" method="post">
          <!-- input email -->
        <input type="email" id="email" name="email"  placeholder="Email"  required 
        class="mt-5 placeholder:text-black placeholder:pl-6  placeholder:font-extralight   w-full h-9 bg-white bg-opacity-20 border text-black rounded-xl border-gray-500 ">
            <!-- input password -->
        <input type="password" name="password"  placeholder="Password"  required 
        class=" mt-5 placeholder:text-black placeholder:pl-6  placeholder:font-extralight   w-full h-9 bg-white bg-opacity-20 border text-black rounded-xl border-gray-500 ">
            <!-- button -->
        <input type="submit" value="login" name="submit"  required 
        class=" mt-8 ml-10 w-36 h-10 bg-green-800 text-white rounded-md hover:bg-transparent border border-green-400 hover:text-green-800 ease-in-out duration-500">
        <div class="text-blue-400 underline text-right">
        <a href="sing.php">don't  have an account</a>
        
    </form>
        
</div>
</body>
</html>