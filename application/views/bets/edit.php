<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('bets') ?>"><?= $this->lang->line('back_to_bets_index') ?></a><br/>
<?= validation_errors() ?>

<?php if (!empty($info)) : ?>
    <span><?= $info ?></span>
<?php else : ?>
    <?php if (!empty($error_duplicate)) : ?>
        <span><?= $error_duplicate ?></span><br/><br/>
    <?php endif; ?>
    <label for="championship"><?= $this->lang->line('championship') ?> : </label>
    <span id="championship"><?= $championship_name ?></span><br/>
    <label for="fixture"><?= $this->lang->line('fixture') ?> : </label>
    <span id="fixture"><?= $fixture_name ?></span>
    <?php 
    echo form_open('bets/edit/' . $fixture_id);
    $date = '';
    ?>
        <table class="table-striped table-bets-edit m-b-2">
            <thead>
                <tr>
                    <th class="text-xs-center" colspan="5"><?= $this->lang->line('my_bets') ?></th>
                    <th class="text-xs-center"><?= $this->lang->line('result') ?></th>
                    <th class="text-xs-center"><?= $this->lang->line('my_score') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($fixture_matches as $key => $fixture_match) :
                    $match_id = $fixture_match->match_id;
                    $team1_id = $fixture_match->t1_id;
                    $team2_id = $fixture_match->t2_id;
                    $team1_score = isset($fixture_bets[$match_id]) ? $fixture_bets[$match_id]->team1_score : '';
                    $team2_score = isset($fixture_bets[$match_id]) ? $fixture_bets[$match_id]->team2_score : '';
                    $result = ($fixture_match->team1_score == NULL || $fixture_match->team2_score == NULL) ? $this->lang->line('not_available') : $fixture_match->team1_score . ' - ' . $fixture_match->team2_score;
                    $score = isset($fixture_bets[$match_id]) ? $fixture_bets[$match_id]->score : 0;
                    if ($fixture_match->date!==$date) {
                        $date_not_formatted = date_create_from_format('Y-m-d H:i:s', $fixture_match->date);
                        $date_formatted = $date_not_formatted->format('d/m/Y H\hi');
                        echo '<tr><td class="date" colspan="7">' . $date_formatted . '</td></tr>';
                        $date = $fixture_match->date;
                    }
                    $disabled = ($fixture_match->date < date('Y-m-d H:i:s')) ? 'disabled' : '';
                ?>
                <tr>
                    <td class="team1_name"><?=$fixture_match->team1 ?></td>
                    <td class="team1_score"><input type="number" name="score_<?= $match_id ?>_<?= $team1_id ?>" id="score_<?= $match_id ?>_<?= $team1_id ?>" class="score" value="<?= $team1_score ?>" min="0" <?= $disabled ?>></td>
                    <td class="dash">-</td>
                    <td class="team2_score"><input type="number" name="score_<?= $match_id ?>_<?= $team2_id ?>" id="score_<?= $match_id ?>_<?= $team2_id ?>" class="score" value="<?= $team2_score ?>" min="0" <?= $disabled ?>></td>
                    <td class="team2_name"><?= $fixture_match->team2 ?></td>
                    <td class="text-xs-center"><?= $result ?></td>
                    <td class="text-xs-center"><?= $score ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php if ($fixture_status === 'open') : ?>
        <input type="submit" id="confirm" name="submit" class="btn btn-sm btn-primary m-b-2" value="<?= $this->lang->line('confirm') ?>">
        <?php endif ?>
        <input type="submit" id="return" name="submit" class="btn btn-sm btn-secondary m-b-2" value="<?= $this->lang->line('back') ?>">
    </form>
<?php endif; ?>
