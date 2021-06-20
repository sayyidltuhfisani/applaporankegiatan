<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V14</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url('libereri/login/'); ?>images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/login/'); ?>vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/login/'); ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/login/'); ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/login/'); ?>vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/login/'); ?>vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/login/'); ?>vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/login/'); ?>vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/login/'); ?>vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/login/'); ?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/login/'); ?>css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w" method="post" name="formUpload">
					<span class="login100-form-title p-b-22">
						Login
					</span>

					
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username" >
						<span class="focus-input100"></span>
					</div>
					

					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" placeholder="password">
						<span class="focus-input100"></span>
					</div>

					<span class="login100-form-title p-b-22">
						<img id="img_captha" onclick="document.getElementById('img_captha').src= '<?= base_url('front/keycode/?');  ?>'+ Math.random();" src="<?= base_url('front/keycode');  ?>" width="auto" height="auto" style="margin-top:10px;cursor: pointer;" >
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						
						<input class="input100" type="number" name="captcha" placeholder="Masukan kode captcha di atas">
						<span class="focus-input100"></span>
					</div>
					


					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	<!--===============================================================================================-->
	<script src="<?= base_url('libereri/login/'); ?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('libereri/login/'); ?>vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('libereri/login/'); ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url('libereri/login/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('libereri/login/'); ?>vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('libereri/login/'); ?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url('libereri/login/'); ?>vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url('libereri/login/'); ?>vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<!-- <script src="<?= base_url('libereri/login/'); ?>js/main.js"></script> -->

	<link rel="stylesheet" type="text/css" href="<?= base_url('libereri/tambahan/')?>sweetalert2/sweetalert2.min.css">
	<script src="<?= base_url('libereri/tambahan/')?>sweetalert2/sweetalert2.min.js"></script>
	<style type="text/css">
	.swal-wide{
		width:450px !important;
		font-size:14px;
		/*height: 40px !important;*/
	}
</style>

<script type="text/javascript">

	function showValidate(input) {
		var thisAlert = $(input).parent();

		$(thisAlert).addClass('alert-validate');
	}

	function hideValidate(input) {
		var thisAlert = $(input).parent();

		$(thisAlert).removeClass('alert-validate');
	}

	function validate (input) {
		if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
			if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
				return false;
			}
		}
		else {
			if($(input).val().trim() == ''){
				return false;
			}
		}
	}





	$(document).ready(function(){

		var input = $('.validate-input .input100');
		var k=0;
		var showPass = 0;
		
		$('.btn-show-pass').on('click', function(){
			if(showPass == 0) {
				$(this).next('input').attr('type','text');
				$(this).find('i').removeClass('fa-eye');
				$(this).find('i').addClass('fa-eye-slash');
				showPass = 1;
			}
			else {
				$(this).next('input').attr('type','password');
				$(this).find('i').removeClass('fa-eye-slash');
				$(this).find('i').addClass('fa-eye');
				showPass = 0;
			}

		});

		$('.validate-form .input100').each(function(){
			$(this).focus(function(){
				hideValidate(this);
			});
		});

		$('form[name="formUpload"]').submit(function(e){
			e.preventDefault();

			for(var i=0; i<input.length; i++) {
				if(validate(input[i]) == false){
					showValidate(input[i]);
				}
				else{
					k++;
				}
			}

			if (k == i) {
				

				var formData = new FormData(this);

				$.ajax({
					"type"   : "post",
					"url"    : "<?= base_url('proseslogin'); ?>",
					"data"   : formData,
					"cache": false,
					"contentType": false,
					"processData": false,
					"dataType" : "json",                
					success:function(data){                
						if(data.status == 'berhasil')
						{  
							Swal.fire({
								position: 'top-end',
								type: 'success',
								title: data.keterangan,
								showConfirmButton: false,
								customClass: 'swal-wide',
								timer: 1500,

							}).then((result) => {
								window.location.href = "<?= base_url('home'); ?>";
							})

						}
						else if (data.status == 'gagal') 
						{
							Swal.fire({

								type: 'error',
								title: data.keterangan,
								showConfirmButton: false,
								timer: 1500,
								text : data.jumlah 

							}).then((result) => {
									// location.reload();
								})

						}
					},error:function(data) {
						alert(data.Message);
					}

				});



			}//penutup if (k==i)


		});


	});
</script>
</body>
</html>