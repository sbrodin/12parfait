<a class="btn btn-sm btn-outline-primary m-b-2" href="<?php echo site_url('profile/edit')?>"><?php echo $this->lang->line('my_profile_edit') ?></a>
<div class="clearfix"></div>

<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $this->session->flashdata('success') ?>
    </div>
<?php endif ?>

<div class="card card-block col-md-4">
    <h3 class="card-title">
        <span><?php echo $user->first_name ?></span> <span><?php echo $user->last_name ?></span>
    </h3>
    <h5 class="card-title">
        <span><?php echo $user->user_name ?></span>
    </h5>
    <div class="card-text">
        <span><?php echo $user->email ?></span>
    </div>
    <div class="card-text">
        <span><?php echo $this->lang->line('you_are_in_since') ?> </span><span><?php echo $user->add_date_formatted ?></span>
    </div>
</div>

<div class="clearfix"></div>