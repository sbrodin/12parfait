<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?= $this->session->flashdata('success') ?>
    </div>
<?php endif ?>

<?php if (isset($home_message)) : ?>
    <div class="jumbotron">
        <?= $home_message ?>
    </div>
<?php endif; ?>

<?php if ($quote_text) : ?>
    <div class="quote">
        <blockquote class="blockquote b-l-0">
            <p class="m-a-0"><?= $quote_text ?></p>
            <p class="blockquote-footer m-a-0"><?= $quote_author ?></p>
        </blockquote>
    </div>
<?php endif; ?>

<?php if (!$yesterday_matches && !$today_matches && !$tomorrow_matches) : ?>
    <h5 class="info_date_match"><?= $this->lang->line('no_match_3days'); ?></h5>

    <?php if ($last_matches) : ?>
        <table class="home-table table-striped table-hover m-r-2 m-b-2">
            <thead>
                <tr>
                    <th colspan="<?php echo Is_connected() ? (user_can('admin_fixtures') ? '10' : '9') : '8' ?>" class="text-xs-center"><?= $this->lang->line('last_matches'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($last_matches as $key => $match) : ?>
                    <?php if (Is_connected()) : ?>
                        <tr>
                    <?php else : ?>
                        <tr data-href="<?= site_url('connection') ?>">
                    <?php endif; ?>
                        <td class="logo logo_<?= $match->short_team1 ?> <?= $match->no_logo ?>"></td>
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-right"><?= $match->team1_score ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2_score ?></td>
                        <td><?= $match->team2 ?></td>
                        <td class="logo logo_<?= $match->short_team2 ?> <?= $match->no_logo ?>"></td>
                        <?php if (Is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/'.$match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                            <td><a href="<?= site_url('match/'.$match->match_id) ?>" title="<?= $this->lang->line('stats') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection?url='.urlencode('bets/edit/'.$match->fixture_id)) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php endif; ?>
                        <?php if (Is_connected() && user_can('admin_fixtures') && ($match->status === 'open' || $match->status === 'ongoing')) : ?>
                            <td><a class="btn btn-sm btn-primary" href="<?= site_url('admin/fixtures/results/'.$match->fixture_id) ?>"><?= $this->lang->line('enter_fixture_results'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($next_matches) : ?>
        <table class="home-table table-striped table-hover m-r-2 m-b-2">
            <thead>
                <tr>
                    <th colspan="<?php echo Is_connected() ? '7' : '6' ?>" class="text-xs-center"><?= sprintf($this->lang->line('next_matches'), $next_matches_date) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($next_matches as $key => $match) : ?>
                    <?php if (Is_connected()) : ?>
                        <tr>
                    <?php else : ?>
                        <tr data-href="<?= site_url('connection') ?>">
                    <?php endif; ?>
                        <td class="logo logo_<?= $match->short_team1 ?> <?= $match->no_logo ?>"></td>
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2 ?></td>
                        <td class="logo logo_<?= $match->short_team2 ?> <?= $match->no_logo ?>"></td>
                        <?php if (Is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/'.$match->fixture_id) ?>"><?= $this->lang->line('place_bet'); ?></a></td>
                            <td><a href="<?= site_url('match/'.$match->match_id) ?>" title="<?= $this->lang->line('stats') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection?url='.urlencode('bets/edit/'.$match->fixture_id)) ?>"><?= $this->lang->line('place_bet'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php else : ?>
    <?php if (!$yesterday_matches) : ?>
        <h5 class="info_date_match"><?= $this->lang->line('no_match_yesterday'); ?></h5>
    <?php endif; ?>
    <?php if (!$today_matches) : ?>
        <h5 class="info_date_match"><?= $this->lang->line('no_match_today'); ?></h5>
    <?php endif; ?>
    <?php if (!$tomorrow_matches) : ?>
        <h5 class="info_date_match"><?= $this->lang->line('no_match_tomorrow'); ?></h5>
    <?php endif; ?>

    <?php if ($yesterday_matches) : ?>
        <table class="home-table table-striped table-hover m-r-2 m-b-2">
            <thead>
                <tr>
                    <th colspan="<?php echo Is_connected() ? (user_can('admin_fixtures') ? '10' : '9') : '6' ?>" class="text-xs-center"><?= $this->lang->line('yesterday_matches'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($yesterday_matches as $key => $match) : ?>
                    <?php if (Is_connected()) : ?>
                        <tr>
                    <?php else : ?>
                        <tr data-href="<?= site_url('connection') ?>">
                    <?php endif; ?>
                        <td class="logo logo_<?= $match->short_team1 ?> <?= $match->no_logo ?>"></td>
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-right"><?= $match->team1_score ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2_score ?></td>
                        <td><?= $match->team2 ?></td>
                        <td class="logo logo_<?= $match->short_team2 ?> <?= $match->no_logo ?>"></td>
                        <?php if (Is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/'.$match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                            <td><a href="<?= site_url('match/'.$match->match_id) ?>" title="<?= $this->lang->line('stats') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection?url='.urlencode('bets/edit/'.$match->fixture_id)) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php endif; ?>
                        <?php if (Is_connected() && user_can('admin_fixtures') && ($match->status === 'open' || $match->status === 'ongoing')) : ?>
                            <td><a class="btn btn-sm btn-primary" href="<?= site_url('admin/fixtures/results/'.$match->fixture_id) ?>"><?= $this->lang->line('enter_fixture_results'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($today_matches) : ?>
        <table class="home-table table-striped table-hover m-r-2 m-b-2">
            <thead>
                <tr>
                    <th colspan="<?php echo Is_connected() ? (user_can('admin_fixtures') ? '9' : '8') : '7' ?>" class="text-xs-center"><?= $this->lang->line('today_matches'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($today_matches as $key => $match) : ?>
                    <?php if (Is_connected()) : ?>
                        <tr>
                    <?php else : ?>
                        <tr data-href="<?= site_url('connection') ?>">
                    <?php endif; ?>
                        <td class="logo logo_<?= $match->short_team1 ?> <?= $match->no_logo ?>"></td>
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2 ?></td>
                        <td class="logo logo_<?= $match->short_team2 ?> <?= $match->no_logo ?>"></td>
                        <td class="text-xs-center"><?= $match->match_time ?></td>
                        <?php if (Is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/'.$match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                            <td><a href="<?= site_url('match/'.$match->match_id) ?>" title="<?= $this->lang->line('stats') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection?url='.urlencode('bets/edit/'.$match->fixture_id)) ?>"><?= $this->lang->line('place_bet'); ?></a></td>
                        <?php endif; ?>
                        <?php if (Is_connected() && user_can('admin_fixtures') && ($match->status === 'open' || $match->status === 'ongoing')) : ?>
                            <td><a class="btn btn-sm btn-primary" href="<?= site_url('admin/fixtures/results/'.$match->fixture_id) ?>"><?= $this->lang->line('enter_fixture_results'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($tomorrow_matches) : ?>
        <table class="home-table table-striped table-hover m-r-2 m-b-2">
            <thead>
                <tr>
                    <th colspan="<?php echo Is_connected() ? '8' : '7' ?>" class="text-xs-center"><?= $this->lang->line('tomorrow_matches'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tomorrow_matches as $key => $match) : ?>
                    <?php if (Is_connected()) : ?>
                        <tr>
                    <?php else : ?>
                        <tr data-href="<?= site_url('connection') ?>">
                    <?php endif; ?>
                        <td class="logo logo_<?= $match->short_team1 ?> <?= $match->no_logo ?>"></td>
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2 ?></td>
                        <td class="logo logo_<?= $match->short_team2 ?> <?= $match->no_logo ?>"></td>
                        <td class="text-xs-center"><?= $match->match_time ?></td>
                        <?php if (Is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/'.$match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                            <td><a href="<?= site_url('match/'.$match->match_id) ?>" title="<?= $this->lang->line('stats') ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection?url='.urlencode('bets/edit/'.$match->fixture_id)) ?>"><?= $this->lang->line('place_bet'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>

<?php if ($articles) : ?>
    <hr>
    <?php foreach ($articles as $article) : ?>
    <article class="jumbotron">
        <h5><?= $article->title ?></h5>
        <p><?= $this->lang->line('published_in') ?> <!-- <a href="<?= site_url('articles/category/'.$article->category) ?>"> --><?= $article->category ?><!-- </a> -->, <?= $this->lang->line('on') ?> <?= $article->formated_date ?></p>
        <hr class="my-4">
        <?= $article->content ?>
    </article>
    <?php endforeach; ?>
<?php endif; ?>