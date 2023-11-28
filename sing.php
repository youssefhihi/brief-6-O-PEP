<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>O'PEP</title>
</head>


<body>
   
    <div class=" bg-white rounded-2xl max-w-xl p-10 mx-auto m-80 my-10 shadow-2xl shadow-green-800  ">
    <h1 class="text-center text-4xl font-bold text-green-800 pb-10 "> SING UP </h1>
    <?php
if (isset($_POST["submit"])) {
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["reapeat-password"];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    if (strlen($password) < 2) {
        array_push($errors, "Please use at least 8 characters");
    }
    if ($password !== $repeat_password) {
        array_push($errors, "The password does not match");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo '<div class="bg-red-500 rounded-xl text-white p-2 my-2">' . $error . '</div>';
        }
    } else {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "opep";

        $conn = new mysqli ($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert user data into the database
        $sql = "INSERT INTO utilisateur (nom, prenom, email, password,role_id) VALUES (?, ?, ?, ?,null)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $password_hash);

        

        // Execute the statement
        if ($stmt->execute()) {
            echo "User registered successfully!";
            $id = $conn->insert_id;
            session_start();
            $_SESSION['iduser'] = $id;
        
            header("Location: ./choose.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

    

    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
           <!-- input first name -->
        <input type="text" id="firstname" name="first-name"  placeholder="First Name" required 
        class=" placeholder:text-black placeholder:pl-10  placeholder:font-extralight   w-full h-9 bg-white bg-opacity-20 border text-black rounded-xl border-gray-500 " >
          <!-- input last name -->
        <input type="text" id="lastname" name="last-name"  placeholder="last Name" required 
        class="mt-5 placeholder:text-black placeholder:pl-6  placeholder:font-extralight   w-full h-9 bg-white bg-opacity-20 border text-black rounded-xl border-gray-500 ">
            <!-- input email -->
        <input type="email" id="email" name="email"  placeholder="Email"  required 
        class="mt-5 placeholder:text-black placeholder:pl-6  placeholder:font-extralight   w-full h-9 bg-white bg-opacity-20 border text-black rounded-xl border-gray-500 ">
        <div id="emailErr" class="text-red-600 font-light text-sm"></div>
            <!-- input password -->
        <input type="password" name="password"  placeholder="Password"  required 
        class=" mt-5 placeholder:text-black placeholder:pl-6  placeholder:font-extralight   w-full h-9 bg-white bg-opacity-20 border text-black rounded-xl border-gray-500 ">
             <!-- input repeat password-->
        <input type="password" name="reapeat-password"  placeholder="Reapeat-Password"  required 
        class="mt-5 placeholder:text-black placeholder:pl-6  placeholder:font-extralight   w-full h-9 bg-white bg-opacity-20 border text-black rounded-xl border-gray-500 ">
             <!-- button -->
        <input type="submit" value="Register" name="submit"  required 
        class=" mt-8 ml-10 w-36 h-10 bg-green-800 text-white rounded-md hover:bg-transparent border border-green-400 hover:text-green-800 ease-in-out duration-500">
        <div class="text-blue-400 underline text-right">
        <a href="login.php">Already have an acount</a>
      </div>
        
    </form>
        
</div>

</body>
</html>