<?php echo validation_errors(); ?>

<?php echo form_open('connection/create_account'); ?>
    <label for="email">Email :</label><input type="text" name="email" value="<?php echo set_value('email'); ?>" required="required">
    <label for="password">Mot de passe :</label><input type="password" name="password" required="required">
    <label for="password_confirmation">Confirmation du mot de passe :</label><input type="password" name="password_confirmation" required="required">
    <input type="submit" value="Valider">
</form>

<a href="<?php echo site_url()?>"><?php echo $this->lang->line('home') ?></a>