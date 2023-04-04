<?php
if(isset($message)){
?>
<div id="infoMessage">
    <div class="alert alert-warning">
        <?php echo $message;?>
    </div>
</div>
<?php } ?>
<h6>Recuperar contrase&ntilde;a</h6>
<p>
    Introduzca su cuenta de correo para recibirla de nuevo
</p>
<?php echo form_open("login/forgot");?>
      <p>
      	<label for="identity">
            <?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
      	<?php echo form_input($identity);?>
      </p>
      <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></p>
<?php echo form_close();?>