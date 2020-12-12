<?php
foreach ($getDescricao as $descricao): endforeach;
?>
<style>
    #desc{
        color: #002a80;
        font-weight: bold;
    }
</style>
<div class="row-fluid">
        <div class="span12" id="desc">
            <?php echo $descricao->descricao;?><br/>
          <?php echo $descricao->mes;?><br/>
          <?php echo date("d/m/Y", strtotime($descricao->data_pagamento));?><br/>
            <?php echo $descricao->hora_pagamento;?><br/>
           <?php echo $descricao->nome_usuario;?><br/>
        </div>
    
    <div class="span12">
	<hr/>
        <a title = "Factiura" href="<?php echo base_url() . "pdf/gerar_factura/$descricao->id_estudante/$descricao->id_tipoPagamento/$descricao->ano_lectivo/$descricao->data_pagamento/$descricao->hora_pagamento";?>" class="btn btn-primary" >
            <i class="icon-file-alt"></i>
        </a>
	&nbsp;&nbsp;&nbsp;
	        <a title = "Delectar" href="<?php echo base_url() . "pagamento/eliminar/$descricao->id_pagamento";?>" class="btn btn-danger" >
            <i class="icon-trash"></i>
        </a>
    </div>
</div>




