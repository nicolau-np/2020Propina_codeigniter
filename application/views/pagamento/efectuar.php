<div class="row-fluid" id="modalidades">
    <div class="span8">

        <div class="row-fluid">
            <div class="span12">
                <?php
                foreach ($getPagamentos as $pagamentos):
                    ?>
                    <a title="<?php echo $pagamentos->descricao . " " . number_format($pagamentos->valor, 2, ',', '.'); ?>"
                       href="<?php echo base_url() . "pagamento/preparacao/$pagamentos->id_tipoPagamento"; ?>"
                       class="btn-box small span4">
                        <i class="icon-money"></i>
                        <b><?php echo $pagamentos->descricao; ?></b>
                        <p class="text-muted">
                            <?php echo $pagamentos->modalidade . " " . number_format($pagamentos->valor, 2, ',', '.'); ?>
                        </p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
</div>
    <?php foreach ($getEstudantes as $estudantes): endforeach; ?>
    <div class="span4">
        <div class="module">
            <div class="module-head">
                <h3><i class="icon-user"></i> <?php echo $estudantes->nome; ?></h3>
            </div>
            <div class="module-body" id="dados_estudante">
                <span class="field">Curso:</span> <span
                        class="value"><?php if ($estudantes->curso == "Nenhum"): echo "---"; else: echo $estudantes->curso; endif; ?></span>
                <hr/>
                <span class="field">Classe:</span> <span
                        class="value"><?php if ($estudantes->classe == "Nenhum"): echo "---"; else: echo $estudantes->classe; endif; ?></span>
                <hr/>
                <span class="field">Turma:</span> <span
                        class="value"><?php if ($estudantes->turma == "Nenhum"): echo "---"; else: echo $estudantes->turma; endif; ?></span>
                <hr/>
                <span class="field">Turno:</span> <span
                        class="value"><?php if ($estudantes->turno == "Nenhum"): echo "---"; else: echo $estudantes->turno; endif; ?></span>
            </div>
            <div class="module-foot">
                <?php
                if ($extra['row_count'] >= 1):
                    foreach ($extra['dataset'] as $tipoPagamentos):
                        ?>
                        <a href="<?php echo base_url() . "pagamento/preparacao/$tipoPagamentos->id_tipoPagamento"; ?>"
                           title="<?php echo $tipoPagamentos->descricao . " " . number_format($tipoPagamentos->valor, 2, ',', '.'); ?>"
                           class="btn btn-warning btn-small"><i class="icon-money"></i> </a>
                    <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
</div>
