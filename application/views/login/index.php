<section class="row">
    <div class="col-12 col-sm-12">
        <img src="https://gomind.cl/assets/img/logo_go-mind.png" class="img-fluid mx-auto d-block margin_bottom30" width="120">
    </div>
    <div class="col">
    <?php echo validation_errors(); ?>
        <?php
            if(isset($message)){
        ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php } ?>
        <?php
        $attributes = array('class' => 'form-signin', 'id' => 'login-form');
        echo form_open('login/index', $attributes);
        ?>
        <label for="inputEmail" class="sr-only">E-mail</label>
        <input type="email" name="correo" id="inputEmail" class="form-control" placeholder="Correo" value="<?php echo set_value('correo'); ?>">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        </form>        
    </div>
</section>
