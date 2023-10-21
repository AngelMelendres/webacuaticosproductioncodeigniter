<!doctype html>
<html lang="en">

<head>
    <title><?= $this->renderSection('title') ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?php echo base_url() ?>public/images/logon (1).ico" type="image/x-icon" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/7cb66316e2.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/admin/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/css/admin/main.css">


    <?= $this->renderSection('CSSS') ?>

    <style>
        body {
            zoom: 0.95;
        }
    </style>
</head>



<body>

    <?= $this->include('admin/templates/aside') ?>
    <section class="full-width pageContent">
        <?= $this->include('admin/templates/header') ?>
        <section class="container">
            <?= $this->renderSection('contentAdmin') ?>
        </section>
    </section>



    <!-- SCRIPTS  -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
    <script src="<?php echo base_url() ?>public/js/admin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script src="<?php echo base_url() ?>public/js/admin/main.js"></script>
    <?= $this->renderSection('JSSS') ?>
</body>

</html>