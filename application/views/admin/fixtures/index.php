<a href="<?= site_url('onarie') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_site_admin');?></a><br/>
<a href="<?= site_url('onarie/fixtures/add') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('add_fixture');?></a><br/>
<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif ?>
<div class="overflow">
    <table class="table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th><?= $this->lang->line('championship_name') ?></th>
                <th><?= $this->lang->line('fixture_name') ?></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $championship_name = '';
            foreach ($fixtures as $num => $fixture) :
            ?>
            <tr>
                <td>
                <?php
                // Lisibilité pour ne pas répéter le nom du championnat sur chaque ligne
                if ($championship_name!==$fixture->championship_name) {
                    echo $fixture->championship_name;
                    $championship_name = $fixture->championship_name;
                }
                ?>
                </td>
                <td><?= $fixture->fixture_name ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?= site_url('onarie/fixtures/edit/'.$fixture->fixture_id) ?>"><?= $this->lang->line('edit_fixture') ?></a>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?= site_url('onarie/fixtures/results/'.$fixture->fixture_id) ?>"><?= $this->lang->line('enter_fixture_results') ?></a>
                </td>
                <td>
                    <?php if ($fixture->status === 'open' || $fixture->status === 'ongoing') : ?>
                        <a class="btn btn-sm btn-primary" href="<?= site_url('onarie/fixtures/close_fixture/'.$fixture->fixture_id) ?>"><?= $this->lang->line('close_fixture') ?></a>
                    <?php else : ?>
                        <a class="btn btn-sm btn-outline-primary" href="<?= site_url('onarie/fixtures/open_fixture/'.$fixture->fixture_id) ?>"><?= $this->lang->line('open_fixture') ?></a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>