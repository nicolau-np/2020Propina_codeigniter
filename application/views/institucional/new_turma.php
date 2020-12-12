
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

        <form class="form-horizontal row-fluid" name="form_cad" method="post" action="<?php echo base_url() . 'institucional/save_turma'; ?>">
            <div class="control-group">
                <label class="control-label field" for="curso"><span class="obrigatorio">*</span> Curso:</label>
                <div class="controls">
                    <select tabindex="1" name="curso" id="curso" data-placeholder="Selecione..." class="span4">
                        <option value="">Selecione...</option>
                        <?php foreach ($getCurso as $curso):
                            if($curso->curso != "Nenhum"):
                            ?>
                        <option value="<?php echo $curso->id_curso;?>"><?php echo $curso->curso;?></option>
                        <?php endif; endforeach;?>
                    </select>
                    <span class="form_error"><?php echo form_error('curso'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="classe"><span class="obrigatorio">*</span> Classe:</label>
                <div class="controls">
                    <select tabindex="1" name="classe" id="classe" data-placeholder="Selecione..." class="span3">
                        <option value="">Selecione...</option>
                        <?php foreach ($getClasse as $classe):
                        if($classe->classe != "Nenhum"):
                        ?>
                        <option value="<?php echo $classe->id_classe;?>"><?php echo $classe->classe;?></option>
                        <?php endif; endforeach;?>
                    </select>
                    <span class="form_error"><?php echo form_error('classe'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="turno"><span class="obrigatorio">*</span> Turno:</label>
                <div class="controls">
                    <select tabindex="1" name="turno" id="turno" data-placeholder="Selecione..." class="span3">
                        <option value="">Selecione...</option>
                        <?php foreach ($getTurno as $turno):
                         if($turno->turno != "Nenhum"):
                          ?>
                        <option value="<?php echo $turno->id_turno;?>"><?php echo $turno->turno;?></option>
                        <?php endif; endforeach;?>
                    </select>
                    <span class="form_error"><?php echo form_error('turno'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="turma"><span class="obrigatorio">*</span> Turma:</label>
                <div class="controls">
                    <input type="text" name="turma" id="turma" class="span3" placeholder="Turma" value="<?php echo set_value('turma');?>"/>
                    <span class="form_error"><?php echo form_error('turma'); ?></span>
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


