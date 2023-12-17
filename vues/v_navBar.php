<header>
    <nav class="navbar">
    <ul class="navbar-nav">
        <a href="index.php?uc=accueil&action=accueilPage" class="icon"><img class="logo" src="images/logo.svg"></a>
            <?php if(empty($_SESSION)){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?uc=planning&action=viewPlanning">Planning</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?uc=connexion&action=connexion">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?uc=connexion&action=inscription">Inscription</a>
                </li>
            <?php }else{ ?>
            <?php if($_SESSION['Id_profil']=="Administrateur"){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?uc=planning&action=viewPlanning">Planning</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?uc=profil&action=viewProfil">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?uc=parc&action=viewParc">Parc</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?uc=chemin&action=chemin">Chemin</a>
                </li>   

                <?php }else{ ?>
                    <li class="nav-item">
                    <a class="nav-link" href="index.php?uc=planning&action=viewPlanning">Planning</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?uc=profil&action=viewProfil">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?uc=Reservation&action=Reservation">Reservation</a>
                </li>   
            <?php } ?>
        <?php } ?>
      	</ul>
    </nav>
</header>