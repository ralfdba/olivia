<h1 class="display-4">Administrador Grupos</h1>
<p class="lead">
    Agregue, edite o elimine grupos del sistema
</p>
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="<?=site_url('admin/grupos/create'); ?>">
            <button type="button" class="btn btn-secondary">
                <i class="fa fa-plus" aria-hidden="true"></i> Crear nuevo grupo
            </button>
        </a>
    </div>   
</div>
<br />
<?php if(isset($results)){ ?>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripci&oacute;n</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            for($n = 0; $n < count($results); $n++){
                $edit[] = "<a href=\"".site_url('admin/grupos/edit/'.$results[$n]->id)."\""
                        . "class=\"badge text-bg-info\">"
                        . "<i class=\"fa fa-cogs\" aria-hidden=\"true\"></i>"
                        . "</a>"
                        . "<a href=\"".site_url('admin/grupos/delete/'.$results[$n]->id)."\""
                        . "class=\"badge text-bg-danger\">"
                        . "<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>"
                        . "</a>";
                if( $results[$n]->id == 1 ){
                    continue;
                }else{                    
                    echo "<tr>"
                            . "<td>".$results[$n]->id."</td>"
                            . "<td>".$results[$n]->name."</td>"
                            . "<td>".$results[$n]->description."</td>"
                            . "<td>".$edit[$n]."</td>"
                            . "</tr>";                    
                }               
            }
        ?>
    </tbody>    
</table>
<?php }else{ ?>
<div class="alert alert-info">
    <p>
        <i class="fa fa-exclamation" aria-hidden="true"></i> No existen datos para mostrar
    </p>
</div>
<?php } ?>
<?php if(isset($links)){ ?>
    <?php
        echo $links;
    ?>
<?php } ?>