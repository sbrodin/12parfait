<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif ?>

<div class="jumbotron home-message">
    <?= $home_message ?>
</div>

<?php if (!$yesterday_matches && !$today_matches && !$tomorrow_matches) : ?>
    <div><?= $this->lang->line('no_match_3days'); ?></div>

    <?php if ($last_matches) : ?>
        <table class="home-table table-striped table-hover m-t-2 m-r-2">
            <thead>
                <tr>
                    <th colspan="6" class="text-xs-center"><?= $this->lang->line('last_matches'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($last_matches as $key => $match) : ?>
                    <?php if (is_connected()) : ?>
                        <tr data-href="<?= site_url('bets/edit/' . $match->fixture_id) ?>">
                    <?php else : ?>
                        <tr data-href="<?= site_url('connection') ?>">
                    <?php endif; ?>
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-right"><?= $match->team1_score ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2_score ?></td>
                        <td><?= $match->team2 ?></td>
                        <?php if (is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/' . $match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection?url=' . urlencode('bets/edit/' . $match->fixture_id)) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($next_matches) : ?>
        <table class="home-table table-striped table-hover m-t-2 m-r-2">
            <thead>
                <tr>
                    <th colspan="4" class="text-xs-center"><?= sprintf($this->lang->line('next_matches'), $next_matches_date) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($next_matches as $key => $match) : ?>
                    <?php if (is_connected()) : ?>
                        <tr data-href="<?= site_url('bets/edit/' . $match->fixture_id) ?>">
                    <?php else : ?>
                        <tr data-href="<?= site_url('connection') ?>">
                    <?php endif; ?>
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2 ?></td>
                        <?php if (is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/' . $match->fixture_id) ?>"><?= $this->lang->line('place_bet'); ?></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection?url=' . urlencode('bets/edit/' . $match->fixture_id)) ?>"><?= $this->lang->line('place_bet'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php else : ?>
    <?php if (!$yesterday_matches) : ?>
        <div><?= $this->lang->line('no_match_yesterday'); ?></div>
    <?php endif; ?>
    <?php if (!$today_matches) : ?>
        <div><?= $this->lang->line('no_match_today'); ?></div>
    <?php endif; ?>
    <?php if (!$tomorrow_matches) : ?>
        <div><?= $this->lang->line('no_match_tomorrow'); ?></div>
    <?php endif; ?>

    <?php if ($yesterday_matches) : ?>
        <table class="home-table table-striped table-hover m-t-2 m-r-2">
            <thead>
                <tr>
                    <th colspan="6" class="text-xs-center"><?= $this->lang->line('yesterday_matches'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($yesterday_matches as $key => $match) : ?>
                    <?php if (is_connected()) : ?>
                        <tr data-href="<?= site_url('bets/edit/' . $match->fixture_id) ?>">
                    <?php else : ?>
                        <tr data-href="<?= site_url('connection') ?>">
                    <?php endif; ?>
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-right"><?= $match->team1_score ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2_score ?></td>
                        <td><?= $match->team2 ?></td>
                        <?php if (is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/' . $match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection?url=' . urlencode('bets/edit/' . $match->fixture_id)) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($today_matches) : ?>
        <table class="home-table table-striped table-hover m-t-2 m-r-2">
            <thead>
                <tr>
                    <th colspan="5" class="text-xs-center"><?= $this->lang->line('today_matches'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($today_matches as $key => $match) : ?>
                    <?php if (is_connected()) : ?>
                        <tr data-href="<?= site_url('bets/edit/' . $match->fixture_id) ?>">
                    <?php else : ?>
                        <tr data-href="<?= site_url('connection') ?>">
                    <?php endif; ?>
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2 ?></td>
                        <td class="text-xs-center"><?= $match->match_time ?></td>
                        <?php if (is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/' . $match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection?url=' . urlencode('bets/edit/' . $match->fixture_id)) ?>"><?= $this->lang->line('place_bet'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($tomorrow_matches) : ?>
        <table class="home-table table-striped table-hover m-t-2 m-r-2">
            <thead>
                <tr>
                    <th colspan="5" class="text-xs-center"><?= $this->lang->line('tomorrow_matches'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tomorrow_matches as $key => $match) : ?>
                    <?php if (is_connected()) : ?>
                        <tr data-href="<?= site_url('bets/edit/' . $match->fixture_id) ?>">
                    <?php else : ?>
                        <tr data-href="<?= site_url('connection') ?>">
                    <?php endif; ?>
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2 ?></td>
                        <td class="text-xs-center"><?= $match->match_time ?></td>
                        <?php if (is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/' . $match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection?url=' . urlencode('bets/edit/' . $match->fixture_id)) ?>"><?= $this->lang->line('place_bet'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>