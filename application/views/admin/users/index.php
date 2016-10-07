<table class="table-striped table-bordered table-hover">
    <tr>
        <th><?php echo $this->lang->line('first_name') ?></th>
        <th><?php echo $this->lang->line('last_name') ?></th>
        <th><?php echo $this->lang->line('user_name') ?></th>
        <th><?php echo $this->lang->line('email') ?></th>
        <th><?php echo $this->lang->line('language') ?></th>
        <th><?php echo $this->lang->line('add_date') ?></th>
        <th><?php echo $this->lang->line('last_connection') ?></th>
        <th><?php echo $this->lang->line('score') ?></th>
        <th><?php echo $this->lang->line('acl') ?></th>
        <th><?php echo $this->lang->line('is_active') ?></th>
        <th><?php echo $this->lang->line('activate_deactivate') ?></th>
        <th><?php echo $this->lang->line('promote_demote') ?></th>
        <!-- <th></th> -->
    </tr>
    <?php foreach ($users as $num => $user) : ?>
    <tr>
        <td><?php echo $user->first_name ?></td>
        <td><?php echo $user->last_name ?></td>
        <td><?php echo $user->user_name ?></td>
        <td><?php echo $user->email ?></td>
        <td><?php echo $user->language ?></td>
        <td><?php echo $user->add_date_formatted ?></td>
        <td><?php echo $user->last_connection_formatted ?></td>
        <td><?php echo $user->score ?></td>
        <td><?php echo $user->acl ?></td>
        <td><?php echo $user->active ?></td>
        <td>
            <?php if ($user->user_id !== $this->session->userdata['user']->user_id) : ?>
                <?php if ($user->active === $this->lang->line('yes')) : ?>
                    <a href="<?php echo site_url('admin/users/deactivate/'.$user->user_id) ?>"><?php echo $this->lang->line('deactivate_user') ?></a>
                <?php else : ?>
                    <a href="<?php echo site_url('admin/users/activate/'.$user->user_id) ?>"><?php echo $this->lang->line('activate_user') ?></a>
                <?php endif; ?>
            <?php endif; ?>
        </td>
        <td>
            <?php if ($user->user_id !== $this->session->userdata['user']->user_id) : ?>
                <?php if ($user->acl === 'user') : ?>
                    <a href="<?php echo site_url('admin/users/promote/'.$user->user_id) ?>"><?php echo $this->lang->line('promote_user') ?></a>
                <?php else : ?>
                    <a href="<?php echo site_url('admin/users/demote/'.$user->user_id) ?>"><?php echo $this->lang->line('demote_user') ?></a>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>