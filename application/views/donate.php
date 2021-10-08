<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url() ?>"><?= $this->lang->line('back_to_home') ?></a><br/>

<!-- <div id="donate">
    <h1><?= $this->lang->line('donate') ?></h1>
    <div id="general_donate"><?= $general_donate ?></div>
    <hr>
    <div id="bet_infos"><?= $bet_infos ?></div>
    <hr>
    <div id="bet_of_infos"><?= $bet_of_infos ?></div>
    <hr>
    <div id="bet_filter"><?= $bet_filter ?></div>
</div> -->

<div id="donate_french" class="donate-content <?= $language ?>">
    <h1><?= $this->lang->line('donate') ?></h1>
    <div>
        <p class="m-t-0 m-b-0">12parfait est entièrement <strong>gratuit</strong> et le restera quoi qu'il arrive.</p>
        <p class="m-b-0">C'est un projet personnel qui me prend du temps et que j'apprécie vraiment maintenir.</p>
    </div>
    <hr>
    <div>
        <p class="m-b-0">Si ce site vous plaît vous pouvez quand même :</p>
        <ul>
            <li><a href="bitcoin:36mUfrtc3j2SoWtj6aPEnNRqoWQNMuFtf5">m'envoyer quelques miettes de bitcoin</a> (adresse : 36mUfrtc3j2SoWtj6aPEnNRqoWQNMuFtf5),</li>
            <li>m'envoyer des Tezos (adresse : tz1NQ7TZi4wFyVCQn19mhE5Hp7x9cBy96gPD),</li>
            <li>me demander une adresse de dépôt pour une autre crypto (via la page <a href="<?= site_url('contact') ?>">Contact</a>),</li>
            <li>me payer un café via <a href="https://paypal.me/sbrodin">Paypal</a>,</li>
            <li>ou juste m'envoyer un <a href="<?= site_url('contact') ?>">message</a> !</li>
        </ul>
    </div>
    <hr>
    <div>
        <p class="m-t-0 m-b-0">Merci beaucoup pour votre soutien !</p>
    </div>
</div>
