<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $titulo; ?></title>
        <link type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.min.css"
              rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url(); ?>assets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
              rel='stylesheet'>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/jquery-1.5.2.js"></script>
    </head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <?php
            if ($tipo != "login"):
            ?>
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a><a class="brand" href="<?php echo base_url() . "home"; ?>">NQ
                Propina </a>
            <div class="nav-collapse collapse navbar-inverse-collapse">
                <ul class="nav nav-icons">
                    <li class="active"><a href="#"><i class="icon-envelope"></i></a></li>
                    <li><a href="#"><i class="icon-eye-open"></i></a></li>
                    <li><a href="#"><i class="icon-bar-chart"></i></a></li>
                </ul>
                <form class="navbar-search pull-left input-append" action="#">
                    <input type="text" class="span3">
                    <button class="btn" type="button">
                        <i class="icon-search"></i>
                    </button>
                </form>
                <ul class="nav pull-right">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Tarefas
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Item No. 1</a></li>
                            <li><a href="#">Don't Click</a></li>
                            <li class="divider"></li>
                            <li class="nav-header">Example Header</li>
                            <li><a href="#">A Separated link</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Suporte </a></li>
                    <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo base_url(); ?>assets/images/user.png" class="nav-avatar"/>
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Meu Perfil</a></li>
                            <li><a href="#">Editar Perfil</a></li>
                            <li><a href="#">Configurações</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url() . "usuario/terminar_sessao"; ?>">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="span3">
                <div class="sidebar">
                    <ul class="widget widget-menu unstyled">
                        <li class="active"><a href="<?php echo base_url() . "home"; ?>"><i
                                        class="menu-icon icon-home"></i>Home
                            </a></li>
                        <?php if($this->session->has_userdata('all')):?>
                        <li><a href="<?php echo base_url() . "usuario/listar"; ?>"><i class="menu-icon icon-user"></i>Usuários
                            </a></li>
                        <?php endif;?>
                        <?php if($this->session->has_userdata('all') || $this->session->has_userdata('restrit 1') || $this->session->has_userdata('restrit 2') || $this->session->has_userdata('restrit 3')):?>
                        <li><a href="<?php echo base_url() . "estudante"; ?>"><i class="menu-icon icon-group"></i>Estudantes
                            </a></li>
                        <?php endif;?>
                        <?php if($this->session->has_userdata('all') || $this->session->has_userdata('restrit 1') || $this->session->has_userdata('restrit 2') || $this->session->has_userdata('restrit 3')):?>
                        <li><a href="<?php echo base_url() . "encarregado"; ?>"><i class="menu-icon icon-truck"></i>Encarregados
                            </a></li>
                        <?php endif;?>
                    </ul>
                    <!--/.widget-nav-->


                    <ul class="widget widget-menu unstyled">
                        <?php if($this->session->has_userdata('all') || $this->session->has_userdata('restrit 1')):?>
                        <li><a href="<?php echo base_url() . "pagamento"; ?>"><i class="menu-icon icon-money"></i>
                                Pagamentos </a></li>
                        <?php endif;?>
                        <?php if($this->session->has_userdata('all')):?>
                        <li><a href="<?php echo base_url() . "balanco"; ?>"><i class="menu-icon icon-book"></i>Balanços
                            </a></li>
                        <?php endif;?>
                        <?php if($this->session->has_userdata('all') || $this->session->has_userdata('restrit 1')):?>
                        <li><a href="<?php echo base_url() . "estatistica"; ?>"><i class="menu-icon icon-bar-chart"></i>Estatística
                            </a></li>
                        <?php endif;?>
                        <?php if($this->session->has_userdata('all') || $this->session->has_userdata('restrit 1')):?>
                        <li><a href="<?php echo base_url() . "institucional"; ?>"><i
                                        class="menu-icon icon-building"></i>Institucional </a></li>
                        <?php endif;?>
                    </ul>
                    <!--/.widget-nav-->
                    <ul class="widget widget-menu unstyled">
                        <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i
                                        class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Outros </a>
                            <ul id="togglePages" class="collapse unstyled">
                                <?php if($this->session->has_userdata('all')):?>
                                <li><a href="other-login.html"><i class="icon-cogs"></i> Configurações </a></li>
                                <?php endif;?>
                                <li><a href="<?php echo base_url(). "home/sobre";?>"><i class="icon-file-alt"></i> Sobre </a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url() . "usuario/terminar_sessao"; ?>"><i
                                        class="menu-icon icon-signout"></i>Sair </a></li>
                    </ul>
                </div>
                <!--/.sidebar-->
            </div>
            <!--/.span3-->

            <div class="span9">
                <div class="content">
                    <?php endif; ?>
