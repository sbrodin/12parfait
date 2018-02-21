<a href="<?= site_url('admin') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_site_admin');?></a><br/>
<a href="<?= site_url('admin/messages/add') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('add_message');?></a><br/>
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif ?>
<table class="table-striped table-bordered table-hover message-table">
    <thead>
        <tr>
            <th><?= $this->lang->line('message_name') ?></th>
            <th><?= $this->lang->line('french_content') ?></th>
            <th><?= $this->lang->line('english_content') ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $key => $message) : ?>
        <tr data-href="<?= site_url('admin/messages/edit/' . $message->message_id) ?>">
            <td><?= $message->name ?></td>
            <td><?= html_entity_decode($message->french_content) ?></td>
            <td><?= html_entity_decode($message->english_content) ?></td>
            <td>
                <a href="<?= site_url('admin/messages/edit/' . $message->message_id) ?>"><?= $this->lang->line('edit_message') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>