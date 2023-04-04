<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->config->item('titulo');?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href=<?=base_url("assets/css/root.css")?> rel="stylesheet">
    <link href=<?=base_url("assets/css/admin.css")?> rel="stylesheet"> 
    </head>
    <body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url() ?>"><img src="https://gomind.cl/assets/img/logo_go-mind.png" class="img-fluid mx-auto d-block" style="max-width:120px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuadmin" aria-controls="menuadmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuadmin">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo site_url(); ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo site_url("admin/usuarios"); ?>">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo site_url("admin/grupos"); ?>">Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo site_url("admin/categorias"); ?>">Categor&iacute;as</a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo site_url("admin/blog"); ?>">Contenidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo site_url("admin/empresas"); ?>">Empresas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo site_url("admin/agenda"); ?>">Agenda</a>
                </li>                                 
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user-gear"></i> <?php echo $info_usuario->email; ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= site_url("login/logout") ?>">Cerrar Sesi&oacute;n</a></li>
                </ul>
                </li>
            </ul>
            <!--
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar por..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
            -->
            </div>
        </div>
    </nav>    
    <div class="container">
