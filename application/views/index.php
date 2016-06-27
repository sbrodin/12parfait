<?php if (!is_connected()) : ?>
    <a href="<?php echo site_url('connection') ?>"><?php echo $this->lang->line('connection');?></a>
<?php endif; ?>