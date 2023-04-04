<h1 class="display-4">Editar categor&iacute;a</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/categorias/edit/'.$categoria_select[0]['id']); ?>
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
          <td>Tipo de publicaci&oacute;n:</td>
          <td>
              <select class="form-control" name="tipo">
                  <option value="-1" disabled>Elegir</option>
                  <?php if ( $maestros ) { ?>
						<?php $selected = []; ?>
                      <?php for ( $n = 0; $n < count( $maestros ); $n++ ) { ?>
                      <?php if ( $maestros[$n]['estado'] == 1 ) { continue; } ?>
                      <?php if ( $maestros[$n]['id'] == $categoria_select[0]['tipo_muestra'] ) { $selected = "selected"; } else { $selected = ""; }  ?>
                      <option value="<?php echo $maestros[$n]['id']; ?>" <?php echo $selected; ?>><?php echo $maestros[$n]['nombre']; ?></option>
                      <?php } ?>
                  <?php } ?>
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
