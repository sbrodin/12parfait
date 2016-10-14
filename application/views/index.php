<div class="jumbotron home-message">
    <h1 class="display-5">Bienvenue sur 12parfait</h1>
    <!-- <div class="home-message"> -->
    <p class="lead">12parfait vous permet de placer des pronostics entre amis sur les scores des matchs de football.</p>
    <p class="lead">Mais d'autres sports arrivent très vite !</p>
    <p class="lead">Le système de points en place :</p>
    <ul>
        <li>bon résultat (victoire, nul, défaite) : 4 points,</li>
        <li>bon score pour l'équipe 1 : 3 points,</li>
        <li>bon score pour l'équipe 2 : 3 points,</li>
        <li>bonne différence de buts : 2 points.</li>
    </ul>
    <p class="lead">Et le total de points possibles à marquer pour un match est donc de 12 !</p>
    <p class="lead">Un classement est disponible pour vous faire une idée de votre niveau par rapport aux autres.</p>
    <!-- </div> -->
</div>

<?php if (!$yesterday_matches && !$today_matches && !$tomorrow_matches) : ?>
    <div><?= $this->lang->line('no_match_3days'); ?></div>
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
                    <tr data-href="<?= site_url('bets/edit/' . $match->fixture_id) ?>">
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-right"><?= $match->team1_score ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2_score ?></td>
                        <td><?= $match->team2 ?></td>
                        <?php if (is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/' . $match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection') ?>"><?= $this->lang->line('place_bet'); ?></a></td>
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
                    <tr data-href="<?= site_url('bets/edit/' . $match->fixture_id) ?>">
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2 ?></td>
                        <td class="text-xs-center"><?= $match->match_time ?></td>
                        <?php if (is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/' . $match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection') ?>"><?= $this->lang->line('place_bet'); ?></a></td>
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
                    <tr data-href="<?= site_url('bets/edit/' . $match->fixture_id) ?>">
                        <td class="text-xs-right"><?= $match->team1 ?></td>
                        <td class="text-xs-center">-</td>
                        <td><?= $match->team2 ?></td>
                        <td class="text-xs-center"><?= $match->match_time ?></td>
                        <?php if (is_connected()) : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('bets/edit/' . $match->fixture_id) ?>"><?= $this->lang->line('view'); ?></a></td>
                        <?php else : ?>
                            <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('connection') ?>"><?= $this->lang->line('place_bet'); ?></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>