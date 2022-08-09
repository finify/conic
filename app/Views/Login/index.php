<?php $this->start('head');?>
<meta content="test">
<?php $this->end();?>

<?php $this->start('body');?>
	<!-- Register -->
	<div class="card">
		<div class="card-body">
			<!-- Logo -->
			<div class="app-brand justify-content-center">
			<a href="index.html" class="app-brand-link gap-2">
				<img src="<?=PROOT?>assets/img/conichomeslogo.png" width="200px" alt="">
			</a>
			</div>
			<!-- /Logo -->
			<h4 class="mb-2">Welcome to Conic homes realtor platform 👋</h4>
			<p class="mb-4">Please sign-in to your account </p>
			<?php 
			if(($_POST)){ ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
				<?=$this->displayErrors?>
			</div> 
			<?php } ?>
			
			<form id="formAuthentication" class="mb-3" action="<?=PROOT?>login/index" method="POST">
			<div class="mb-3">
				<label for="email" class="form-label">Username</label>
				<input
				type="text"
				class="form-control"
				id="email"
				name="username"
				placeholder="Enter your username"
				autofocus
				/>
			</div>
			<div class="mb-3 form-password-toggle">
				<div class="d-flex justify-content-between">
				<label class="form-label" for="password">Password</label>
				<a href="auth-forgot-password-basic.html">
					<small>Forgot Password?</small>
				</a>
				</div>
				<div class="input-group input-group-merge">
				<input
					type="password"
					id="password"
					class="form-control"
					name="password"
					placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
					aria-describedby="password"
				/>
				<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
				</div>
			</div>
			<div class="mb-3">
				<div class="form-check">
				<input class="form-check-input" type="checkbox" id="remember-me"  name="remember" value="ON"/>
				<label class="form-check-label" for="remember-me"> Remember Me </label>
				</div>
			</div>
			<div class="mb-3">
				<button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
			</div>
			</form>

			
		</div>
	</div>
		<!-- /Register -->

<?php $this->end();?>