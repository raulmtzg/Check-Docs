<?php
	// $token = $_GET['t'];
	// if( $token !== "0"){
	// 	header("location:inicio");
	// }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bienvenidos a Check-Docs</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="views/img/checkdocs-icon.png" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/daterangepicker/daterangepicker.css">
	<!-- SWEET ALERT -->
	<link rel="stylesheet" href="assets/sweetalert/sweetalert.css">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" name="formulario" id="formulario" method="POST">
					<span class="login100-form-title p-b-26">
						Check-Docs
					</span>
					<span class="login100-form-title p-b-25">
						<!-- <i class="zmdi zmdi-font"></i> -->
						<img src="views/img/logo_checkdocs.png" class="img-thumbnail rounded mx-auto d-block" alt="">
					</span>

					<div class="wrap-input100 validate-input" data-validate = "El correo es obligatorio">
						<input class="input100" type="email" name="email_usuario" id="email_usuario" required>
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="El password es obligatorio">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass_usuario" id="pass_usuario" required>
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" id="btnInciarSesion">
								Iniciar Sesión
							</button>
						</div>
					</div>

					<div class="text-center p-t-25">
						<span class="txt1">
							Olvidaste tu contraseña?
						</span>

						<a class="txt2" href="#">
							Recuperar
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>

<!--===============================================================================================-->
	<script src="assets/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->

<!-- SWEET ALERT  -->
<script src="assets/sweetalert/sweetalert.min.js"></script>
	<script src="assets/login/js/main.js"></script>

 <!-- Scripts Propios -->
 <script src="views/js/ingreso.js"></script>
 <!-- <script src="views/js/globals.js"></script> -->


<!--
</body>
</html> -->
