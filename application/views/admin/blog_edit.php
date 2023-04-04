<h1 class="display-4">Editar entrada</h1>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('admin/blog/edit/'.$blog_select[0]['id']); ?>
<table class="table table-striped">
    <tr>
        <td>ID:</td>
        <td>
            <input type="text" name="id" class="form-control" value="<?php echo $blog_select[0]['id']; ?>" readonly="">
        </td>
    </tr>    
    <tr>
        <td>T&iacute;tulo:</td>
        <td>
            <input type="text" name="titulo" class="form-control" value="<?php echo $blog_select[0]['titulo']; ?>">
        </td>
    </tr>
    <tr>
        <td>Categor&iacute;a:</td>
        <td>
            <select name="categoria" class="form-control">
                <option selected disabled>Elegir</option>
                <?php
                    for($n = 0; $n < count($categoria_lista); $n++){
                        if($blog_select[0]['categoria_id'] == $categoria_lista[$n]['id']){
                            $sel[] = "selected";
                        }else{
                            $sel[] = "";
                        }
                        echo "<option value=\"".$categoria_lista[$n]['id']."\" ".$sel[$n].">".$categoria_lista[$n]['nombre']."</option>";
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Estado:</td>
        <td>
            <select name="estado" class="form-control">
                <option selected disabled>Elegir</option>
                <?php
                    $selactivo = "";
                    $selinactivo = "";
                    if($blog_select[0]['estado'] == 0){
                        $selactivo = "selected";
                    }else{
                        $selinactivo = "selected";
                    }
                ?>
                <option value="0" <?php if(isset($selactivo) || !is_null($selactivo)){ echo $selactivo; } ?>>Activo</option>
                <option value="1" <?php if(isset($selactivo) || !is_null($selinactivo)){ echo $selinactivo; } ?>>Inactivo</option>
            </select>
        </td>
    </tr>    
    <tr>
        <td>
            Imagen:<br />
            (*) Archivos *.jpg, *.png y *.jpeg
        </td>
        <td>
            <input type="file" name="userfile" size="20" class="form-control"/>
        </td>
    </tr>
    <tr>
        <td>Extracto: <small>150 caracteres máximo</small></td>
        <td>
            <textarea name="extracto" class="form-control">
            <?php echo $blog_select[0]['extracto']; ?>
            </textarea>
        </td>
    </tr>         
    <tr>
        <td>Texto:</td>
        <td>
            <textarea name="texto" class="form-control">
                <?php echo $blog_select[0]['cuerpo']; ?>
            </textarea>
        </td>
    </tr>    
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Editar">
        </td>
    </tr>	
</table>
<?php echo form_close(); ?>
