<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username_email = $password = "";
$username_email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username/email is empty
    if(empty(trim($_POST["username_email"]))){
        $username_email_err = "Por favor ingrese su usuario o correo electrónico.";
    } else{
        $username_email = trim($_POST["username_email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, email_verified FROM users WHERE username = ? OR email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username_email, $param_username_email);
            
            // Set parameters
            $param_username_email = $username_email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username/email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $email_verified);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Check if email is verified
                            if($email_verified){
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;                            
                                
                                // Redirect user to welcome page
                                header("location: welcome.php");
                            } else {
                                $login_err = "Por favor, verifique su correo electrónico antes de iniciar sesión.";
                            }
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Usuario/correo electrónico o contraseña inválidos.";
                        }
                    }
                } else{
                    // Username/email doesn't exist, display a generic error message
                    $login_err = "Usuario/correo electrónico o contraseña inválidos.";
                }
            } else{
                echo "Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="css/DndLogin.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Inicio de sesión</h2>
        <p>Por favor, complete sus credenciales para iniciar sesión.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_email_err)) ? 'has-error' : ''; ?>">
                <label>Usuario o Correo Electrónico</label>
                <input type="text" name="username_email" class="form-control" value="<?php echo $username_email; ?>">
                <span class="help-block"><?php echo $username_email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ingresar">
            </div>
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate ahora</a>.</p>
        </form>
    </div>    
</body>
</html>



