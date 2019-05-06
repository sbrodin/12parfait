<header class="header clearfix" role="banner">
    <a class="home-logo" href="<?= site_url() ?>"><?= img('logo.png', $this->lang->line('logo_12parfait'), $this->lang->line('link_to_home')) ?></a>
<?php if (Is_connected()) : ?>
    <nav class="profile-log">
    <?php if (user_can('admin_all')) : ?>
        <a href="<?= site_url('admin') ?>"><?= $this->lang->line('site_admin') ?></a>
    <?php endif; ?>
        <a id="profile" href="<?= site_url('profile') ?>">
            <i class="fa fa-user"
               title="<?= $this->lang->line('profile') ?> : <?= $this->session->user->user_name ?>"
               alt="<?= $this->lang->line('profile') ?> : <?= $this->session->user->user_name ?>"></i>
        </a>
        <a id="logout" href="<?= site_url('logout') ?>">
            <i class="fa fa-sign-out"
               title="<?= $this->lang->line('log_out') ?>"
               alt="<?= $this->lang->line('log_out') ?>"></i>
        </a>
    </nav>
</header>
<nav class="menu" role="navigation">
    <ul class="menu-nav horizontal">
        <li><a href="<?= site_url('bets') ?>"><?= $this->lang->line('place_bet') ?></a></li>
        <li><a href="<?= site_url('scores') ?>"><?= $this->lang->line('ladder') ?></a></li>
        <li><a href="<?= site_url('scores/'.$this->session->user->rand_userid) ?>"><?= $this->lang->line('my_scores') ?></a></li>
        <li><a href="<?= site_url('contact') ?>"><?= $this->lang->line('contact') ?></a></li>
    </ul>
</nav>
<?php else : ?>
    <nav class="profile-log">
        <a class="m-l-0" href="<?= site_url('connection') ?>"><?= $this->lang->line('log_in') ?></a>
    </nav>
</header>
<nav class="menu" role="navigation">
    <ul class="menu-nav horizontal">
        <li><a href="<?= site_url('connection') ?>"><?= $this->lang->line('place_bet') ?></a></li>
        <li><a href="<?= site_url('contact') ?>"><?= $this->lang->line('contact') ?></a></li>
    </ul>
</nav>
<?php endif; ?>

<?= img('coupe_monde_feminine_bandeau.png', $this->lang->line('womens_world_cup'), $this->lang->line('womens_world_cup'), 'coupe_monde_feminine_bandeau') ?>

<div class="main-container">