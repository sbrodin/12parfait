<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('profile') ?>"><?= $this->lang->line('back') ?></a><br/>
<?= validation_errors(); ?>

<?= form_open('profile/edit'); ?>
    <table class="table-bets-edit m-b-2">
        <tbody>
            <tr>
                <td><label for="first_name"><?= $this->lang->line('first_name')?> : </label></td>
                <td><input type="text" id="first_name" name="first_name" value="<?= set_value('first_name') ? set_value('first_name') : $user->first_name ; ?>"></td>
            </tr>
            <tr>
                <td><label for="last_name"><?= $this->lang->line('last_name') ?> : </label></td>
                <td><input type="text" id="last_name" name="last_name" value="<?= set_value('last_name') ? set_value('last_name') : $user->last_name ; ?>"></td>
            <tr>
            <tr>
                <td><label for="user_name"><?= $this->lang->line('user_name') ?> : </label></td>
                <td><input type="text" id="user_name" name="user_name" value="<?= set_value('user_name') ? set_value('user_name') : $user->user_name ; ?>"></td>
            <tr>
            <tr>
                <td><label for="language"><?= $this->lang->line('language') ?> : </label></td>
                <td>
                    <select id="language" name="language" required="required">
                        <option value="french" <?= ($user->language == 'french') ? 'selected' : '' ?>><?= $this->lang->line('french') ?></option>
                        <option value="english" <?= ($user->language == 'english') ? 'selected' : '' ?> ><?= $this->lang->line('english') ?></option>
                    </select>
                </td>
            <tr>
        </tbody>
    </table>

    <input type="submit" name="submit" class="btn btn-sm btn-primary m-b-2" value="<?= $this->lang->line('confirm') ?>">
    <a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('profile') ?>"><?= $this->lang->line('back') ?></a>
</form>
