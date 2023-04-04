<h1 class="display-4">Administrador Empresas</h1>
<p class="lead">
    Agregue, edite o elimine empresas del sistema
</p>
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="<?=site_url('admin/empresas/create'); ?>">
            <button type="button" class="btn btn-secondary">
                <i class="fa fa-plus" aria-hidden="true"></i> Crear nueva empresa
            </button>
        </a>
    </div>   
    <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="<?=site_url('admin/empresas/excel_empresas'); ?>">
            <button type="button" class="btn btn-warning">
                <i class="fa fa-download" aria-hidden="true"></i> Descargar listado
            </button>
        </a>
    </div>   
    <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="<?=site_url('admin/empresas/excel_regiones'); ?>">
            <button type="button" class="btn btn-info">
                <i class="fa fa-download" aria-hidden="true"></i> Descargar regiones listado
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
            <th scope="col">RUT</th>
            <th scope="col">Nombre</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            for($n = 0; $n < count($results); $n++){               
                $edit[] = "<a href=\"".site_url('admin/empresas/edit/'.$results[$n]->id)."\""
                        . "class=\"badge text-bg-info\">"
                        . "<i class=\"fa fa-cogs\" aria-hidden=\"true\"></i>"
                        . "</a>"
                        . "<a href=\"".site_url('admin/empresas/delete/'.$results[$n]->id)."\""
                        . "class=\"badge text-bg-danger\">"
                        . "<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>"
                        . "</a>";                    
                echo "<tr>"
                        . "<td>".$results[$n]->id."</td>"
                        . "<td>".$results[$n]->rut."</td>"
                        . "<td>".$results[$n]->empresa."</td>"
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
