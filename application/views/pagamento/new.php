
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

        <form class="form-horizontal row-fluid" name="form_cad" method="post" action="<?php echo base_url() . 'pagamento/save'; ?>">

            <div class="control-group">
                <label class="control-label field" for="id_listaPagamento"><span class="obrigatorio">*</span> Tipo:</label>
                <div class="controls">
                    <select tabindex="1" name="id_listaPagamento" id="id_listaPagamento" data-placeholder="Selecione..." class="span4">
                        <option value="">Selecione...</option>
                        <?php
                        foreach ($getListapagamento as $listapagamento):
                            ?>
                            <option value="<?php echo $listapagamento->id_listaPagamento; ?>"><?php echo $listapagamento->descricao; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                    <span class="form_error"><?php echo form_error('id_listaPagamento'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="id_modalidade"><span class="obrigatorio">*</span> Modalidade:</label>
                <div class="controls">
                    <select tabindex="1" name="id_modalidade" id="id_modalidade" data-placeholder="Selecione..." class="span3">
                        <option value="">Selecione...</option>
                        <?php
                        foreach ($getModalidade as $modalidade):
                            ?>
                            <option value="<?php echo $modalidade->id_modalidade; ?>"><?php echo $modalidade->modalidade; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                    <span class="form_error"><?php echo form_error('id_modalidade'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label field" for="valor"><span class="obrigatorio">*</span> Valor:</label>
                <div class="controls">
                    <input type="number" name="valor" id="valor" placeholder="Valor" class="span3" value="<?php echo set_value('valor'); ?>"/>
                    <span class="form_error"><?php echo form_error('valor'); ?></span>
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
