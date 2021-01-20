<?php
    include('include/head.php');
    include('include/css.php');

session_start();
if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
    header("location: index.php");
    exit;
}

require_once "include/config.php";

$username = $password = "";
$username_error = $password_error = "";

if($_SERVER["REQUEST_METHOD"] == ["POST"]){


}



?>

    <body>
        <!-- Main BOX -->
        <div class="body-page">
            <!-- Begin page -->
            <div class="box">
                <!-- Image BOX 
                <div class="img-logo">
                    <img src="assets/images/tree.jpg" alt="img-logo" height="100">
                </div> -->
                <!-- Form BOX -->
                <div class="card-body">
                <!-- Text -->
                    <h3 class="text-center font-30 mt-20 mb-20">USER LOGIN</h3>
                    <!-- Input Form -->
                    <div class="p-3">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method ="POST">
                            <div class="form-horizontal mt-30 <?php echo (!empty($username_error)) ? 'has-error' : ''; ?>">
                                <!-- Username -->
                                <div class="form-group">
                                    <label for="username"><i class="fas fa-user"></i> Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter username">
                                    <span class="help-block"><?php echo $username_error; ?></span>
                                </div>
                                <!-- Password -->
                                <div class="form-group <?php echo (!empty($password_error)) ? 'has-error' : ''; ?>">
                                    <label for="password"><i class="fas fa-unlock-alt"></i> Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                                    <span class="help-block"><?php echo $password_error; ?></span>
                                </div>
                                <!-- Remember/Forgot -->
                                <div class="form-group row mt-20">
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <a href="" class="text-white n-dec">Forgot password ?</a>
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
        </div>
    </body>
</html>