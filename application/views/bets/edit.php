<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('bets') ?>"><?= $this->lang->line('back_to_bets_index') ?></a><br/>
<?= validation_errors() ?>

<?php if (!empty($info)) : ?>
    <span><?= $info ?></span>
<?php else : ?>
    <?php if (isset($bet_of_message)) : ?>
        <div class="jumbotron">
            <?= $bet_of_message ?>
        </div>
    <?php endif; ?>
    <?= form_open('bets/edit/'.$fixture_id, array('class' => 'form-players-filter m-b-2')) ?>
        <span class="form-players-filter-legend m-r-3"><?= $this->lang->line('view_bets_of') ?></span>
        <a class="btn btn-link form-players-filter-link" data-toggle="collapse" href="#fieldset-filters-players" aria-expanded="false" aria-controls="fieldset-filters-players"><?= $this->lang->line('show_hide') ?></a>
        <fieldset id="fieldset-filters-players" class="form-group collapse <?= $collapse_filters ?>">
            <label for="users"><?= $this->lang->line('users')?> : </label>
            <select name="users[]" class="form-control form-players-filter-users" data-filter-page="bets" aria-label="<?= $this->lang->line('view_bets_of') ?>" multiple>
                <option value="0"></option>
                <?php foreach ($users as $key => $user) : ?>
                <option value="<?= $user->user_id ?>" <?= in_array($user->user_id, $bets_of_players) ? 'selected' : '' ?>><?= $user->user_name ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="submit-filter" class="btn btn-sm btn-primary m-t-2 m-b-2" value="<?= $this->lang->line('filter_verb') ?>">
            <input type="submit" name="submit-filter" class="btn btn-sm btn-outline-primary m-t-2 m-b-2" value="<?= $this->lang->line('del_filter') ?>">
        </fieldset>
    </form>

    <?php if (!empty($error_duplicate)) : ?>
        <span><?= $error_duplicate ?></span><br/><br/>
    <?php endif; ?>
    <label for="championship" class="strong font-bigger"><?= $this->lang->line('championship') ?> : </label>
    <span id="championship" class="font-bigger"><?= $championship_name ?></span><br/>
    <label for="fixture" class="strong font-bigger"><?= $this->lang->line('fixture') ?> : </label>
    <span id="fixture" class="font-bigger"><?= $fixture_name ?></span>
    <?= form_open('bets/edit/'.$fixture_id) ?>
        <div class="overflow">
            <table class="table-striped table-bets-edit m-b-2">
                <thead>
                    <tr>
                        <th class="text-xs-center" colspan="7"><?= $this->lang->line('my_bets') ?></th>
                        <?php
                        if (!empty($different_players)) :
                            foreach ($different_players as $player_id => $player_name) :
                        ?>
                        <th class="text-xs-center hidden-sm-down"><?= $this->lang->line('bets_of').' '.$player_name ?></th>
                        <th class="text-xs-center hidden-md-up"><?= $player_name ?></th>
                        <?php
                            endforeach;
                        endif;
                        ?>
                        <th class="text-xs-center hidden-sm-down"><?= $this->lang->line('result') ?></th>
                        <th class="text-xs-center hidden-md-up"><?= $this->lang->line('result_short') ?></th>
                        <th class="text-xs-center"><?= $this->lang->line('my_score') ?></th>
                        <th class="text-xs-center"><?= $this->lang->line('stats') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $date = '';
                    foreach ($fixture_matches as $key => $fixture_match) :
                        $match_id = $fixture_match->match_id;
                        $team1_id = $fixture_match->t1_id;
                        $team2_id = $fixture_match->t2_id;
                        $team1_score = isset($my_fixture_bets[$match_id]) ? $my_fixture_bets[$match_id]->team1_score : '';
                        $team2_score = isset($my_fixture_bets[$match_id]) ? $my_fixture_bets[$match_id]->team2_score : '';
                        $result = ($fixture_match->team1_score == NULL || $fixture_match->team2_score == NULL) ? $this->lang->line('not_available') : $fixture_match->team1_score.'-'.$fixture_match->team2_score;
                        $short_result = ($fixture_match->team1_score == NULL || $fixture_match->team2_score == NULL) ? $this->lang->line('not_available_short') : $fixture_match->team1_score.'-'.$fixture_match->team2_score;
                        $score = isset($my_fixture_bets[$match_id]) ? $my_fixture_bets[$match_id]->score : 0;
                        if ($fixture_match->formated_date !== $date) {
                            echo '<tr>';
                            echo '<td class="date" colspan="7">'.$fixture_match->formated_date.'</td>';
                            echo '<td class="date" colspan="'.(5+count($different_players)).'"></td>';
                            echo '</tr>';
                            $date = $fixture_match->formated_date;
                        }
                        $disabled = ($fixture_match->date < date('Y-m-d H:i:s')) ? 'disabled' : '';
                    ?>
                    <tr>
                        <td class="logo logo_<?= $fixture_match->short_team1 ?> hidden-sm-down"></td>
                        <td class="team1-name hidden-sm-down"><?= $fixture_match->team1 ?></td>
                        <td class="team1-name hidden-md-up"><?= $fixture_match->short_team1 ?></td>
                        <td class="team1-score"><input type="number" name="score_<?= $match_id ?>_<?= $team1_id ?>" id="score_<?= $match_id ?>_<?= $team1_id ?>" class="score" value="<?= $team1_score ?>" min="0" <?= $disabled ?> aria-label="<?= sprintf($this->lang->line('score_of_home_against'), $fixture_match->team1, $fixture_match->team2) ?>"></td>
                        <td class="dash">-</td>
                        <td class="team2-score"><input type="number" name="score_<?= $match_id ?>_<?= $team2_id ?>" id="score_<?= $match_id ?>_<?= $team2_id ?>" class="score" value="<?= $team2_score ?>" min="0" <?= $disabled ?> aria-label="<?= sprintf($this->lang->line('score_of_out_against'), $fixture_match->team2, $fixture_match->team1) ?>"></td>
                        <td class="team2-name hidden-sm-down"><?= $fixture_match->team2 ?></td>
                        <td class="team2-name hidden-md-up"><?= $fixture_match->short_team2 ?></td>
                        <td class="logo logo_<?= $fixture_match->short_team2 ?> hidden-sm-down"></td>
                        <?php
                        if (!empty($different_players)) :
                            foreach ($different_players as $player_id => $player_name) :
                        ?>
                        <td class="text-xs-center">
                            <?php
                            if (!$disabled) {
                                echo '?';
                            } else if (!empty($fixture_bets_players[$player_id][$match_id])) {
                                echo $fixture_bets_players[$player_id][$match_id]->team1_score.'-'.$fixture_bets_players[$player_id][$match_id]->team2_score.' ('.$fixture_bets_players[$player_id][$match_id]->score.$this->lang->line('points_short').')';
                            } else {
                                echo $this->lang->line('not_available_short');
                            }
                            ?>
                        </td>
                        <?php
                            endforeach;
                        endif;
                        ?>
                        <td class="text-xs-center hidden-sm-down"><?= $result ?></td>
                        <td class="text-xs-center hidden-md-up"><?= $short_result ?></td>
                        <td class="text-xs-center"><?= $score ?></td>
                        <td class="text-xs-center">
                            <a href="<?= site_url('match/'.$match_id) ?>" title="<?= $this->lang->line('stats') ?>">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <?php if ($fixture_status === 'open' || $fixture_status === 'ongoing') : ?>
        <input type="submit" id="confirm" name="submit-bets" class="btn btn-sm btn-primary m-b-2" value="<?= $this->lang->line('confirm') ?>">
        <?php endif ?>
        <input type="submit" id="return" name="submit-bets" class="btn btn-sm btn-secondary m-b-2" value="<?= $this->lang->line('back') ?>">
    </form>
<?php endif; ?>
