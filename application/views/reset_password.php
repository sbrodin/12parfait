<?php echo validation_errors(); ?>

<?php echo form_open('reset_password/'.$hash); ?>
    <label for="new_password"><?php echo $this->lang->line('new_password') ?> : <span class="info"><?php echo $this->lang->line('password_rules') ?></label>
    <input type="password" id="new_password" name="new_password" class="form-control" required="required">
    <label for="new_password_confirmation"><?php echo $this->lang->line('new_password_confirmation') ?> : </label>
    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required="required"><br/>
    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Valider">
</form>
