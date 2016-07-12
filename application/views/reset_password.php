<?php echo validation_errors(); ?>

<?php echo form_open('reset_password/'.$hash); ?>
    <label for="new_password">Nouveau mot de passe : </label><input type="password" id="new_password" name="new_password" required="required">
    <label for="new_password_confirmation">Confirmation du nouveau mot de passe : </label><input type="password" id="new_password_confirmation" name="new_password_confirmation" required="required">
    <input type="submit" value="Valider">
</form>
