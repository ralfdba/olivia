<section class="container">
    <div class="row padding-top30px">
        <div class="col-lg-8 col-sm-12">
            <h1>Administrador Maestros</h1>
            <p class="lead">
            Agregue, edite o elimine maestros del sistema
            </p>
        </div>
        <div class="col-lg-2 col-sm-12 text-end padding_top_30">
            <a href="<?=site_url('admin/maestros/create'); ?>" class="btn btn-secondary ms-auto">
                <i class="fa fa-plus" aria-hidden="true"></i> Crear nuevo maestro
            </a>
        </div>       
    </div>
</section>
<section class="container">
    <div class="row">
        <div class="col-12">
        <?php if(isset($results)){ ?>
        <table id="maestros_admin_lista" class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>    
        </table>
        <?php }else{ ?>
        <div class="alert alert-info">
            <p>
                <i class="fa fa-exclamation" aria-hidden="true"></i> No existen datos para mostrar
            </p>
        </div>
        <?php } ?>            
        </div>
    </div>
</section>