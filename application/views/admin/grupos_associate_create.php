<h1 class="display-4">Nueva asociaci&oacute;n</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/grupos/associate_create'); ?>
<table class="table table-striped">
    <tr>
        <td>Grupo/rol:</td>
        <td>
            <?php for ( $a = 0; $a < count( $roles ); $a++ ) { ?>
            <input type="checkbox" name="role[]" value="<?php echo $roles[$a]->name; ?>"><?php echo $roles[$a]->name; ?><br />
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td>Controlador:</td>
        <td>
            <?php for ( $b = 0; $b < count( $controladores ); $b++ ) { ?>
            <input type="checkbox" name="controlador[]" value="<?php echo $controladores[$b]; ?>"><?php echo $controladores[$b]; ?><br />
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td>Acciones:</td>
        <td>
            <input type="checkbox" name="actions[]" value="list">Listar<br />
            <input type="checkbox" name="actions[]" value="create">Crear<br />
            <input type="checkbox" name="actions[]" value="update">Actualizar<br />
            <input type="checkbox" name="actions[]" value="delete">Eliminar<br />
        </td>
    </tr>  
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Asociar">
        </td>
    </tr>	
</table>
<?php echo form_close(); ?>
