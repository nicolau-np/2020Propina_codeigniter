
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

                <form class="form-horizontal row-fluid" name="form_cad" method="post" action="<?php echo base_url() . 'encarregado/save'; ?>">
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
                        <label class="control-label field" for="telefone">Telefone:</label>
                        <div class="controls">
                            <input type="tel" name="telefone" id="telefone" class="span3" placeholder="Nº de Telf." value="<?php echo set_value('telefone');?>"/>
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


