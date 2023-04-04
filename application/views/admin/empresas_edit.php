<h1 class="display-4">Editar empresa</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/empresas/edit/'.$categoria_select[0]['id']); ?>
<table class="table table-striped">
    <tr>
        <td>ID:</td>
        <td>
            <input type="text" name="id" class="form-control" value="<?php echo $categoria_select[0]['id']; ?>" readonly>
        </td>
    </tr>
    <tr>
        <td>Nombre:</td>
        <td>
            <input type="text" name="nombre" class="form-control" value="<?php echo $categoria_select[0]['empresa']; ?>">
        </td>
    </tr>
    <tr>
        <td>RUT empresa:</td>
        <td><input type="text" name="rut" class="form-control" value="<?php echo $categoria_select[0]['rut']; ?>"></td>
    </tr>
    <tr>
        <td>Direcci&oacute;n comercial:</td>
        <td><input type="text" name="direccion" class="form-control" value="<?php echo $categoria_select[0]['direccion']; ?>"></td>
    </tr>
    <tr>
        <td>E-Mail Notificaciones:</td>
        <td><input type="text" name="correo" class="form-control" value="<?php echo $categoria_select[0]['email_notificacion']; ?>"></td>
    </tr>
    <tr>
        <td>&iquest;Es laboratorio?:</td>
        <td>
            <select name="islab" class="form-control">
                <option value="-1" selected disabled>Elegir</option>
                <?php
                    $selected = "";
                    $selecteds = "";
                    if ( $categoria_select[0]['is_lab'] == 1) {
                        $selected = "selected";
                    } else {
                        $selecteds = "selected";
                    }
                ?>
                <option value="1" <?php echo $selected; ?>>Si</option>
                <option value="0" <?php echo $selecteds; ?>>No</option>
            </select>
        </td>
    </tr>     
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Editar">
        </td>
    </tr>	
</table>
<?php echo form_close(); ?>