<?php
session_start();

$hasLogin = isset($_SESSION['user_id']);
if ($hasLogin){
	$userID = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];
	$isAdmin = $_SESSION['is_admin'];
}
else 
{
	$isAdmin = false;
}

if (isset($_REQUEST['action'])) {
	$action = $_REQUEST['action'];
}
else {
	$action = 'home';
}

include_once("connect.php");

echo'
<!DOCTYPE html>
<html>
<!-- Head -->
<head>
	<title>Votações</title>
	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Associate a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Meta-Tags -->
	<!-- Custom-Theme-Files -->
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/font-awesome.min.css" />

	<!-- //Custom-Theme-Files -->
	<!-- Web-Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" 	type="text/css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700" 				type="text/css">
	<!-- //Web-Fonts -->
	<!-- Default-JavaScript-File -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</head>
<!-- //Head -->
<!-- Body -->
<body>

	
<div class="modal fade" tabindex="-1" role="dialog" id="loginModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Entrar</h4>
      </div>
      <div class="modal-body">
		 <div class="form-group">
		  <label for="email">Email:</label>
		  <input type="text" class="form-control" id="email">
		</div>
		<div class="form-group">
		  <label for="password">Password:</label>
		  <input type="password" class="form-control" id="password">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="loginButton">Entrar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="signupModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar</h4>
      </div>
      <div class="modal-body">
		 <div class="form-group">
		  <label for="signup_email">Email:</label>
		  <input type="text" class="form-control" id="signup_email">
		</div>
		<div class="form-group">
		  <label for="signup_password">Password:</label>
		  <input type="password" class="form-control" id="signup_password">
		</div>
		 <div class="form-group">
		  <label for="signup_name">Nome:</label>
		  <input type="text" class="form-control" id="signup_name">
		</div>
		 <div class="form-group">
		  <label for="signup_phone">Telefone:</label>
		  <input type="text" class="form-control" id="signup_phone">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="signupButton">Registrar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="editUserModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Utilizador</h4>
      </div>
      <div class="modal-body">
			<input type="hidden" id="user_id" value="0">
		 <div class="form-group">
		  <label for="user_email">Email:</label>
		  <input type="text" class="form-control" id="user_email">
		</div>
		<div class="form-group">
		  <label for="user_password">Password:</label>
		  <input type="password" class="form-control" id="user_password">
		</div>
		 <div class="form-group">
		  <label for="user_name">Nome:</label>
		  <input type="text" class="form-control" id="user_name">
		</div>
		 <div class="form-group">
		  <label for="user_phone">Telefone:</label>
		  <input type="text" class="form-control" id="user_phone">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="userSaveButton">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="editCategoryModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Categoria</h4>
      </div>
      <div class="modal-body">
			<input type="hidden" id="cat_id" value="0">
		 <div class="form-group">
		  <label for="cat_desc">Descrição:</label>
		  <input type="text" class="form-control" id="cat_desc">
		</div>
		<div class="form-group">
		  <label for="cat_prize">Prémio:</label>
		  <input type="text" class="form-control" id="cat_prize">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="categorySaveButton">Guardar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="newCatModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Criar Categoria</h4>
      </div>
      <div class="modal-body">
		 <div class="form-group">
		  <label for="newcat_desc">Descrição:</label>
		  <input type="text" class="form-control" id="newcat_desc">
		</div>
		<div class="form-group">
		  <label for="newcat_prize">Prémio:</label>
		  <input type="text" class="form-control" id="newcat_prize">
		</div>
		 <div class="form-group">
		  <label for="newcat_dur">Duração (dias):</label>
		  <input type="text" class="form-control" id="newcat_dur">
		</div>
		 <div class="form-group">
				<label for="newcat_cands">Candidatos (1 por linha):</label>
			  <textarea class="form-control" rows="6" id="newcat_cands"></textarea>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="catButton">Criar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

	<!-- Header -->
	<!-- banner -->
	<div class="w3l-banner1">
		<div class="header">
		<!-- Top-Bar -->
				<div class="top-bar">
				<div class="container">
					<div class="header-nav">
						<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<h1><a class="navbar-brand" href="index.php">Votações</a></h1>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav ">';
									if (!$hasLogin) {
										echo '
											<li><a href="#" data-toggle="modal" data-target="#loginModal">Entrar</a></li>
											<li><a href="#" data-toggle="modal" data-target="#signupModal">Registrar</a></li>
											';
									} else
									{
										
echo'									
									<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Fichas<b class="caret"></b></a>
									<ul class="dropdown-menu agile_short_dropdown">';
									
									if ($isAdmin) {echo									'
										<li><a href="index.php?action=users">Utilizadores</a></li>';
									}
										echo '
										<li><a href="index.php?action=categories">Categorias</a></li>
										<li><a href="index.php?&action=candidates">Candidatos</a></li>
										<li><a href="index.php?action=votes">Votos</a></li>
									</ul>
										</li>
										<li><a href="logout.php">Sair</a></li>';
									}
									
echo'									
								</ul>
							</div>
							<!-- /navbar-collapse -->

						</nav>
						';
						
						
						if ($hasLogin) {
							//echo '<div class="cd-main-header">Olá '.$user_name.'</div>';
						}
						
						echo '
					</div>
				</div>
			</div>
		<!-- //Top-Bar -->
	</div>
	<!-- //Header -->
	
	</div>
	<!-- //banner -->
	<!-- services -->
	<div class="agileits-ser">
		<div class="container">		
		';
		
		include_once $action.'.php';
		
		echo '
		</div></div>
	</div>
	<!-- //services -->
	
	<!-- footer -->
	<div class="footer-top">
		<div class="container">
			
			<div class="col-md-9 wthree-footer-top">
				<h3>Regulamento</h3>
					<p>Votação é um processo de decisão no qual os votantes expressam a sua opinião por meio de um voto de maneira predeterminada. Os votos são processados e a decisão é tomada segundo alguma regra particular.</p>
					<p>A maneira mais comum de votação é aquela na qual há um conjunto com um número inteiro de opções e cada eleitor escolhe uma delas, ou seja, cada um vota na sua opção candidata preferida. A opção vencedora é a que receber mais votos.</p>
			</div>
				<div class="clearfix"></div>
			
		</div>
	</div>
	<div class="footer-w3layouts">
		<div class="container">
				<div class="agile-copy">
					<p>© 2016 Votações. All rights reserved</p>
				</div>
				<div class="agileits-social">
					<ul>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-rss"></i></a></li>
							<li><a href="#"><i class="fa fa-vk"></i></a></li>
						</ul>
				</div>
					<div class="clearfix"></div>
			</div>
	</div>
	<!-- //footer -->
	
<script>
$("#loginButton").on("click", function (e) {
	var email = $("#email").val();
	var pass = $("#password").val();
	$.getJSON( "login.php?email="+email+"&pass="+pass, function( data ) {		
		if (data.user_id) {			
			location.reload(); 
		}
		else
		{
			alert("Login invalido!");
		}
	});
});  

$("#signupButton").on("click", function (e) {
	var email = $("#signup_email").val();
	var pass = $("#signup_password").val();
	var name = $("#signup_name").val();
	var phone = $("#signup_phone").val();
	$.getJSON( "signup.php?email="+email+"&pass="+pass+"&name="+name+"&phone="+phone, function( data ) {		
		if (data.user_id) {			
			location.reload(); 
		}
		else
		{
			alert("Falha no registo!");
		}
	});
});  

$("#catButton").on("click", function (e) {
	var desc = $("#newcat_desc").val();	
	var prize = $("#newcat_prize").val();
	var dur = $("#newcat_dur").val();
	var cands = $("#newcat_cands").val();
	
	cands =  cands.replace(/(?:\r\n|\r|\n)/g, "|");
	
	if (cands.split("|").length<2) {
		alert("Necesissta 2 candidatos ou mais");
		return;
	}		
	
	$.getJSON( "cat_new.php?desc="+desc+"&prize="+prize+"&duration="+dur+"&cands="+cands, function( data ) {		
		if (data.cat_id) {			
			location.reload(); 
		}
		else
		{
			alert("Falha na criacao! "+data.error);
		}
	});
});  

function deleteCategory(id) {	
	$.post( "cat_del.php?id="+id, function( data ) {
	  location.reload(); 	
	});		
}

$("#categorySaveButton").on("click", function (e) {
	var desc = $("#cat_desc").val();
	var prize = $("#cat_prize").val();
	var id = $("#cat_id").val();

	$.post( "cat_edit.php?id="+id+"&desc="+desc+"&prize="+prize, function( data ) {		
			location.reload(); 
	});
});  

function editCategory(id, desc, prize) {	
	$("#cat_id").val(id);
	$("#cat_desc").val(desc);
	$("#cat_prize").val(prize);
	$("#editCategoryModal").modal("show");
}

function deleteUser(id) {	
	$.post( "user_del.php?id="+id, function( data ) {
	  location.reload(); 	
	});		
}

$("#userSaveButton").on("click", function (e) {
	var email = $("#user_email").val();
	var name = $("#user_name").val();
	var pass = $("#user_password").val();
	var phone = $("#user_phone").val();
	var id = $("#user_id").val();

	$.post( "user_edit.php?id="+id+"&email="+email+"&name="+name+"&pass="+pass+"&phone="+phone, function( data ) {		
			location.reload(); 
	});
});  

function editUser(id, email, password, name, phone) {	
	$("#user_id").val(id);
	$("#user_email").val(email);
	$("#user_name").val(name);
	$("#user_password").val(password);
	$("#user_phone").val(phone);
	$("#editUserModal").modal("show");
}

function submitVote(id, candCount)
{
	var i =0 ;
	for (i = 0;i<candCount; i++) {		
		var temp = "candidate_"+id+"_"+i;
		var element = document.getElementById(temp);
		if (element && element.checked) {
			var candidate  = document.getElementById("vote_"+id+"_"+i);
			//alert("voted in "+candidate.value);
				$.getJSON( "vote.php?id="+id+"&candidate="+candidate.value, function( data ) {		
					alert("Obrigado pelo seu voto");
					location.reload(); 
					//$("#poll_"+id ).hide();
				});
			
			return;
		}
	}
	
	alert("Selecione um candidato!");
}

</script>
	
</body>
<!-- //Body -->
</html>
';

?>