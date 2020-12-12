<?php
foreach ($getTipopagamentos as $tipopagamentos): endforeach;
foreach ($getHistorico as $historicos): endforeach;
foreach ($getEncarregados as $encarregados): endforeach;
foreach ($getTurma as $turma): endforeach;
?>


<div class="module">
    <div class="module-body">
        <div class="profile-head media">
            <a href="#" class="media-avatar pull-left">
                <img src="<?php echo base_url(); ?>assets/images/user.png">
            </a>
            <div class="media-body">
                <h4>
                    <?php echo $historicos->nome; ?>
                    <small><?php echo $turma->turma; ?>&nbsp;&nbsp;<?php echo $historicos->ano_lectivo; ?></small>
                </h4>
                <p class="profile-brief">
                    Curso: <?php echo $turma->curso; ?><br/>
                    Turma: <?php echo $turma->turma . "  " . $turma->turno; ?><br/>
                    Encarregado: <?php echo $encarregados->nome_comparticipador; ?><br/>
                </p>
                <div class="profile-details muted">
                    <a href="<?php echo base_url() . "estudante/visualisar/{$this->session->userdata("id_estudantePAGA")}"; ?>"
                       class="btn"><i class="icon-bookmark"></i> Perfil Estudante </a>
                    <a href="<?php echo base_url() . "pagamento/efectuar/{$this->session->userdata("id_estudantePAGA")}"; ?>"
                       class="btn"><i class="icon-money"></i> Pagamentos </a>
                </div>
            </div>
        </div>
        <ul class="profile-tab nav nav-tabs">
            <li class="active"><a href="#pagar" data-toggle="tab">Novo</a></li>
            <li><a href="#historico" data-toggle="tab">Histórico</a></li>
        </ul>
        <div class="profile-tab-content tab-content">
            <div class="tab-pane fade active in" id="pagar">
                <div class="stream-list">

                    <!--/.media .stream-->
                    <div class="media stream">
                        <a href="#" class="media-avatar medium pull-left">
                            <img src="<?php echo base_url(); ?>assets/images/user.png">
                        </a>
                        <div class="media-body">
                            <div class="stream-headline">
                                <h5 class="stream-author">
                                    <?php echo $tipopagamentos->descricao; ?>
                                    <small><?php echo $tipopagamentos->modalidade; ?></small>
                                </h5>
                            </div>
                            <!--/.stream-headline-->
                            <div class="stream-options">
                                <a href="<?php echo base_url() . "pagamento/preparacao/$tipopagamentos->id_tipoPagamento"; ?>"
                                   class="btn btn-small"><i class="icon-arrow-left"></i> Voltar </a>
                                <a href="<?php
                                if ($encarregados->nome_comparticipador != ""): echo base_url() . "encarregado/comparticipador/$encarregados->id_comparticipadores";
                                endif;
                                ?>" class="btn btn-small"><i class="icon-user"></i>Encarregado </a>
                            </div>
                        </div>
                    </div>
                    <!--/.media .stream-->

                    <!--/.media .stream-->
                    <div class="media stream">
                        <div class="media-body" id="dados_pagamento">
                            <div class="row-fluid">
                                <div class="span12">
                                    <form class="form-horizontal row-fluid" name="form_cad" method="post"
                                          action="<?php echo base_url() . 'pagamento/efectuar_pagamento'; ?>">

                                        <div class="row-fluid">
                                            <div class="span5">
                                                <table class="table table-striped table-bordered table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Descrição</th>
                                                        <th>Valor(AKz)</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <!-- esta compilado-->

                                                    <?php foreach ($getNaoPagos as $naoPagos) : ?>
                                                        <tr>
                                                            <td><label class="checkbox check_naopagos"
                                                                       data-id_mes="<?php echo $naoPagos['id_mes']; ?>"
                                                                       data-mes="<?php echo $naoPagos['mes']; ?>"><input
                                                                            type="checkbox"
                                                                            value="<?php echo $naoPagos['id_mes']; ?>"
                                                                            name="id_mes[]"/> <?php echo $naoPagos['mes']; ?>
                                                                </label></td>
                                                            <td><?php echo $tipopagamentos->descricao; ?></td>
                                                            <td><?php echo number_format($tipopagamentos->valor, 2, ',', '.'); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <!-- fim-->


                                                    </tbody>
                                                </table>
                                                <span class="form_error"><?php echo form_error('id_mes[]'); ?></span>
                                            </div>
                                            <input type="hidden" name="preco" id="preco_pag"
                                                   value="<?php echo $tipopagamentos->valor; ?>"/>
                                            <div class="span5">
                                                <div class="controls">
                                                    <div id="calculos_naopagos">
                                                        ...calculando
                                                    </div>
                                                    <hr/>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                    &nbsp;&nbsp;
                                                    <button type="reset" class="btn btn-danger">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.media .stream-->

                    <div class="media stream load-more">
                        <a href="#"><i class="icon-refresh shaded"></i>Load more... </a>
                    </div>
                </div>
                <!--/.stream-list-->
            </div>
            <div class="tab-pane fade" id="historico">

                <div class="module-body">
                    <div class="row-fluid">
                        <div class="span8" id="meses_pagos">
                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Descrição</th>
                                    <th>Valor(AKz)</th>
                                </tr>
                                </thead>
                                <tbody>

                                <!-- esta compilado-->

                                <?php foreach ($getPagos as $Pagos) : ?>
                                    <tr>
                                        <td><label class="checkbox check_pagos"
                                                   data-id_mes="<?php echo $Pagos->id_mes; ?>"
                                                   data-data_pagamento="<?php echo $Pagos->data_pagamento; ?>"
                                                   data-hora_pagamento="<?php echo $Pagos->hora_pagamento; ?>"><?php echo $Pagos->mes; ?></label>
                                        </td>
                                        <td><?php echo $Pagos->descricao; ?></td>
                                        <td><?php echo number_format($Pagos->valor_pago, 2, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <!-- fim-->


                                </tbody>
                            </table>
                        </div>

                        <div class="span4" id="descricao_pagos">
                            ...carregar
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--/.module-body-->
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(".check_naopagos").click(function () {
            var total = $("input[type=checkbox]:checked").length;
            var valor = $("#preco_pag").val();
            carregar_calculos(total, valor);
        });

        $(".check_pagos").click(function () {
            var id_mes = $(this).data("id_mes");
            var data_pagamento = $(this).data("data_pagamento");
            var hora_pagamento = $(this).data("hora_pagamento");
            carregar_descricao(id_mes, data_pagamento, hora_pagamento);
        });

        function carregar_descricao(id_mes, data_pagamento, hora_pagamento) {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() . "pagamento/descricao_pagos";?>',
                data: {id_mes: id_mes, data_pagamento: data_pagamento, hora_pagamento: hora_pagamento},
                beforeSend: function () {
                    $("#descricao_pagos").text("carregando ...");
                },
                success: function (retorno) {
                    $("#descricao_pagos").html(retorno);
                }
            });

        }

        function carregar_calculos(total_meses, valor) {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() . "pagamento/calculos";?>',
                data: {total_meses: total_meses,
                valor: valor},
                beforeSend: function () {
                    $("#calculos_naopagos").text("carregando ...");
                },
                success: function (retorno) {
                    $("#calculos_naopagos").html(retorno);
                }
            });

        }

        return false;
    });
</script>