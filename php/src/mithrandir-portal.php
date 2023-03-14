<?php
require_once 'sql/connexion.php';
require_once 'sql/get.php';

session_start(); // Start a PHP session

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify the credentials against the database
    $user = getUsername($username); // Call a function to get the user data from the database

    if ($user && passwordVerify($password, $user['password'])) {
        // Password is correct, store the user's data in the session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin']; // Assuming there's a column in the database that identifies admin users

        // Redirect to the admin panel
        header('Location: admin_managment_panel.php');
        exit();
    } else {
        // Password is incorrect, show an error message
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Admin login</title>
    
    <!-- Move CSS imports to the bottom of the head section -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' crossorigin='anonymous' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'>


    <link rel='stylesheet' href='style/style.css'>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class='containerAdmin'>
        <div class='loginAdmin'>
            <h1 class='boxTitle'>Se connecter</h1>
            <form class='loginFormAdmin' method='POST'>
                <div class="form__group">
                    <input class='inputFormAdmin' type='input' name='username'  placeholder="Nom d'utilisateur" required/>
                    <label for='username' class='labelFormAdmin'>Nom d'utilisateur</label>
                </div>
                <div class="form__group">
                    <input class='inputFormAdmin' type='password' name='password' placeholder="Mot de passe" required/>
                    <label for='password' class='labelFormAdmin'>Mot de passe</label>
                </div>
                <button type='submit' class='btn btnFormAdmin'>Se connecter</button>
            
            </form>
        </div>
    </div>

</body>
</html>