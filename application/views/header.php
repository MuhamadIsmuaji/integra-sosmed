<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Integra Social Media</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- css libs -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bulma.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/font-awesome.min.css') ?>">  
    
    <!-- js libs -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/nav.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/app.js') ?>"></script>    
    <script type="text/javascript" src="<?= base_url('assets/js/ckeditor.js') ?>"></script>    
    
</head>
<body>

<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="<?= base_url('/') ?>">
            Integra Social Media
        </a>
        <div class="navbar-burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="navbar-menu" id="navMenu">
        <div class="navbar-end">
            <?php if ($user = $this->session->userdata('integra-sosmed')) { ?>
                
                <a href="<?= base_url('posts') ?>" class="navbar-item">Statusku</a>                                    
                
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link"><?= $user->name ?></a>
                    <div class="navbar-dropdown">
                        <!-- <a class="navbar-item">
                            Pengaturan Profil
                        </a> -->
                        <!-- <hr class="navbar-divider"> -->
                        <a href="<?= base_url('logout') ?>" class="navbar-item">Keluar</a>
                    </div>
                </div>
            <?php } else { ?>
                <a href="<?= base_url('login') ?>" class="navbar-item">Masuk</a>
                <a href="<?= base_url('register') ?>" class="navbar-item">Daftar</a>
            <?php } ?>

        </div>
    </div>
</nav>