<?php
foreach ($getTurma as $turma): endforeach;
?>
<div class="module">
    <div class="module-head"><h3> <?php echo $submenu; ?></h3></div>
    <div class="module-body">
        <div class="row-fluid">
            <div class="span6" id="details">
                <fieldset class="span12">
                    <legend><label><i class="icon-list-alt"></i>&nbsp;&nbsp;Detalhes</label></legend>
                    <span class="field">Curso:</span>&nbsp;&nbsp;&nbsp;<span
                            class="value"><?php if ($turma->curso == "Nenhum"): echo "---"; else: echo $turma->curso; endif; ?></span>
                    <hr/>
                    <span class="field">Classe:</span>&nbsp;&nbsp;&nbsp;<span
                            class="value"><?php if ($turma->classe == "Nenhum"): echo "---"; else: echo $turma->classe; endif; ?></span>
                    <hr/>
                    <span class="field">Turma:</span>&nbsp;&nbsp;&nbsp;<span
                            class="value"><?php if ($turma->turma == "Nenhum"): echo "---"; else: echo $turma->turma; endif; ?></span>
                    <hr/>
                    <span class="field">Turno:</span>&nbsp;&nbsp;&nbsp;<span
                            class="value"><?php if ($turma->turno == "Nenhum"): echo "---"; else: echo $turma->turno; endif; ?></span><br/><br/>
                </fieldset>
            </div>
            <div class="span6" id="pagamentos">
                <fieldset class="span12">
                    <legend><label><i class="icon-money"></i>&nbsp;&nbsp;Pagamentos</label></legend>
                    <?php
                    if ($getPagamento['row_count'] <= 0):?>
                        <span>não efectuou nenhum registro de tipos de pagamentos.</span><br/><br/>
                    <?php
                    elseif ($getPagamento['row_count'] >= 1):
                        foreach ($getPagamento['dataset'] as $pagamento):
                            ?>
                            <span class="field"><?php echo $pagamento->descricao; ?></span>
                            (<?php echo $pagamento->modalidade . " - " . number_format($pagamento->valor, 2, ',', '.'); ?>
                            )<hr/>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </fieldset>
            </div>
        </div>
    </div>
    <div class="module-foot">
        <form name="form1" method="post" class="form_turma" action="<?php echo base_url() . "institucional/listas"; ?>">
            <div class="form-inline">
                <div class="controls">
                    <select name="id_tipoPagamento" class="span3" id="id_tipoPagamento">
                        <option value="">Tipo Pagamento</option>
                        <?php
                        foreach ($getTipoPagamento as $tipoPagamento):
                            ?>
                            <option value="<?php echo $tipoPagamento->id_tipoPagamento; ?>">
                                <?php echo $tipoPagamento->descricao; ?>
                                (<?php echo $tipoPagamento->modalidade . " - " . number_format($tipoPagamento->valor, 2, ',', '.'); ?>
                                )
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <input type="text" name="ano_lectivo" id="ano_lectivo" class="span2" placeholder="Ano Lectivo"/>
                    <span class="form_error"><?php echo form_error('ano_lectivo'); ?></span>
                    <button class="btn btn-info" type="submit" id="bt_pagamento" title="Pesquisar"><i
                                class="icon icon-search"></i></button>&nbsp;


                </div>
            </div>

        </form>
    </div>
</div>