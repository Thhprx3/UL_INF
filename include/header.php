        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">
                    <div class="logo">
                        <a href="index.php" class="logo">
                            <img src="assets/images/favicon.ico">
                        </a>
                    </div>
                    <div class="action">
                        <div class="profile">
                            <img src="assets/images/photo2.jpg">
                        </div>
                        <div class="menu">
                            <h3> Someone </h3>
                            <ul>
                                <li><i class="fas fa-user"></i><a href="#">My Profile</a></li>
                                <li><i class="fas fa-cog"></i><a href="#">Settings</a></li>
                                <li><i class="fas fa-question"></i><a href="#">Help</a></li>
                                <li><i class="fas fa-sign-out-alt"></i><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <script>
                $(document).ready(function(){
                // Show hide popover
                    $(".action").click(function(){
                        $(this).find(".menu").slideToggle("fast");
                    });
                });
                $(document).on("click", function(event){
                    var $trigger = $(".action");
                    if($trigger !== event.target && !$trigger.has(event.target).length){
                        $(".menu").slideUp("fast");
                    }            
                });
                </script>
            </div>
        </header>