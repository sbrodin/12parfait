<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('profile') ?>"><?= $this->lang->line('back') ?></a><br/>
<?= validation_errors(); ?>

<?= form_open('profile/edit'); ?>
    <label for="first_name"><?= $this->lang->line('first_name')?> : </label>
    <input type="text" id="first_name" name="first_name" value="<?= set_value('first_name') ? set_value('first_name') : $user->first_name ; ?>">

    <label for="last_name"><?= $this->lang->line('last_name') ?> : </label>
    <input type="text" id="last_name" name="last_name" value="<?= set_value('last_name') ? set_value('last_name') : $user->last_name ; ?>">

    <label for="user_name"><?= $this->lang->line('user_name') ?> : </label>
    <input type="text" id="user_name" name="user_name" value="<?= set_value('user_name') ? set_value('user_name') : $user->user_name ; ?>">

    <label for="language"><?= $this->lang->line('language') ?> : </label>
    <select id="language" name="language" required="required">
        <option value="french" <?= ($user->language == 'french') ? 'selected' : '' ?>><?= $this->lang->line('french') ?></option>
        <option value="english" <?= ($user->language == 'english') ? 'selected' : '' ?> ><?= $this->lang->line('english') ?></option>
    </select>

    <input type="submit" name="submit" value="<?= $this->lang->line('confirm') ?>">
</form>

<br/>
<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('profile') ?>"><?= $this->lang->line('back') ?></a><br/>
