<?php
$trackId = "6SKwQghsR8AISlxhcwyA9R";

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Spotify Manu y Mónica</title>

	<!-- jQuery, Bootstrap, Font Awesome, AngularJS, Firebase, AngularFire -->
	<script src="https://code.jquery.com/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>
	<script src="https://cdn.firebase.com/js/client/2.2.1/firebase.js"></script>
	<script src="https://cdn.firebase.com/libs/angularfire/1.0.0/angularfire.min.js"></script>
	<link rel="stylesheet" href="static/css/styles.css" />
	<script type="text/javascript" src="static/js/main.js"></script>
	<script type="text/javascript" src="static/js/countdown.js"></script>
	<link rel="icon" href="http://bodamanuymonica.com/static/images/icon.png">
</head>

<body>

	<div ng-app="myApp" ng-controller="mainCtrl">

		<!--Sign up modal for new users-->
		<div class="modal fade" id="signupModal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="signupModalTitle">Sign Up</h4>
					</div>
					<div class="modal-body">
						<form name="signupForm" ng-show="!userId" novalidate>
							<div class="form-group">
								<label for="signupEmail">Email</label>
								<input class="form-control" id="signupEmail" ng-model="email" name="email" type="email" placeholder="Give an email">
								<p class="help-block" ng-show="signupForm.email.$error.email">Not an email!</p>
							</div>
							<div class="form-group">
								<label for="signupPassword">Password</label>
								<input class="form-control" name="password" ng-model="password" id="signupPassword" type="password" placeholder="Give a password">
							</div>
							<button id="signupSubmitButton" ng-click="signUp()" ng-disabled="myForm.$invalid" type="submit" class="btn btn-primary">Sign Up</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="main-navbar">

					<div id="navbarButtonGroup" class="pull-right">
						<ul class="nav navbar-nav">

						<li class="navbar_component"><a href="#queryTrackSection">Buscar una canción</a></li>
							<li class="navbar_component"><a href="#trackListSection">Lista más votada</a></li>
						</ul>
						<!-- <li class="navbar_component"><a href="#trackPlayerSection">Play a track</a></li> -->
                             <!--   <button id="signupButton" class="btn btn-primary" data-toggle="modal" data-target="#signupModal">Sign Up</button>

                                <button id="loginButton" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>

                                <button id="logoutButton" class="btn btn-primary">Log Out</button>
                          -->  </div>

				</div>
			</div>
		</nav>

		<section id="welcomeSection" class="jumbotron container">
			<h1 id="welcomeTitle">Boda M&M</h1>
			<h3 id="welcomeSubtitle">Elige tú la música... para este día tan especial</h3>
		</section>

		<!--Query Tracks-->
		<section id="queryTrackSection" class="jumbotron container">
			<h2>Busca tu cancion preferida</h2>

			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<form id="trackQueryForm" name="queryForm">
						<div class="form-group">
							<!-- <label for="queryInput">Search for a track:</label> -->
							<input id="queryInput" name="trackSearch" ng-model="track" class="form-control" placeholder="Marry you">
						</div>
						<button id="queryButton" ng-disabled="queryForm.trackSearch.$invalid" ng-click="searchTracks()" type="submit" class="btn btn-default">Buscar</button>
					</form>
				</div>
			</div>
		</section>

		<!--Track Query Results-->
		<section ng-show="queryTracks.length>0" id="queryResultsSection" class="jumbotron container">
			<h3>Resultados:</h3>

			<div id="queryResultsList">
				<table class="table">
					<thead>
						<tr>
							<th>Escuchar</th>
							<th>Título</th>
							<th>Artista</th>
					<!--		<th>Duración (s)</th> -->
							<th>Añadir a la lista</th>
						</tr>
					</thead>
					<tbody ng-repeat="track in queryTracks">
						<tr>
							<td title="{{track.name}}">
								<button class="button-fa" id="{{track.id}}" ng-click="preview(track.preview_url, track.id)"><i class="fa fa-play-circle"></i></button>
							</td>
							<td>{{track.name}}</td>
							<td>{{track.artists[0].name}}</td>
							<!-- <td>{{track.duration_ms}}</td> -->
							<td>
								<button ng-click="addTrack(track.id, track.name, track.artists[0].name, track.duration_ms, track.preview_url)" class="addButton btn btn-success">Añadir a la lista</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>

		<!--Track Player-->
		<section ng-show="playlist.length>0" id="trackPlayerSection" class="jumbotron container">
			<div id="previewPlaylistWrapper">
				<iframe src="https://embed.spotify.com/?uri=spotify:track:<?php echo $trackId?>" width="300" height="300" frameborder="0"
				allowtransparency="true"></iframe>
			</div>

		</section>

		<!--Track List-->
		<section ng-show="playlist.length>0" id="trackListSection" class="jumbotron container">
			<h2>Lista más votada</h2>

			<div id="trackPlaylistWrapper">
				<table id="trackPlaylistTable" class="table">
					<thead>
						<tr>
							<th>Escuchar</th>
							<th>Título</th>
							<th>Artista</th>
							<!-- <th>Duration (ms)</th> -->
							<th>Nº de votos</th>
							<th>Votar + 1</th>
						</tr>
					</thead>
					<tbody ng-repeat="track in playlist | orderBy : '-upvotes'">
						<tr class="playlistTrackRow" id="{{track.$id}}" ">
							<td title="{{track.name}} "><button class="previewButton" ng-click="previewPlaylistTrack(track.id)">Escuchar</button></td>
							<td>{{track.name}}</td>
							<td>{{track.artist}}</td>
						<!--	<td>{{track.duration}}</td> -->
							<td class="upvotesColValue">{{track.upvotes}}</td>
							<td><button class="button-fa" ng-click="upvote(track.$id)"><i class="fa fa-chevron-circle-up"></i></button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
		
	</div>

	<footer id="mainFooter" class="jumbotron container">
		<script>
			document.write("Quedan "+days+" días ")
		</script>
	</footer>

</body>

</html>
