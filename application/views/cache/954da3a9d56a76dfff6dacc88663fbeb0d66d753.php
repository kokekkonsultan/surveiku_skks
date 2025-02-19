<?php 
  $ci = get_instance();
?>

<?php $__env->startSection('style'); ?>
<style>
	body {
  font-family: 'Nunito Sans', sans-serif;
  background-color: #192243; }

p {
  color: #b3b3b3;
  font-weight: 300; }

h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
  font-family: 'Exo 2', sans-serif; }

a {
  -webkit-transition: .3s all ease;
  -o-transition: .3s all ease;
  transition: .3s all ease; }
  a:hover {
    text-decoration: none !important; }

.content {
  padding: 7rem 0; }

h2 {
  font-size: 20px; }

.half, .half .container > .row {
  height: 100vh;
  min-height: 700px; }

@media (max-width: 991.98px) {
  .half .bg {
    height: 200px; } }

.half .contents {
  background: #192243; }

.half .contents, .half .bg {
  width: 50%; }
  @media (max-width: 1199.98px) {
    .half .contents, .half .bg {
      width: 100%; } }
  .half .contents .form-control, .half .bg .form-control {
    border: none;
    -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    height: 54px;
    background: #fff; }
    .half .contents .form-control:active, .half .contents .form-control:focus, .half .bg .form-control:active, .half .bg .form-control:focus {
      outline: none;
      -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1); }

.half .bg {
  background-size: cover;
  background-position: center; }

.half a {
  color: #888;
  text-decoration: underline; }

.half .btn {
  height: 54px;
  padding-left: 30px;
  padding-right: 30px; }

.half .forgot-pass {
  position: relative;
  top: 2px;
  font-size: 14px; }

.control {
  display: block;
  position: relative;
  padding-left: 30px;
  margin-bottom: 15px;
  cursor: pointer;
  font-size: 14px; }
  .control .caption {
    position: relative;
    top: .2rem;
    color: #888; }

.control input {
  position: absolute;
  z-index: -1;
  opacity: 0; }

.control__indicator {
  position: absolute;
  top: 2px;
  left: 0;
  height: 20px;
  width: 20px;
  background: #e6e6e6;
  border-radius: 4px; }

.control--radio .control__indicator {
  border-radius: 50%; }

.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
  background: #ccc; }

.control input:checked ~ .control__indicator {
  background: #42C0F2; }

.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
  background: #6FCFF5; }

.control input:disabled ~ .control__indicator {
  background: #e6e6e6;
  opacity: 0.9;
  pointer-events: none; }

.control__indicator:after {
  font-family: 'icomoon';
  content: '\e5ca';
  position: absolute;
  display: none;
  font-size: 16px;
  -webkit-transition: .3s all ease;
  -o-transition: .3s all ease;
  transition: .3s all ease; }

.control input:checked ~ .control__indicator:after {
  display: block;
  color: #fff; }

.control--checkbox .control__indicator:after {
  top: 50%;
  left: 50%;
  margin-top: -1px;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%); }

.control--checkbox input:disabled ~ .control__indicator:after {
  border-color: #7b7b7b; }

.control--checkbox input:disabled:checked ~ .control__indicator {
  background-color: #7e0cf5;
  opacity: .2; }

label {
  font-family: 'Exo 2', sans-serif;
}
</style>



<style>
.btn-flex {
    /* display: flex; */
    align-items: center;
    justify-content: center;
}
.btn {
    user-select: none;

	font-family: 'Exo 2', sans-serif;
	font-weight: bold;
	border: none;
	color: #FFFFFF;
	border-radius: 15px;
}
button {
    width: 150px;
    height: 50px;
    cursor: pointer;
    border: none;
    border-radius: 25px;
    background-color: #50d8d7;
    background-image: linear-gradient(316deg, #2ADAF4 0%, #7230F2 74%);
    transition: 500ms;
}
button::after {
    width: 143px;
    height: 43px;
    position: absolute;
    /* display: flex; */
    align-items: center;
    justify-content: center;
    /* content: 'SUBMIT'; */
    font-size: 20px;
    color: #eee;
    border-radius: 25px;
    background-color: #222;
    transition: 500ms;
}
button:hover::after {
    font-size: 25px;
    background-color: transparent;
}
button:focus {
    outline: none;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="d-lg-flex half">
		
	<div class="bg order-1 order-md-2" style="background-image: url('<?php echo e(base_url()); ?>assets/img/site/auth/bg_4.jpg');">
		<div class="text-center text-white">
			<h5 class="pt-5">Survei Kesadaran Keamanan Siber | <b>SurveiKu.com</b></h5>
		</div>
	</div>

	<div class="contents order-2 order-md-1">
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col-md-7">
					<div>
						<img src="<?php echo e(base_url()); ?>assets/img/site/auth/logo.png" alt="" class="mb-3" style="width: 160px;">
					</div>
					<h3 class="text-white">Login ke <strong>skks.surveiku.com</strong></h3>
					<p class="mb-4">Silahkan masukkan akun anda pada form berikut ini. Pastikan akun anda masih aktif.</p>
					
					<div id="infoMessage"><?php echo $message; ?></div>
					
					<?php echo form_open("auth/login"); ?>

						<div class="form-group first">
							<label for="username" class="fw-bold text-white">Username</label>
							<?php echo form_input($identity); ?>

						</div>
						<div class="form-group last mb-3">
							<label for="password" class="fw-bold text-white">Password</label>
							<?php echo form_input($password); ?>

						</div>

						<div class="row mb-5">
							<div class="col-md-6">
								<label class="text-white">
									<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>

									<?php echo lang('login_remember_label', 'remember'); ?>

								</label>
							</label>
							
							</div>
							<!-- <div class="col-md-6 text-end">
								<span class="ml-auto"><a href="<?php echo e(base_url()); ?>auth/forgot_password" class="forgot-pass text-white" style="text-decoration: none;">Lupa Password</a></span>
							</div> -->
						</div>
						
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-flex shadow">Login</button>
						</div>
					<?php echo form_close(); ?>


				</div>
			</div>
		</div>
	</div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
	$(function() {

$('.btn-link[aria-expanded="true"]').closest('.accordion-item').addClass('active');
$('.collapse').on('show.bs.collapse', function () {
  $(this).closest('.accordion-item').addClass('active');
});

$('.collapse').on('hidden.bs.collapse', function () {
  $(this).closest('.accordion-item').removeClass('active');
});



});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('include_backend/template_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\IT\Documents\Htdocs MAMP\surveiku_skks\application\views/auth/login.blade.php ENDPATH**/ ?>