<a href="<?= site_url('admin/fixtures') ?>" class="btn btn-sm btn-outline-primary m-b-1"><?= $this->lang->line('back_to_fixtures_admin');?></a><br/>
<?= validation_errors(); ?>

<?php if (!empty($info)) : ?>
    <span><?= $info ?></span>
<?php else : ?>
    <?php if (!empty($error_duplicate)) : ?>
        <span><?= $error_duplicate ?></span><br/><br/>
    <?php endif; ?>
    <label for="championship"><?= $this->lang->line('championship') ?> : </label>
    <span id="championship"><?= $championship_name ?></span><br/>
    <label for="fixture"><?= $this->lang->line('fixture') ?> : </label>
    <span id="fixture"><?= $fixture_name ?></span><br/>
    <?php echo form_open('admin/fixtures/results/'.$fixture_id);
        echo '<table><tbody>';
        $date = '';
        foreach ($fixture_matches as $key => $fixture_match) {
            $match_id = $fixture_match->match_id;
            $team1_id = $fixture_match->t1_id;
            $team2_id = $fixture_match->t2_id;
            $team1_score = $fixture_match->team1_score;
            $team2_score = $fixture_match->team2_score;
            if ($fixture_match->date!==$date) {
                $date_not_formatted = date_create_from_format('Y-m-d H:i:s', $fixture_match->date);
                $date_formatted = $date_not_formatted->format('d/m/Y H\hi');
                echo '<tr><td class="date" colspan="5">'.$date_formatted.'</td></tr>';
                $date = $fixture_match->date;
            }
            echo '<tr><td class="team1_name">';
            if ($fixture_match->result &&
                Championship_Teams_evolve($championship_id) &&
                is_team_in_championship($fixture_match->t1_id, $championship_id)) {
                echo '<a href="#" class="del-team" data-linkdelteam="'.site_url('admin/championships/del_team_from_championship/'.$team1_id.'/'.$championship_id).'">X </a>';
            }
            echo $fixture_match->team1.'</td>';
            echo '<td class="team1_score"><input type="number" name="score_'.$match_id.'_'.$team1_id.'" id="score_'.$match_id.'_'.$team1_id.'" class="score" value="'.$team1_score.'" min="0"></td>';
            echo '<td class="dash">-</td>';
            echo '<td class="team2_score"><input type="number" name="score_'.$match_id.'_'.$team2_id.'" id="score_'.$match_id.'_'.$team2_id.'" class="score" value="'.$team2_score.'" min="0"></td>';
            echo '<td class="team2_name">'.$fixture_match->team2.'';
            if ($fixture_match->result &&
                Championship_Teams_evolve($championship_id) &&
                is_team_in_championship($fixture_match->t2_id, $championship_id)) {
                echo '<a href="#" class="del-team" data-linkdelteam="'.site_url('admin/championships/del_team_from_championship/'.$team2_id.'/'.$championship_id).'">X </a>';
            }
            echo '</td><tr/>';
        }
        echo '</tbody></table>';
        ?>
        <input type="submit" id="confirm" name="submit" value="<?= $this->lang->line('confirm') ?>">
        <input type="submit" id="return" name="submit" value="<?= $this->lang->line('back') ?>">
    </form>
<?php endif; ?>