<?php echo validation_errors(); ?>

<?php echo form_open('connection/create_account'); ?>
    <label for="email">Email :</label><input type="text" name="email">
    <label for="password">Mot de passe :</label><input type="password" name="password">
    <label for="password_confirmation">Confirmation du mot de passe :</label><input type="password" name="password_confirmation">
    <input type="submit" value="Valider">
</form>