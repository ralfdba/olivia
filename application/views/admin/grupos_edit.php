<h1 class="display-4">Editar grupo</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/grupos/edit/'.$grupo_select[0]['id']); ?>
<table class="table table-striped">
    <tr>
        <td>Nombre:</td>
        <td>
            <input type="text" name="nombre" class="form-control" value="<?php echo $grupo_select[0]['name']; ?>">
            <input type="hidden" name="id" class="form-control" value="<?php echo $grupo_select[0]['id']; ?>" readonly>
        </td>
    </tr>
    <tr>
        <td>Descripci&oacute;n larga:</td>
        <td><input type="text" name="descripcion" class="form-control" value="<?php echo $grupo_select[0]['description']; ?>"></td>
    </tr>    
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Editar">
        </td>
    </tr>	
</table>
<?php echo form_close(); ?>