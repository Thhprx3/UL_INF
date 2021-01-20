<?php
    include('include/head.php');
    include('include/css.php');

    // Initialize the session
session_start();
    
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: logout.php");
    exit;
}
    
// Include config file
require_once "include/config.php";
    
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
    
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

    <body>
        <!-- Main BOX -->
        <div class="body-page">
            <!-- Begin page -->
            <div class="box">
                <!-- Image BOX -->
                <div class="img-logo">
                    <img class="login-logo" src="assets/images/tree.jpg" alt="img-logo" height="100">
                </div> 
                <!-- Form BOX -->
                <div class="card-body">
                <!-- Text -->
                    <h3 class="text-center font-30 mt-20">USER LOGIN</h3>
                    <!-- Input Form -->
                    <div class="p-3">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method ="post">
                            <div class="form-horizontal mt-30 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <!-- Username -->
                                <div class="form-group">
                                    <label for="username"><i class="fas fa-user"></i> Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter username">
                                    <span class="help-block"><?php echo $username_err; ?></span>
                                </div>
                                <!-- Password -->
                                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <label for="password"><i class="fas fa-unlock-alt"></i> Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                </div>
                                <!-- Remember/Forgot -->
                                <div class="form-group row mt-20">
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="" class="text-white text-primary">Forgot password ?</a>
                                    </div>
                                </div>
                                <!-- Login -->
                                <div class="form-login mt-10 mb-0">
                                    <button class="btn w-md"  type="submit">Log In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-40 text-center">
                <p class="font-15">Don't have an account ? <a href="register.php" class="text-primary text-purple">Signup Now </a></p>
                <p class="font-15">Created for UL_INF SPI project @2021</p> 
            </div>
        </div>
    </body>
</html>