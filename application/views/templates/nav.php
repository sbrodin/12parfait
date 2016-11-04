<header class="header clearfix">
    <a class="home-logo" href="<?= site_url() ?>"><?= img('logo.png', $this->lang->line('home'), $this->lang->line('link_to_home')) ?></a>
<?php if (is_connected()) : ?>
    <nav class="profile-log">
    <?php if (user_can('admin_all')) : ?>
        <a href="<?= site_url('admin') ?>"><?= $this->lang->line('site_admin') ?></a>
    <?php endif; ?>
        <a href="<?= site_url('profile') ?>"><?= $this->lang->line('profile') ?></a>
        <a href="<?= site_url('connection/logout') ?>"><?= $this->lang->line('log_out') ?></a>
    </nav>
</header>
<nav class="menu">
    <ul class="menu-nav horizontal">
        <li><a href="<?= site_url('bets') ?>"><?= $this->lang->line('place_bet') ?></a></li>
        <li><a href="<?= site_url('scores') ?>"><?= $this->lang->line('ladder') ?></a></li>
        <li><a href="<?= site_url('scores/'.$this->session->userdata['user']->user_id) ?>"><?= $this->lang->line('my_scores') ?></a></li>
        <li><a href="<?= site_url('contact') ?>"><?= $this->lang->line('contact') ?></a></li>
    </ul>
</nav>
<?php else : ?>
    <nav class="profile-log">
        <a class="m-l-0" href="<?= site_url('connection') ?>"><?= $this->lang->line('log_in') ?></a>
    </nav>
</header>
<?php endif; ?>
<div class="main-container">