<?php
foreach ($gettipoPagamento as $tipoPagamento): endforeach;
?>
<div class="module">
    <div class="module-head">
        <h3><?php echo $submenu; ?> <i class="icon-circle"></i> <?php echo $tipoPagamento->descricao; ?> <i
                    class="icon-circle"></i> <?php echo $tipoPagamento->modalidade; ?>
            <i class="icon-circle"></i> <?php echo number_format($tipoPagamento->valor, 2, ',', '.'); ?></h3>
    </div>
    <div class="module-body">

        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>*</strong> Campos de preenchimento obrigatórios.
        </div>

        <br>

        <form class="form-horizontal row-fluid" name="form_cad" method="post"
              action="<?php echo base_url() . 'pagamento/save_extra'; ?>">

            <div class="control-group">
                <div class="row-fluid">
                    <div class="span5">
                        <label class="control-label field" for="id_curso"><span class="obrigatorio">*</span>
                            Curso:</label>
                        <div class="controls">
                            <select tabindex="1" name="id_curso" id="id_curso" data-placeholder="Selecione..."
                                    class="span12">
                                <option value="">Selecione...</option>
                                <?php
                                foreach ($getCurso as $cursos):
                                    if ($cursos->curso != "Nenhum"):
                                        ?>
                                        <option value="<?php echo $cursos->id_curso; ?>"><?php echo $cursos->curso; ?></option>
                                    <?php endif;
                                endforeach;
                                ?>
                            </select>
                            <span class="form_error"><?php echo form_error('id_curso'); ?></span>
                        </div>
                    </div>
                    <div class="span5">
                        <label class="control-label field" for="id_turno"><span class="obrigatorio">*</span>
                            Turno:</label>
                        <div class="controls">
                            <select tabindex="1" name="id_turno" id="id_turno" data-placeholder="Selecione..."
                                    class="span10">
                                <option value="all">Todos...</option>
                                <?php
                                foreach ($getTurno as $turnos):
                                    if ($turnos->turno != "Nenhum"):
                                        ?>
                                        <option value="<?php echo $turnos->id_turno; ?>"><?php echo $turnos->turno; ?></option>
                                    <?php endif;
                                endforeach;
                                ?>
                            </select>

                            <span class="form_error"><?php echo form_error('id_turno'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="id_classe"><span class="obrigatorio">*</span> Classes: </label>
                <div class="controls">
                    <?php
                    $desc = null;
                    foreach ($getClasse as $classe):

                        if ($classe->classe != "Nenhum"):
                            if ($classe->classe != "Iniciação"):
                                $desc = "classe";
                            endif;
                            ?>
                            <input type="checkbox" name="id_classe[]" id="id_classe"
                                   value="<?php echo $classe->id_classe; ?>"/>&nbsp;&nbsp;<?php echo $classe->classe . " " . $desc; ?>
                            <br/>
                        <?php endif; endforeach; ?>
                    <span class="form_error"><?php echo form_error('id_classe[]'); ?></span>
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
</div>
