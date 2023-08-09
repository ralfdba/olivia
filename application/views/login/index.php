<section class="row">
    <div class="col-4 padding-all-100px bg-login mx-auto">
    <img src="<?php echo site_url("assets/logo/olivia-logo.svg"); ?>" class="img-fluid mx-auto d-block margin_bottom30" width="120">
    <?php echo validation_errors(); ?>
        <?php
            if(isset($message)){
        ?>
            <div class="alert alert-danger"><img src="<?php echo site_url("assets/img/pawn.svg"); ?>" class="img-fluid mx-auto d-block margin_bottom30" width="30"> <?php echo $message; ?></div>
        <?php } ?>
        <?php
        $attributes = array('class' => 'form-signin', 'id' => 'login-form');
        echo form_open('login/index', $attributes);
        ?>
        <label for="inputEmail" class="sr-only">E-mail</label>
        <input type="email" name="correo" id="inputEmail" class="form-control" placeholder="E-Mail" value="<?php echo set_value('correo'); ?>">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>">
        <center><button class="btn btn-lg btn-primary btn-block" type="submit">Login</button></center>
        </form>        
    </div>
</section>
