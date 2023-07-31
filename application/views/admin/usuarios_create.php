<h1 class="display-4">Agregar nuevo usuario</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/usuarios/create'); ?>
<table class="table table-striped">
	<tr>
            <td>E-Mail:</td>
            <td><input type="text" name="correo" class="form-control" value="<?php echo set_value('correo'); ?>"></td>
	</tr>
	<tr>
            <td>Contrase&ntilde;a:</td>
            <td><input type="password" name="passwordoriginal" class="form-control" value="<?php echo set_value('passwordoriginal'); ?>"></td>
	</tr>
	<tr>
            <td>Repita Contrase&ntilde;a:</td>
            <td><input type="password" name="passwordcheck" class="form-control" value="<?php echo set_value('passwordcheck'); ?>"></td>
	</tr>
	<tr>
            <td>Nombre:</td>
            <td><input type="text" name="nombre" class="form-control" value="<?php echo set_value('nombre'); ?>"></td>
	</tr>
	<tr>
            <td>Apellidos:</td>
            <td><input type="text" name="apellidos" class="form-control" value="<?php echo set_value('apellidos'); ?>"></td>
	</tr>
	<tr>
            <td>RUN:</td>
            <td><input type="text" name="rut" class="form-control" value="<?php echo set_value('rut'); ?>"></td>
    </tr>
    <tr>
        <td>Tel&eacute;fono:</td>
        <td><input type="text" name="fono" class="form-control" value="<?php echo set_value('rut'); ?>"></td>
    </tr>
    <tr>
        <td>Empresa:</td>
        <td>
            <select name="empresa" class="form-control">
                <option value="-0" selected="selected" disabled="disabled">Elegir empresa</option>
                <?php
                    for($n = 0; $n < count($empresas); $n++){
                        echo "<option value=\"".$empresas[$n]['rut']."\">".$empresas[$n]['empresa']."</option>";
                    }
                ?>
            </select>

        </td>
    </tr>
	<tr>
            <td>Elegir grupo/rol:</td>
            <td>
                <select name="grupo" class="form-control">
                <option value="-0" selected="selected" disabled="disabled">Elegir grupo/rol</option>
                    <?php
                        for($n = 0; $n < count($grupos); $n++){
                            echo "<option value=\"".$grupos[$n]->id."\">".$grupos[$n]->name."</option>";
                        }
                    ?>
                </select>
            </td>
	</tr>
	<tr>
            <td colspan="2">
                <input type="submit" class="btn btn-primary" value="Crear usuario">
            </td>
	</tr>
</table>
<?php echo form_close(); ?>
