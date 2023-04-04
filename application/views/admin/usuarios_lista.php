<h1 class="display-4">Administrador Usuarios</h1>
<p class="lead">
    Agregue, edite o elimine usuarios al sistema
</p>
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="<?=site_url('admin/usuarios/create'); ?>">
            <button type="button" class="btn btn-secondary">
                <i class="fa fa-plus" aria-hidden="true"></i> Crear nuevo usuario
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
            <th scope="col">E-Mail</th>
            <th scope="col">Nombre</th>
            <th scope="col">RUT</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $estado[] = "";
            $edit[] = "";
            $membresia[] = "";
            for($n = 0; $n < count($results); $n++){
                if($results[$n]->id == 1){
                    continue;
                }
                if($results[$n]->active == 0){
                    $estado[] = "<span class=\"badge text-bg-secondary\">Desactivado</span>";
                }else{
                    $estado[] = "<span class=\"badge text-bg-success\">Activo</span>";
                }
                
                $edit[] = "<a href=\"".site_url('admin/usuarios/edit/'.$results[$n]->id.'')."\""
                        . "class=\"badge text-bg-info\">"
                        . "<i class=\"fa fa-cogs\" aria-hidden=\"true\"></i>"
                        . "</a>"
                        . "<a href=\"".site_url('admin/usuarios/delete/'.$results[$n]->id.'')."\""
                        . "class=\"badge text-bg-danger\">"
                        . "<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>"
                        . "</a>"
                        ."<a href=\"".site_url('admin/usuarios/activate/'.$results[$n]->id)."\" class=\"badge text-bg-success\" title=\"Activar usuario\">"
                        ."<i class=\"fas fa-thumbs-up\"></i>"
                        ."</a>";                                             
                echo "<tr>"
                . "<td>".$results[$n]->id."</td>"
                        . "<td>".$results[$n]->email."</td>"
                        . "<td>".$results[$n]->first_name." ".$results[$n]->last_name."</td>"
                        . "<td>".$results[$n]->rut."</td>"
                        . "<td>".$estado[$n]."</td>"
                        . "<td>".$edit[$n]."</td>"
                        . "</tr>";                
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
