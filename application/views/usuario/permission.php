<?php
foreach ($getUsuario as $usuario): endforeach;
?>
<div class="module">
    <div class="module-head">
        <h3><?php echo $submenu; ?></h3>
    </div>
    <div class="module-body">

        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>*</strong> Campos de preenchimento obrigatórios.
        </div>

        <br>
        <div class="row">
            <div class="span6">
                <form class="form-horizontal row-fluid" name="form_cad" method="post"
                      action="<?php echo base_url() . 'usuario/save_permission'; ?>">

                    <div class="control-group">
                        <label class="control-label field" for="nome"><span class="obrigatorio">*</span> Nome Completo:</label>
                        <div class="controls">
                            <input type="text" name="nome" id="nome" placeholder="Nome Completo" class="span6"
                                   value="<?php echo $usuario->nome; ?>"/>
                            <span class="form_error"><?php echo form_error('nome'); ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label field" for="usuario"><span class="obrigatorio">*</span> Nome de
                            Usuário:</label>
                        <div class="controls">
                            <input type="text" name="usuario" id="usuario" placeholder="Nome de Usuário" class="span6"
                                   value="<?php echo $usuario->nome_usuario; ?>"/>
                            <span class="form_error"><?php echo form_error('usuario'); ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label field" for="id_permicao"><span class="obrigatorio">*</span>
                            Permissões:</label>
                        <div class="controls">
                            <?php
                            foreach ($getPermicao as $permicao):
                                ?>
                                <input type="checkbox" name="id_permicao[]" id="id_permicao"
                                       value="<?php echo $permicao->id_tipoPermicao; ?>"/> <?php echo $permicao->descricao_permicao; ?>
                                <br/>
                            <?php
                            endforeach; ?>
                            <span class="form_error"><?php echo form_error('id_permicao[]'); ?></span>
                        </div>
                    </div>


                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            &nbsp;&nbsp;
                            <button type="reset" class="btn btn-danger">Cancelar</button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="span2">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Permissões</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $a = 0;
                    foreach ($getPerExistentes as $perExistente):
                        $a++;
                        ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><?php echo $perExistente->descricao_permicao; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>