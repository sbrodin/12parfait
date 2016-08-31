<?php echo validation_errors(); ?>

<?php echo form_open('profile/edit'); ?>
    <label for="first_name"><?php echo $this->lang->line('first_name')?> : </label>
    <input type="text" id="first_name" name="first_name" value="<?php echo set_value('first_name') ? set_value('first_name') : $user->first_name ; ?>">

    <label for="last_name"><?php echo $this->lang->line('last_name') ?> : </label>
    <input type="text" id="last_name" name="last_name" value="<?php echo set_value('last_name') ? set_value('last_name') : $user->last_name ; ?>">

    <label for="user_name"><?php echo $this->lang->line('user_name') ?> : </label>
    <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name') ? set_value('user_name') : $user->user_name ; ?>">

    <label for="language"><?php echo $this->lang->line('language') ?> : </label>
    <select id="language" name="language" required="required">
        <option value="french" <?php echo ($user->language == 'french') ? 'selected' : '' ?>><?php echo $this->lang->line('french') ?></option>
        <option value="english" <?php echo ($user->language == 'english') ? 'selected' : '' ?> ><?php echo $this->lang->line('english') ?></option>
    </select>

    <input type="submit" name="submit" value="<?php echo $this->lang->line('confirm') ?>">
</form>

<br/>
<a href="<?php echo site_url('profile')?>"><?php echo $this->lang->line('back') ?></a>