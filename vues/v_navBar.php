<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!--  TITRE ET MENUS -->
<html lang="fr">
<head>
<title>PuyDuFou</title>
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="styles/global.css" rel="stylesheet" type="text/css">
</head>
<body >
 <header>
      <nav class="navbar">
      	<ul class="navbar-nav">
        	<a href="index.php" class="icon"><img class="logo" src="images/logo.svg"></a>
        		<li class="nav-item">
          			<a class="nav-link" href="#"><strong>Planning</strong></a>
        		</li>
        		<li class="nav-item">
          			<a class="nav-link" href="#"><strong>Connexion</strong></a>
        		</li>
        		<li class="nav-item">
          			<a class="nav-link" href="#"><strong>Inscription</strong></a>
        		</li>
      	</ul>
    </nav>
</header>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Open+Sans:wght@300&display=swap');
    *{
        font-family: 'Inter', sans-serif;
        font-family: 'Open Sans', sans-serif;
    }

    body{
        margin: 0;
    }

  .navbar-nav {
    position: fixed;
    z-index: 0;
    top: 0;
    width: 100%;
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #F0F2EF;
    height: 90px;
    border-bottom: 1px solid black;
}
  
.nav-item{
    float: right;
    margin-left: 2%;
    margin-top: 15px;
}

.icon{
    float: left;
    margin-left: 2%;
    margin-top: 6px;
}
  
.logo{
    width: 200px; 
    height: 80px;
    margin-top: 0; 
}

.nav-link {
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    border-radius: 50px;
    background-color: #F0F2EF;
    transition: background-color 0.5s, color 1.0s;
    font-size: medium;
}
body{
  background:var(--second-color);
}
</style>
</html>
