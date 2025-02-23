 <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img class="align-content" src="/img/logo.png" alt=""></a>
                    <a class="navbar-brand hidden" href="./"><?php echo htmlspecialchars($fullName); ?></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <!-- <button class="search-trigger"><i class="fa fa-search"></i></button> -->
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                                    aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            
                            <img class="user-avatar rounded-circle" src="../assets/img/user2.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="updateProfile.php"><i class="fa fa-user"></i>My Profile</a>
                           

                            <!-- <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span
                                    class="count">13</span></a> -->

                            <!-- <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a> -->

                            <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>