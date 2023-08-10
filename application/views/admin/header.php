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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Olivia fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href=<?=base_url("assets/css/root.css")?> rel="stylesheet">
    <link href=<?=base_url("assets/css/admin.css")?> rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?php echo site_url("assets/logo/olivia-logo.svg"); ?>">
    </head>
    <body>
    <?php include("navegacion.php"); ?>
    <section class="container-fluid breadcrumbs-bg">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst( $this->router->fetch_class() ); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <div class="container">
