<h1 class="display-4">Editar maestros</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/maestros/edit/'.$categoria_select[0]['id']); ?>
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
            <input type="text" name="nombre" class="form-control" value="<?php echo $categoria_select[0]['nombre']; ?>">
        </td>
    </tr>		
    <tr>
        <td>Estado:</td>
	<td>
		<select name="estado" class="form-control">
		<option value="-1" disabled>Elegir</option>
<?php
print_r($categoria_select);
if($categoria_select[0]['estado'] == 0){
	echo "<option value=\"0\" selected=\"true\">Activo</option>";
	echo "<option value=\"1\">Inactivo</option>";
}elseif($categoria_select[0]['estado'] == 1){
	echo "<option value=\"0\">Activo</option>";
	echo "<option value=\"1\" selected=\"true\">Inactivo</option>";
}
?>
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Editar">
        </td>
    </tr>	
</table>
<?php echo form_close(); ?>
