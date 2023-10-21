<!doctype html>
<html lang="en">

<head>
    <title><?= $this->renderSection('title') ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= $this->renderSection('metas') ?>
    <link rel="shortcut icon" href="<?php echo base_url() ?>public/images/logon (1).ico" type="image/x-icon" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/socialRedes.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/fotsRedes.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta2/css/all.css" integrity="xxxxxxxxxxxxxxxx" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />

    <!-- Incluir los archivos de Vue.js y Vue Carousel -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/comprasEcomerce.css">

</head>

<body style='margin-top: 100px;'>
    <?= $this->include('ecomerce/templates/redes') ?>
    <?= $this->include('ecomerce/templates/header') ?>

    <?= $this->renderSection('content') ?>

    <?= $this->include('ecomerce/templates/foother') ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script src="<?php echo base_url() ?>public/js/ecomerce/carrito.js">
    </script>




</body>

</html>