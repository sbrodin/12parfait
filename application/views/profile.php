<?php
if ($this->session->flashdata('success')) {
    echo $this->session->flashdata('success');
    echo '<br/>';
}
?>

<a href="<?php echo site_url('profile/edit')?>"><?php echo $this->lang->line('my_profile_edit') ?></a>

<div>
    <span>Prénom : </span><span><?php echo $user->first_name ?></span>
</div>
<div>
    <span>Nom : </span><span><?php echo $user->last_name ?></span>
</div>
<div>
    <span>Nom d'utilisateur : </span><span><?php echo $user->user_name ?></span>
</div>
<div>
    <span>Adresse email : </span><span><?php echo $user->email ?></span>
</div>
<div>
    <span>Date d'inscription : </span><span><?php echo $user->add_date_formatted ?></span>
</div>