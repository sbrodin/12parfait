<form action="<?php echo site_url().'connection/login'?>" method="post">
    <input type="text" name="login">
    <input type="password" name="password">
    <input type="submit" name="Connexion">
</form>

<a href="<?php echo site_url().'connection/create_account'?>"><?php echo $this->lang->line('create_account') ?></a>