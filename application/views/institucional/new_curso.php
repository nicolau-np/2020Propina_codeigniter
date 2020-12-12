
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

        <form class="form-horizontal row-fluid" name="form_cad" method="post" action="<?php echo base_url() . 'Institucional/save_curso'; ?>">
            <div class="control-group">
                <label class="control-label field" for="curso"><span class="obrigatorio">*</span> Nome do curso:</label>
                <div class="controls">
                    <input type="text" name="curso" id="curso" placeholder="Nome do curso" class="span6" value="<?php echo set_value('curso');?>"/>
                    <span class="form_error"><?php echo form_error('curso'); ?></span>
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


