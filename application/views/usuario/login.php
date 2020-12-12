<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
    <i class="icon-reorder shaded"></i>
</a>

<a class="brand" href="index.html">
    NQ Propina
</a>

<div class="nav-collapse collapse navbar-inverse-collapse">

    <ul class="nav pull-right">

        <li><a href="#">
                Criar Conta
            </a></li>



        <li><a href="#">
                Esqueceu a sua Passe?
            </a></li>
    </ul>
</div><!-- /.nav-collapse -->
</div>
</div><!-- /navbar-inner -->
</div><!-- /navbar -->



<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="module module-login span4 offset4">
			<?php echo form_open(base_url() . "usuario/logar"); ?>
                <!-- <form class="form-vertical" method="post" action="<?php //echo base_url() . "usuario/logar";?>">-->
                    <div class="module-head">
                        <h3>Login</h3>
                    </div>
                    <div class="module-body">
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <input class="span12" type="text" name="usuario" id="inputEmail" value="<?php echo set_value('usuario');?>" placeholder="Nome de usuário">
                                <span class="form_error"><?php echo form_error('usuario'); ?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <input class="span12" type="password" name="palavra_passe" id="inputPassword" placeholder="Palavra-Passe">
                                <span class="form_error"><?php echo form_error('palavra_passe'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="module-foot">
                        <div class="control-group">
                            <div class="controls clearfix">
                                <button type="submit" class="btn btn-primary pull-right">Entrar</button>
                                <label class="checkbox">
                                    <input type="checkbox"> Lembrar-me
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>












