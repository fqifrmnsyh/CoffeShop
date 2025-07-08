<body>

	<div class="limiter">
		<div class="dark-choco" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
			<div class="wrap-login100">
				<div style="position: absolute; top: 20px; left: 20px;">
					<a href="<?= base_url('Home'); ?>" class="btn-back"
						style="text-decoration: none; color: white; background-color: #333; padding: 10px 20px; border-radius: 5px;">Back</a>
				</div>
				<div class=""
					style="background-image: linear-gradient(178deg, rgba(51,51,51,0.2) 0%, rgba(18,18,18,0.3) 100%), url(<?= base_url('assets/'); ?>autent/images/bg-02.jpg); background-size: cover; display: flex; justify-content: center; align-items: center; height: 150px">
					<span class="login100-form-title-1">
						Login
					</span>
				</div>
				<?= $this->session->flashdata('pesan'); ?>
				<form class="login100-form validate-form" method="post" action="<?= base_url('autentifikasi'); ?>">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">E-mail</span>
						<input id="email" class="input100" type="text" name="email" placeholder="Enter e-mail"
							value="<?= set_value('email'); ?>">
						<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input id="password" class="input100" type="password" name="password"
							placeholder="Enter password">
						<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
						<span class="focus-input100"></span>
					</div>


					<button class="btn-17">
						<span class="text-container">
							<span class="text">Login</span>
						</span>
					</button>
				</form>
			</div>
		</div>
	</div>

</body>

</html>