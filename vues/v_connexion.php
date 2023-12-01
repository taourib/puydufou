<div id=connexion>
    <fieldset>
        <legend>Connexion</legend>
        <form action="index.php?uc=connexion&action=traitConnexion" method="POST">


            <label>Email : </label>
            <input type="email" name="mailU" placeholder="Entrer votre Email" /><br />
            <label>Mot de passe : </label>
            <input type="password" name="mdpU" placeholder="Entrer votre mot de passe" /><br />
            <input type="submit" value="Valider" />

        </form>
    </fieldset>
    <br />
</div>


<style>
    #connexion {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    legend {
        font-size: 1.5rem;
    }

    form {
        font-size: 1.4rem;
        text-align: right;
        width: 500px;
    }

    input {
        margin: 2%;
        width: 40%;
    }

    input[type="submit"] {
        transition: background-color 0.3s, color 1.0s;
        width: 21%;
    	margin-right: 11%;

    }

    input[type="submit"]:hover {
        background-color: red;
        color: white;
        /* Change text color on hover, adjust as needed */
    }
</style>