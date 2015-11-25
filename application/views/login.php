<div id="authentification_container">
	<div id="authentification">
		<form action="<?php echo site_url().'/connection/login' ?>" method="post">
			<div>
				<label for="login"><?php echo img('IC_UTILISATEUR.png', $alt = '') ?></label>
				<input type="text" name="login" id="login" value="" placeholder="<?php echo strtoupper($this->lang->line('user')) ?>" />
			</div>
			<div>
				<label for="password"><?php echo img('IC_MOT_DE_PASSE.png', $alt = '') ?></label>
				<input type="password" name="password" id="password" value="" placeholder="<?php echo strtoupper($this->lang->line('password')) ?>" />
			</div>
			<button type="submit"><?php echo $this->lang->line('connection') ?></button>
		</form>
		<div id="logo_prod">
			<?php echo img('IC_LOGO_PROD_COULEUR.png', $alt = '') ?>
		</div>
	</div>
</div>