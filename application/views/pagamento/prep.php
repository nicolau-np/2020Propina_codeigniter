
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

        <form class="form-horizontal row-fluid" name="form_cad" method="post" action="<?php echo base_url() . 'pagamento/confirmar_ano'; ?>">

            <div class="control-group">
                <label class="control-label field" for="ano_lectivo"><span class="obrigatorio">*</span> Ano Lectivo:</label>
                <div class="controls">
                    <input type="number" name="ano_lectivo" id="ano_lectivo" placeholder="Ano Lectivo" class="span3" value="<?php echo set_value('ano_lectivo'); ?>"/>
                    <span class="form_error"><?php echo form_error('ano_lectivo'); ?></span>
                    
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i></button>
                </div>
            </div>

        </form>
    </div>
</div>
