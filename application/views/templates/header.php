<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">

        <title><?php echo $this->lang->line('12_parfait') . ' - ' . $title ?></title>
        <meta name="description" content="<?php echo $title ?>">
        <meta name="author" content="SitePoint">

        <!-- <link rel="stylesheet" href="css/styles.css?v=1.0"> -->

        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php if (is_connected()) : ?>
            <a href="<?php echo site_url('profile') ?>"><?php echo $this->lang->line('profile');?></a>
            <a href="<?php echo site_url('connection/logout') ?>"><?php echo $this->lang->line('disconnection');?></a>
            <br/>
        <?php endif; ?>
