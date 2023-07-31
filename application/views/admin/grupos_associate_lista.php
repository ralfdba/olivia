<section class="container">
    <div class="row padding-top30px">
        <div class="col-lg-8 col-sm-12">
            <h1 class="texto_celeste2">Administrador Asociaciones</h1>
            <p class="lead texto_azul_app">
                Agregue, edite o elimine asociaciones del sistema
            </p>
        </div>
        <div class="col-lg-2 col-sm-12 text-end">
            <a href="<?=site_url('admin/grupos/associate_create'); ?>" class="btn btn-secondary ms-auto bg_celeste2">
                <i class="fa fa-plus" aria-hidden="true"></i> Crear nueva asociaci&oacute;n
            </a>
        </div>
    </div>
</section>
<section class="container">
    <div class="row">
        <div class="col-12">
        <?php if(isset($results)){ ?>
        <table id="rolesasocciate_admin_lista" class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Controllers</th>
                    <th scope="col">Permisos</th>
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