<div id=add_trajet>
  <fieldset>
    <legend>Profil</legend>
      <form action="index.php?uc=profil&action=traitChangeProfil" method="POST">
        <p>
          <a>Nom :</a>
          <input type="text" name="Nom" placeholder="Entrer votre nom" value=<?php echo "$nom"?> />
        </p>
        <p>
          <a>Prenom :</a>
          <input type="text" name="Prenom" placeholder="Entrer votre prenom" value=<?php echo "$prenom"?> />
        </p>
        <p>
          <a>Mail :</a>
          <input type="text" name="Mail" placeholder="Entrer votre email" value= <?php echo "$email" ?> />
        </p>
        <p>
          <a>Ancient mot de passe :</a>
          <input type="password" name="mdpA" placeholder="Entrer ancient votre mot de passe" />
        </p>
        <p>
          <a>nouveau mot de passe :</a>
          <input type="password" name="mdpN" placeholder="Entrer votre nouveau mot de passe" />
        </p>
          <input type="submit" value="modifier" class="button" /> <a href="index.php" >Annuler</a>
        </form>
      </br>
      <a href="index.php?uc=profil&action=deconnexion">déconnexion</a>
    </fieldset>
  <br />
</div>
