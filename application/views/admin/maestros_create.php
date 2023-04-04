<h1 class="display-4">Agregar nuevo maestro</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/maestros/create'); ?>
<table class="table table-striped">
    <tr>
        <td>Nombre maestro:</td>
        <td><input type="text" name="nombre" class="form-control" value="<?php echo set_value('nombre'); ?>"></td>
    </tr>		
    <tr>
        <td>Estado:</td>
	<td>
		<select name="estado" class="form-control">
		<option value="-1" selected="true" disabled>Elegir</option>
		<option value="0">Activo</option>
		<option value="1">Inactivo</option>
		</select>
	</td>
    </tr>		
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Crear">
        </td>
    </tr>	
</table>
<?php echo form_close(); ?>
