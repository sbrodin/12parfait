<a href="<?= site_url('admin/messages/add') ?>"><?= $this->lang->line('add_message') ?></a><br/>
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif ?>
<table>
    <thead>
        <tr>
            <th><?= $this->lang->line('message_name') ?></th>
            <th><?= $this->lang->line('message_language') ?></th>
            <th><?= $this->lang->line('message_content') ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $key => $message) : ?>
        <tr>
            <td><?= $message->name ?></td>
            <td><?= $message->language ?></td>
            <td><?= htmlentities($message->content) ?></td>
            <td>
                <a href="<?= site_url('admin/messages/edit/' . $message->message_id) ?>"><?= $this->lang->line('edit_message') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>