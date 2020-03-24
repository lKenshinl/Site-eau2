<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">

	<title>Left Sidebar template - Progressus Bootstrap template</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">

	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.php"><img class="logo" src="assets/images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Nos produits <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li class="active"><a href="sidebar-left.php">Best seller</a></li>
							<li><a href="sidebar-right.php">Nos packs</a></li>
						</ul>
					</li>
					<li><a href="contact.php">Contact</a></li>
					<?php
					session_start();
					require_once('fonctionpannier.php');
					try
					{
						$bdd = new PDO('mysql:host=localhost;dbname=site_eau;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
							die('Erreur : '.$e->getMessage());
					}
					if (isset($_SESSION['numc']) AND isset($_SESSION['email']))
                        {
                        ?>
                        <a class="btn btn-success btn-sm ml-3" href="cart.php">
                        <i class="fa fa-shopping-cart"></i> Cart<span class="badge badge-light">3</span></a>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon compte <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="deconnexion.php">Deconnexion</a></li>
                          <li><a href="">Mon compte</a></li>
                        </ul>
                        <?php }
                        else
                        {
                        ?>
                    <li><a class="btn" href="signin.php">SIGN IN / SIGN UP</a></li>
                        <?php } ?>

				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Left Sidebar</li>
		</ol>


			<!-- Sidebar -->
			<aside class="sidebar sidebar-left">

				<div class="row widget">
					<div class="col-xs-12">
						<h4> <u>Les best seller:</u></h4>
						<p>Ici vous pouvez retrouver les articles qui pour nous sont un l'incontournable des tables et qui peuvent être consommé tous les jours a un prix raisonable.</p>
					</div>
                </div>
                <?php
                $resultat=$bdd->query("SELECT * FROM produit Where type_produit='simple'");

                ?>
                        <?php
						$i=0;
                        foreach($resultat as $infoproduit)
                        {
                            if (isset($_SESSION['numc']) AND isset($_SESSION['email']))
                                    {
										$i++;
                        ?>
                        <div class="row">
							<div class="col-sm-6">
								<h4><?= $infoproduit['nompro'] ?></h4>
								<img src=<?= $infoproduit['image'] ?> alt="Erreur de chargement de l'image">
								<p class="centre"> <u>Prix:</u> <?= $infoproduit['prix'] ?> €</p>
							<form method='post' action='testpanier.php'>
							<?php 
							if(isset($_POST['produit'.$i]))
										{
											$qte=1;
											$numcommande=1;
											$insertprd = $bdd->prepare("INSERT INTO possede(numerocommande, numpro, quantite) VALUES(?, ?, ?)");
                          					$insertprd->execute(array($numcommande, $infoproduit['numpro'], $qte));
										}
								?>
							<button class="btn btn-action" type="submit" value="Ajouter au panier" name="<?='produit'.$i?>">Ajouter au panier</button>
							</form>
							</div>
							<div class="col-sm-6">
								<header class="page-header">
									<h1 class="page-title-best">Découvrez l’eau <?= $infoproduit['nompro'] ?></h1>
								</header>
								<?= $infoproduit['descriptif'] ?>
							</div>
						</div>

            <?php                   }
                        } ?>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->


	<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">

					<div class="col-md-3 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">
							<p>06.03.17.95.87<br>
								<a href="mailto:#">contact.service.lh2o@gmail.com</a><br>
								<br>
								5 impasse des 2 cousin, Paris, 75017
							</p>
						</div>
					</div>

					<div class="col-md-3 widget">
						<h3 class="widget-title">Follow me</h3>
						<div class="widget-body">
							<p class="follow-me-icons">
								<a href="https://twitter.com/LoParisVie"><i class="fa fa-twitter fa-2"></i></a>
								<a href="https://www.instagram.com/loparis75/"><i class="fa fa-instagram fa-2"></i></a>
							</p>
						</div>
					</div>


				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="#">Home</a> |
								<a href="about.php">About</a> |
								<a href="sidebar-right.php">Sidebar</a> |
								<a href="contact.php">Contact</a> |
								<b><a href="signup.php">Sign up</a></b>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
							L'équipe vous souhaite une bonne journée.
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>
	</footer>





	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>
