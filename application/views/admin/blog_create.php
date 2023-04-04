<h1 class="display-4">Agregar nueva entrada</h1>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('admin/blog/create'); ?>
<table class="table table-striped">
    <tr>
        <td>T&iacute;tulo:</td>
        <td>
            <input type="text" name="titulo" class="form-control" value="<?php echo set_value('nombre'); ?>">
        </td>
    </tr>
    <tr>
        <td>Categor&iacute;a:</td>
        <td>
            <select name="categoria" class="form-control">
                <option selected disabled>Elegir</option>
                <?php
                    for($n = 0; $n < count($categoria_lista); $n++){
                        echo "<option value=\"".$categoria_lista[$n]['id']."\">".$categoria_lista[$n]['nombre']."</option>";
                    }
                ?>
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
            <?php echo set_value('extracto'); ?>
            </textarea>
        </td>
    </tr>        
    <tr>
        <td>Texto:</td>
        <td>
            <textarea name="texto" class="form-control">
            <?php echo set_value('texto'); ?>
            </textarea>
        </td>
    </tr>    
    <tr>
        <td colspan="2">
            <input type="submit" class="btn btn-primary" value="Crear">
        </td>
    </tr>	
</table>
<?php echo form_close(); ?>
