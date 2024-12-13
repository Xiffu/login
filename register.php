<?php
// Include config file
require_once "config.php";
require "vendor/autoload.php";

// Cargar las variables del archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese un usuario.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Este usuario ya fue tomado.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Por favor ingrese un correo electrónico.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Este correo electrónico ya está registrado.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingresa una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma tu contraseña.";     
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "No coincide la contraseña.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password, verification_token) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_email, $param_password, $param_verification_token);

            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_verification_token = bin2hex(random_bytes(50)); // Generate a random token

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                // Send verification email
                $to = $email;
                $subject = "Verificación de correo electrónico";
                $message = "Haga clic en el siguiente enlace para verificar su correo electrónico: ";
                $message .= "http://localhost/login/verify.php?token=" . $param_verification_token;
                $headers = "From: " . $_ENV['GMAIL_USERNAME'];

                // Configurar PHPMailer
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';  // Servidor SMTP de Gmail
                    $mail->SMTPAuth = true;
                    $mail->Username = $_ENV['GMAIL_USERNAME'];  // Tu correo desde .env
                    $mail->Password = $_ENV['GMAIL_PASSWORD'];  // Tu contraseña de aplicación desde .env
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Configuración del remitente y destinatarios
                    $mail->setFrom($_ENV['GMAIL_USERNAME'], 'UnDodungeonMaster');
                    $mail->addAddress($email, $username);
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body    = $message;
                    $mail->AltBody = strip_tags($message);

                    // Enviar el correo
                    $mail->send();
                    echo 'El mensaje ha sido enviado correctamente.';

                    // Redirect to success page
                    header("location: registration_success.php");

                } catch (Exception $e) {
                    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
                }

            } else{
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="css/DndLogin.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Registro</h2>
        <p>Por favor complete este formulario para crear una cuenta.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar Contraseña</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Registrar">
                <input type="reset" class="btn btn-default" value="Borrar">
            </div>
            <p>¿Ya tienes una cuenta? <a href="login.php">Ingresa aquí</a>.</p>
        </form>
    </div>    
</body>
</html>
