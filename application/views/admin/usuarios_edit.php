<h1 class="display-4">Editar usuario</h1>
<?php echo validation_errors(); ?>
<?php if(isset($message)){ ?>
<div class="alert alert-warning">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $message; ?>
    </p>
</div>
<?php } ?>
<?php echo form_open('admin/usuarios/edit/'.$usuarios_select[0]['id']); ?>
<table class="table table-striped">
    <tr>
        <td>ID:</td>
        <td>
            <input type="text" name="id" class="form-control" value="<?php echo $usuarios_select[0]['id']; ?>" readonly="">
        </td>
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
        <td><input type="text" name="nombre" class="form-control" value="<?php echo $usuarios_select[0]['first_name']; ?>"></td>
    </tr>
    <tr>
        <td>Apellidos:</td>
        <td><input type="text" name="apellidos" class="form-control" value="<?php echo $usuarios_select[0]['last_name']; ?>"></td>
    </tr>
    <tr>
        <td>E-Mail:</td>
        <td><input type="text" name="correo" class="form-control" value="<?php echo $usuarios_select[0]['email']; ?>"></td>
    </tr>
    <tr>
        <td>RUN:</td>
        <td><input type="text" name="run" class="form-control" value="<?php echo $usuarios_select[0]['rut']; ?>"></td>
    </tr>
    <tr>
        <td>Tel&eacute;fono:</td>
        <td><input type="text" name="fono" class="form-control" value="<?php echo $usuarios_select[0]['phone']; ?>"></td>
    </tr>
      <tr>
          <td>D&iacute;as disponibles <small>*Solo enfermeras </small>:</td>
          <td>
			<?php
                if ( isset( $usuarios_select[0]['disponibilidad'] ) ) {
                    $dias = json_decode( $usuarios_select[0]['disponibilidad'] );
                    $checked1 = "";
                    $checked2 = "";
                    $checked3 = "";
                    $checked4 = "";
                    $checked5 = "";
                    $checked6 = "";
                    $checked7 = "";
                    for ( $a = 0; $a < count($dias); $a++ ) {
                        
                        if ( $dias[$a] == 1 ) {
                            $checked1 = "checked";
                        } elseif ( $dias[$a] == 2 ) {
                            $checked2 = "checked";
                        } elseif ( $dias[$a] == 3 ) {
                            $checked3 = "checked";
                        } elseif ( $dias[$a] == 4 ) {
                            $checked4 = "checked";
                        } elseif ( $dias[$a] == 5 ) {
                            $checked5 = "checked";
                        } elseif ( $dias[$a] == 6 ) {
                            $checked6 = "checked";
                        } elseif ( $dias[$a] == 7 ) {
                            $checked7 = "checked";
                        }
                        
                    }
                } else {
                    $checked1 = "";
                    $checked2 = "";
                    $checked3 = "";
                    $checked4 = "";
                    $checked5 = "";
                    $checked6 = "";
                    $checked7 = "";                    
                }

			?>
              <input type="checkbox" name="disponibilidad[]" value="1" <?php echo $checked1; ?>>&nbsp;Lunes<br />
              <input type="checkbox" name="disponibilidad[]" value="2" <?php echo $checked2; ?>>&nbsp;Martes<br />
              <input type="checkbox" name="disponibilidad[]" value="3" <?php echo $checked3; ?>>&nbsp;Mi&eacute;rcoles<br />
              <input type="checkbox" name="disponibilidad[]" value="4" <?php echo $checked4; ?>>&nbsp;Jueves<br />
              <input type="checkbox" name="disponibilidad[]" value="5" <?php echo $checked5; ?>>&nbsp;Viernes<br />
              <input type="checkbox" name="disponibilidad[]" value="6" <?php echo $checked6; ?>>&nbsp;S&aacute;bado<br />
              <input type="checkbox" name="disponibilidad[]" value="7" <?php echo $checked7; ?>>&nbsp;Domingo
          </td>
      </tr>
      <tr>
          <td>Valor Hora (bruto)<small>*Solo enfermeras</small>:</td>
          <td><input type="text" name="costohora" class="form-control" value="<?php echo $usuarios_select[0]['costohora']; ?>"></td>
      </tr>
    <tr>
        <td>Empresa:</td>
        <td>
            <select name="empresa" class="form-control">
              <option value="-1" selected disabled>Elegir</option>
                <?php
                    $sel = [];
                    for( $n = 0; $n < count($empresas); $n++ ){
                      if( $usuarios_select[0]['company'] == $empresas[$n]['rut'] ){
                        $sel[] = "selected='selected'";
                      } else {
                        $sel[] = "";
                      }
                        echo "<option value=\"".$empresas[$n]['rut']."\" ".$sel[$n].">".$empresas[$n]['empresa']."</option>";
                    }
                ?>
            </select>

        </td>
    </tr>
    <tr>
        <td>Direcci&oacute;n:</td>
        <td><input type="text" name="direccion" class="form-control" value="<?php echo $usuarios_select[0]['direccion']; ?>"></td>
    </tr>
    <tr>
        <td>Elegir perfil:</td>
        <td>
            <select name="grupo" class="form-control">
                <option value="-1" selected disabled>Elegir</option>
                <?php
                    $selected = "";
                    for($n = 0; $n < count($grupos); $n++){
                        if ( $grupo_usuario[1]->id = $grupos[$n]->id ) {
                            $selected = "selected";
                        }
                        if($grupos[$n]->id == 1){
                            continue;
                        }else{
                            echo "<option value=\"".$grupos[$n]->id."\" $selected>".$grupos[$n]->name."</option>";
                        }

                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Editar usuario">
        </td>
    </tr>
</table>
<?php echo form_close(); ?>
