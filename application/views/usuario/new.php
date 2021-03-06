
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

        <form class="form-horizontal row-fluid" name="form_cad" method="post" action="<?php echo base_url() . 'usuario/save'; ?>">

            <div class="control-group">
                <label class="control-label field" for="nome"><span class="obrigatorio">*</span> Nome Completo:</label>
                <div class="controls">
                    <input type="text" name="nome" id="nome" placeholder="Nome Completo" class="span6" value="<?php echo set_value('nome');?>"/>
                    <span class="form_error"><?php echo form_error('nome'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="genero"><span class="obrigatorio">*</span> Gênero:</label>
                <div class="controls">
                    <select tabindex="1" name="genero" id="genero" data-placeholder="Selecione..." class="span3">
                        <option value="<?php echo set_value('genero');?>"><?php if(set_value('genero')!=""): if(set_value('genero')=="M"): echo "Masculino"; else: echo "Femenino"; endif; else: echo "Selecione...";endif;?></option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                    <span class="form_error"><?php echo form_error('genero'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="data_nascimento"><span class="obrigatorio">*</span> Data de Nascimento:</label>
                <div class="controls">
                    <input type="date" name="data_nascimento" id="data_nascimento" class="span3" value="<?php echo set_value('data_nascimento');?>"/>
                    <span class="form_error"><?php echo form_error('data_nascimento'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="bi"><span class="obrigatorio">*</span> Nº do B.I:</label>
                <div class="controls">
                    <input type="text" name="bi" id="bi" placeholder="Nº do B.I" class="span3" value="<?php echo set_value('bi');?>"/>
                    <span class="form_error"><?php echo form_error('bi'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="usuario"><span class="obrigatorio">*</span> Nome de Usuário:</label>
                <div class="controls">
                    <input type="text" name="usuario" id="usuario" placeholder="Nome de Usuário" class="span3" value="<?php echo set_value('usuario');?>"/>
                    <span class="form_error"><?php echo form_error('usuario'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="estado"><span class="obrigatorio">*</span> Estado:</label>
                <div class="controls">
                    <select tabindex="1" name="estado" id="estado" data-placeholder="Selecione..." class="span3">
                        <option value="<?php echo set_value('estado');?>"><?php if(set_value('estado')!=""): if(set_value('estado')=="on"): echo "ON"; else: echo "OFF"; endif; else: echo "Selecione...";endif;?></option>
                        <option value="on">ON</option>
                        <option value="off">OFF</option>
                    </select>
                    <span class="form_error"><?php echo form_error('estado'); ?></span>
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