<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin') ?></a><br/>
<a href="<?php echo site_url('admin/fixtures') ?>"><?php echo $this->lang->line('back_to_fixtures_admin') ?></a><br/>
<?php echo validation_errors(); ?>

<?php if (!empty($info)) : ?>
    <span><?php echo $info ?></span>
<?php else : ?>
    <?php if (!empty($error_duplicate)) : ?>
        <span><?php echo $error_duplicate ?></span><br/><br/>
    <?php endif; ?>
    <label for="championship"><?php echo $this->lang->line('championship') ?> : </label>
    <span id="championship"><?php echo $championship_name ?></span><br/>
    <label for="fixture"><?php echo $this->lang->line('fixture') ?> : </label>
    <span id="fixture"><?php echo $fixture_name ?></span><br/><br/>
    <?php echo form_open('admin/fixtures/edit/' . $fixture_id); ?>
        <?php
        foreach ($fixture_matches as $key => $fixture_match) :
            $date = date_create_from_format('Y-m-d H:i:s', $fixture_match->date);
            $fixture_match->date = $date->format('d/m/Y H:i');
        ?>
        <label for="match_<?php echo $key ?>_date"><?php echo $this->lang->line('match_date') ?> : </label>
        <input type="text" name="date_<?php echo $key ?>" id="date_<?php echo $key ?>" class="match_date" required="required" value="<?php echo $fixture_match->date ?>" ><br/>
        <select id="match_<?php echo $key ?>_1" name="match_<?php echo $key ?>_1" required="required">
            <?php foreach ($teams as $team_id => $team_name) : ?>
            <option value="<?php echo $team_id ?>" 
                <?php echo ($fixture_match->t1_id==$team_id) ? 'selected' : '' ?> ><?php echo $team_name ?></option>
            <?php endforeach; ?>
        </select>
        <span> - </span>
        <select id="match_<?php echo $key ?>_2" name="match_<?php echo $key ?>_2" required="required">
            <?php foreach ($teams as $team_id => $team_name) : ?>
            <option value="<?php echo $team_id ?>" 
                <?php echo ($fixture_match->t2_id==$team_id) ? 'selected' : '' ?> ><?php echo $team_name ?></option>
            <?php endforeach; ?>
        </select><br/><br/>
        <?php endforeach; ?>
        <input type="submit" value="<?php echo $this->lang->line('confirm') ?>">
    </form>

    <script type="text/javascript" src="<?php echo js_url('jquery-3.1.0.min') ?>"></script>
    <script type="text/javascript" src="<?php echo js_url('jquery.datetimepicker.full.min') ?>"></script>
    <script type="text/javascript">
        $.datetimepicker.setLocale('fr');
        $('.match_date').datetimepicker({
            dayOfWeekStart: 1,
            format:'d/m/Y H:i',
            allowTimes:[
                '15:00', '17:00', '20:00', '20:45'
            ],
        });
    </script>
<?php endif; ?>
