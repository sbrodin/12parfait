<?php
if ($this->session->flashdata('success')) {
    echo $this->session->flashdata('success');
    echo '<br/>';
}
?>

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