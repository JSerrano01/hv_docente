<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="img/img0.png" style = "height: 3rem" class="d-inline-block align-top" alt="">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <?php if(in_array($_SESSION['role'], ['administrador'])){?>
                
                <li class="nav-item">
                    <!--<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>-->
                    <a class="nav-link" style = "color: #ffffff" href="administrator.php">Administrator</a>
                </li>

            <?php } ?>

            <?php if(in_array($_SESSION['role'], ['administrador','docente','coordinador','reclutador'])){?>
                
                <li class="nav-item">
                    <!--<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>-->
                    <a class="nav-link" style = "color: #ffffff" href="profile.php">Perfil</a>
                </li>

            <?php } if(in_array($_SESSION['role'], ['administrador','coordinador'])){ ?>

                <li class="nav-item">
                    <a class="nav-link" style = "color: #ffffff" href="call.php">Convocatorias</a>
                </li>

            <?php } ?>

            <?php if(in_array($_SESSION['role'], ['administrador','reclutador'])){ ?>

                <li class="nav-item">
                    <a class="nav-link" style = "color: #ffffff" href="recruiter.php">Reclutador</a>
                </li>

            <?php } ?>

                <li class="nav-item">
                    <!-- <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a> -->
                    <a class="nav-link" style = "color: #ffffff" href="changeCredentials.php">Cambiar Credenciales</a>
                </li>
            
                <!--<li class="nav-item">
                    <a class="nav-link" style = "color: #ffffff" href="logout.php">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>-->
            </ul>
            <form class="d-flex" role="search" action="logout.php">
            <!--<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">-->
            <button class="btn btn-success" type="submit">Salir</button>
            </form>
        </div>
    </div>
</nav>