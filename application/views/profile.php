<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('success') ?>
    </div>
<?php endif ?>

<br/>
<a href="<?php echo site_url('profile/edit')?>"><?php echo $this->lang->line('my_profile_edit') ?></a>

<div>
    <span><?php echo $this->lang->line('first_name') ?> : </span><span><?php echo $user->first_name ?></span>
</div>
<div>
    <span><?php echo $this->lang->line('last_name') ?> : </span><span><?php echo $user->last_name ?></span>
</div>
<div>
    <span><?php echo $this->lang->line('user_name') ?> : </span><span><?php echo $user->user_name ?></span>
</div>
<div>
    <span><?php echo $this->lang->line('email') ?> : </span><span><?php echo $user->email ?></span>
</div>
<div>
    <span><?php echo $this->lang->line('add_date') ?> : </span><span><?php echo $user->add_date_formatted ?></span>
</div>