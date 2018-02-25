<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS and CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url('assets/images/favicon.ico') ?>" type="image/x-icon">
    <title>ProRobot: O robô mais seguro do mundo</title>
  </head>

  <body>

  <!-- NAV -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="<?php echo base_url() ?>">ProRobot</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <?php if ($admin == '0') { ?>
          <li class="nav-item">
            <a class="nav-link active content1" href="javascript:" target="#content1">Sobre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link content2" href="javascript:" target="#content2">Contato</a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('admin') && $admin == '0') { ?>
          <li class="nav-item">
            <a class="nav-link contentAdmin" href="<?php echo base_url('contact') ?>" >Admin </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('admin') && $admin == '1') { ?>
            Olá <?php echo $this->session->userdata('nameAdmin') ?>
        <?php } ?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <?php if (!$this->session->userdata('admin')) { ?>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal" style="margin-right:10px">Login</button>
        <?php } else { ?>
          <a href='<?php echo base_url('home/logout') ?>' class="btn btn-primary" style="margin-right:10px" >Sair</a>
        <?php } ?>
      </form>
    </div>
</nav>

<!-- HEADER -->
<div class="full-container full-container-top" style="background-image:url(<?php echo base_url('assets/images/header.jpg') ?>)">
    <div class="container text-center container-top">
        <h1 class="display-3">ProRobot</h1>
        <h2 class="display-4 sub-title">O robô mais seguro do mundo</h2>
    </div>
</div>