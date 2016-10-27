<a href="<?= site_url('admin/messages') ?>"><?= $this->lang->line('back_to_messages_admin') ?></a><br/>
<?= validation_errors(); ?>

<?= form_open('admin/messages/edit/'.$message->message_id); ?>
    <label for="message_name"><?= $this->lang->line('message_name') ?> : </label>
    <input type="text" id="message_name" name="message_name" value="<?= $message->name ?>" required="required" autofocus>
    <label for="french_content"><?= $this->lang->line('french_content') ?> : </label>
    <textarea id="french_content" name="french_content"></textarea>
    <label for="english_content"><?= $this->lang->line('english_content') ?> : </label>
    <textarea id="english_content" name="english_content"></textarea>
    <input type="submit" value="<?= $this->lang->line('confirm') ?>">
</form>
