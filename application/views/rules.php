<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url() ?>"><?= $this->lang->line('back_to_home') ?></a><br/>

<!-- <div id="rules">
    <h1><?= $this->lang->line('rules') ?></h1>
    <div id="general_rules"><?= $general_rules ?></div>
    <hr>
    <div id="bet_infos"><?= $bet_infos ?></div>
    <hr>
    <div id="bet_of_infos"><?= $bet_of_infos ?></div>
    <hr>
    <div id="bet_filter"><?= $bet_filter ?></div>
</div> -->

<div id="rules_french" class="rules-content <?= $language ?>">
    <h1><?= $this->lang->line('rules') ?></h1>
    <div id="general_rules">
        <p class="m-t-0 m-b-0">12parfait vous permet de placer <strong>gratuitement</strong> des pronostics entre amis sur les scores des matchs de football.</p>
        <p class="m-b-0">Actuellement, la Ligue 1 et la Ligue des Champions 2018-2019 sont disponibles.</p>
        <p class="m-b-0">Le système de points en place :</p>
        <ul>
            <li>bon résultat (victoire, nul, défaite) : 4 points,</li>
            <li>bon score pour l'équipe 1 : 3 points,</li>
            <li>bon score pour l'équipe 2 : 3 points,</li>
            <li>bonne différence de buts : 2 points.</li>
        </ul>
        <p class="m-b-0">Et le total de points cumulables possibles à marquer pour un match est donc de 12 ! (d'où le 12parfait !!!)</p>
        <p class="m-b-0">Le score enregistré est celui au terme des 90 minutes de jeu, et en cas de prolongations, le score avant la séance de tirs aux buts.</p>
        <p class="m-b-0">Un <strong><a href="<?= site_url('scores') ?>">classement</a></strong> est disponible pour vous faire une idée de votre niveau par rapport aux autres.</p>
    </div>
    <hr>
    <div id="bet_infos">
        <p class="m-t-0 m-b-0">Vous pouvez placer vos pronostics en cliquant sur les différents liens "Parier" de <strong><a href="<?= site_url('bets') ?>">cette page</a></strong>.</p>
        <p class="m-b-0">Une fois que les résultats seront disponibles, vous pourrez les consulter en cliquant sur les liens "Résultats".</p>
        <p class="m-b-0"><span class="strong">Note : </span> Vous pouvez modifier un pari déjà entré autant de fois que vous le voulez, tant que la date de début du match n'est pas dépassée !</p>
    </div>
    <hr>
    <div id="bet_of_infos">
        <h4><?= $this->lang->line('bets_rules') ?></h4>
        <p class="m-t-0 m-b-0">Il est possible d'entrer certains pronostics, de les enregistrer et de revenir plus tard pour compléter ceux que vous avez déjà remplis, ou modifier vos pronostics enregistrés. Vous avez jusqu'au coup d'envoi des matchs pour les modifier.</p>
        <p class="m-b-0">Vous pouvez afficher les pronostics d'autres joueurs en cliquant sur le lien "Afficher / Masquer" de la page de pari de la journée.</p>
        <p class="m-b-0">Les pronostics des autres joueurs ne s'afficheront que quand les matchs seront commencés.</p>
        <p class="m-b-0"><span class="strong">Note : </span> Si vous ne voyez pas les pronostics d'un joueur que vous avez sélectionné, c'est qu'il n'a saisi aucun pronostic pour cette journée !</p>
    </div>
    <hr>
    <div id="bet_filter">
        <p class="m-t-0 m-b-0">Seuls les championnats et les journées dont des résultats ont été entrés sont disponibles dans les filtres.</p>
        <p>Un drôle de joueur est présent ! Il s'agit de Robot_Boy. Ses pronos ? Ils sont basés sur ceux de tous les joueurs. Dès que vous créez ou modifiez un prono, il calcule la moyenne des buts pariés par l'ensemble des joueurs et met à jour ses propres pronos. Il reflète donc la tendance des pronostiqueurs !</p>
    </div>
</div>

<div id="rules_english" class="rules-content <?= $language ?>">
    <h1><?= $this->lang->line('rules') ?></h1>
    <div id="general_rules">
        <p class="m-t-0 m-b-0">12parfait allows you to place bets between friends on football matches scores <strong>for free</strong>.</p>
        <p class="m-b-0">Currently, the Frenche Ligue 1 and the Champions League 2018-2019 are available.</p>
        <p class="m-b-0">The point system in place :</p>
        <ul>
            <li>correct result (victory, draw, loss) : 4 points,</li>
            <li>correct score for team 1 : 3 points,</li>
            <li>correct score for team 2 : 3 points,</li>
            <li>correct goal difference : 2 points.</li>
        </ul>
        <p class="m-b-0">And the total of possible points to score for one match is 12 !</p>
        <p class="m-b-0">The registered score is that at the end of the 90 minutes, and in case of extra time, the score before the penalty shoot out.</p>
        <p class="m-b-0">A <strong><a href="<?= site_url('scores') ?>">ladder</a></strong> is available to give you an idea of your level compared to others.</p>
    </div>
    <hr>
    <div id="bet_infos">
        <p class="m-t-0 m-b-0">You can place your bets by clicking on the different "Bet" links on <strong><a href="<?= site_url('bets') ?>">this page</a></strong>.</p>
        <p class="m-b-0">Once the results are available, you will be allowed to check them by clicking on the "Results" links.</p>
        <p class="m-b-0"><span class="strong">Note : </span> You can edit a bet as much as you like, as long as the match hasn't started !</p>
    </div>
    <hr>
    <div id="bet_of_infos">
        <h4><?= $this->lang->line('bets_rules') ?></h4>
        <p class="m-t-0 m-b-0">It is possible to place some bets, save them and come back later to complete them or edit your saved ones. You have until the beginning of matches to edit them.</p>
        <p class="m-b-0">You can display other players' bets by clicking the "Show / Hide" link below.</p>
        <p class="m-b-0">Other players' bets will only be displayed when matches have started.</p>
        <p class="m-b-0">A new player has appeared ! He's name is Robot_Boy. His bets ? They are based on those of all the other players. When you create or edit a bet, he calculates the average of all the bets of everyone and updates his own bets. He reflects the tendancy of betters !</p>
        <p class="m-b-0"><span class="strong">Note : </span> If you cannot see the bets of a player you selected, it means that they have not placed any bet for this fixture !</p>
    </div>
    <hr>
    <div id="bet_filter">
        <p class="m-t-0 m-b-0">Only championships and fixtures with confirmed results are available in filters.</p>
        <p>A new player has appeared ! He's name is Robot_Boy. His bets ? They are based on those of all the other players. When you create or edit a bet, he calculates the average of all the bets of everyone and updates his own bets. He reflects the tendancy of betters !</p>
    </div>
</div>
