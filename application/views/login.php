<form action="<?php echo site_url().'connection/login'?>" method="post">
    <input type="text" name="email" required="required">
    <input type="password" name="password" required="required">
    <input type="submit" name="Connexion">
</form>

<a href="<?php echo site_url().'connection/create_account'?>"><?php echo $this->lang->line('create_account') ?></a>