<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= site_url() ?>"><img src="<?php echo base_url("assets/img/logos/"); ?>" class="img-fluid mx-auto d-block" style="max-width:120px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuadmin" aria-controls="menuadmin" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuadmin">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">                                         
            <li class="nav-link dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i> <?php echo $info_usuario->first_name." ".$info_usuario->last_name; ?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo site_url("admin/usuarios"); ?>">Usuarios</a></li>
                <li><a class="dropdown-item" href="<?php echo site_url("admin/grupos"); ?>">Grupos / Roles</a></li>
                <li><a class="dropdown-item" href="<?php echo site_url("admin/categorias"); ?>">Categor&iacute;as</a></li>
                <li><a class="dropdown-item" href="<?php echo site_url("admin/blog"); ?>">Contenidos</a></li>
                <li><a class="dropdown-item" href="<?php echo site_url("admin/empresas"); ?>">Empresas</a></li>
                <li><a class="dropdown-item" href="<?php echo site_url("admin/maestros"); ?>">Maestros</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?= site_url("login/logout") ?>">Cerrar Sesi&oacute;n</a></li>
            </ul>
            </li>
        </ul>
        </div>
    </div>
</nav>