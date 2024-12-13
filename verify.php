<?php
// Include config file
require_once "config.php";

// Check if token is set
if(isset($_GET["token"])){
    $token = $_GET["token"];
    
    // Prepare a select statement
    $sql = "SELECT * FROM users WHERE verification_token = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_token);
        
        // Set parameters
        $param_token = $token;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Update user as verified
                $update_sql = "UPDATE users SET email_verified = 1, verification_token = NULL WHERE id = ?";
                
                if($update_stmt = mysqli_prepare($link, $update_sql)){
                    mysqli_stmt_bind_param($update_stmt, "i", $param_id);
                    $param_id = $row["id"];
                    
                    if(mysqli_stmt_execute($update_stmt)){
                        echo "Su correo electrónico ha sido verificado. Ahora puede <a href='login.php'>iniciar sesión</a>.";
                    } else {
                        echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
                    }
                    
                    mysqli_stmt_close($update_stmt);
                }
            } else {
                echo "Token de verificación inválido.";
            }
        } else {
            echo "Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
        }
        
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
} else {
    echo "Token de verificación no proporcionado.";
}
?>

