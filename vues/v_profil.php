<h2>Profil</h2>
<div id=container-contact-text>
  <form action="index.php?uc=profil&action=traitChangeProfil" method="POST">
  <a>Nom :</a></br>
  <input type="text" name="Nom" placeholder="Entrer votre nom" value=<?php echo "$nom"?> /></br>
  <a>Prenom :</a></br>
  <input type="text" name="Prenom" placeholder="Entrer votre prenom" value=<?php echo "$prenom"?> /></br>
  <a>Mail :</a></br>
  <input type="text" name="Mail" placeholder="Entrer votre email" value= <?php echo "$email" ?> /></br>
  <a>Ancient mot de passe :</a></br>
  <input type="password" name="mdpA" placeholder="Entrer ancient votre mot de passe" /></br>
  <a>nouveau mot de passe :</a></br>
  <input type="password" name="mdpN" placeholder="Entrer votre nouveau mot de passe" /></br>
  <input type="submit" value="modifier" class="button" /> <a href="index.php" >Annuler</a>
  </form></br>
  <a href="index.php?uc=profil&action=deconnexion">déconnexion</a>
</div>
