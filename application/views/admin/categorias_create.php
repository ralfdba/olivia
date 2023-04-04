<h1 class="display-4">Agregar nueva categor&iacute;a</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/categorias/create'); ?>
<table class="table table-striped">
    <tr>
        <td>Nombre categor&iacute;a:</td>
        <td><input type="text" name="nombre" class="form-control" value="<?php echo set_value('nombre'); ?>"></td>
    </tr>		
    <tr>
        <td>Tipo de publicaci&oacute;n:</td>
        <td>
            <select class="form-control" name="tipo">
                <option value="-1" selected disabled>Elegir</option>
                <?php if ( $maestros ) { ?>
                    <?php for ( $n = 0; $n < count( $maestros ); $n++ ) { ?>
                    <?php if ( $maestros[$n]['estado'] == 1 ) { continue; } ?>
                    <option value="<?php echo $maestros[$n]['id']; ?>"><?php echo $maestros[$n]['nombre']; ?></option>
                    <?php } ?>
                <?php } ?>
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
