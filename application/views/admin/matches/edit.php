<a href="<?= site_url('admin/matches') ?>"><?= $this->lang->line('back_to_matches_admin') ?></a><br/>
<a href="<?= site_url('admin/matches/fixture') ?>"><?= $this->lang->line('add_match') ?></a><br/>
<?= validation_errors() ?>

<?php if (!empty($info)) : ?>
    <span><?= $info ?></span>
<?php else : ?>
    <label for="championship"><?= $this->lang->line('championship') ?> : </label>
    <span id="championship"><?= $championship_name ?></span><br/>
    <div>
    <?php
    $fixture_name = '';
    foreach ($matches_fixtures as $key => $matches_fixture) {
        if($matches_fixture->fixture_name!==$fixture_name) {
            echo '</div><br/><div>';
            echo '<a href="' . site_url('admin/fixtures/edit/' . $matches_fixture->fixture_id) . '">' . $matches_fixture->fixture_name . '</a><br/>';
            $fixture_name = $matches_fixture->fixture_name;
        }
        echo $matches_fixture->team1 . ' - ' . $matches_fixture->team2 . '<br/>';
    }
    ?>
    </div>
<?php endif; ?>