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
    <span id="fixture"><?php echo $fixture_name ?></span><br/>
    <?php echo form_open('admin/fixtures/results/' . $fixture_id);
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
                echo '<tr><td class="date" colspan="5">' . $date_formatted . '</td></tr>';
                $date = $fixture_match->date;
            }
            echo '<tr><td class="team1_name">' . $fixture_match->team1 . '</td>';
            echo '<td class="team1_score"><input type="number" name="score_' . $match_id . '_' . $team1_id . '" id="score_' . $match_id . '_' . $team1_id . '" class="score" value="' . $team1_score . '" min="0"></td>';
            echo '<td class="dash">-</td>';
            echo '<td class="team2_score"><input type="number" name="score_' . $match_id . '_' . $team2_id . '" id="score_' . $match_id . '_' . $team2_id . '" class="score" value="' . $team2_score . '" min="0"></td>';
            echo '<td class="team2_name">' . $fixture_match->team2 . '</td>';
            echo '<tr/>';
        }
        echo '</tbody></table>';
        ?>
        <input type="submit" id="confirm" name="submit" value="<?php echo $this->lang->line('confirm') ?>">
        <input type="submit" id="return" name="submit" value="<?php echo $this->lang->line('back') ?>">
    </form>
<?php endif; ?>
