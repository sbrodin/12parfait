<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin') ?></a><br/>
<a href="<?php echo site_url('admin/matches') ?>"><?php echo $this->lang->line('back_to_matches_admin') ?></a><br/>
<a href="<?php echo site_url('admin/matches/fixture') ?>"><?php echo $this->lang->line('add_match');?></a><br/>
<?php echo validation_errors(); ?>

<?php if (!empty($info)) : ?>
    <span><?php echo $info ?></span>
<?php else : ?>
    <label for="championship"><?php echo $this->lang->line('championship') ?> : </label>
    <span id="championship"><?php echo $championship_name ?></span><br/>
    <div>
    <?php
    $fixture_name = '';
    foreach ($matches_fixtures as $key => $matches_fixture) {
        if($matches_fixture->fixture_name!==$fixture_name) {
            echo '</div><br/><div>';
            echo $matches_fixture->fixture_name . '<br/>';
            $fixture_name = $matches_fixture->fixture_name;
        }
        echo $matches_fixture->team1 . ' - ' . $matches_fixture->team2 . '<br/>';
    }
    ?>
    </div>
<?php endif; ?>