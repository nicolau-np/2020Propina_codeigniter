<script>
    $(document).ready(function () {
        carregar_registros();

        $("#previous").click(function () {
            var i = parseInt($("#txtna").val()) - 1;
            carregar_paginacao(i);
        });

        $("#next").click(function () {
            var o = parseInt($("#txtna").val()) + 1;
            carregar_paginacao(o);
        });


        $("#refresh").click(function () {
            carregar_registros();
        });

        $("#search_t").keyup(function () {
            var nome = $(this).val();
            if (nome != null && nome != "") {
                pesquisar(nome);
            }
        });

        function carregar_registros() {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() . "encarregado/datatable2"; ?>',
                data: '',
                beforeSend: function () {
                    $("#load_all").text("carregando...");
                },
                success: function (retorno) {
                    $("#load_all").html(retorno);
                }
            });
        }

        function pesquisar(nome) {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() . "encarregado/pesquisa"; ?>',
                data: {nome: nome},
                beforeSend: function () {
                    $("#load_all").text("carregando...");
                },
                success: function (retorno) {
                    $("#load_all").html(retorno);
                }
            });
        }

        function carregar_paginacao(pagina) {
            $("#load_all").load("<?php echo base_url() . 'encarregado/datatable2/'; ?>" + pagina);
        }
    });
</script>
<?php
foreach ($getComparticipador as $comparticipador): endforeach;
?>
<div class="module">
    <div class="module-head">
        <h3><i class="icon icon-user"></i> <?php echo $comparticipador->nome_comparticipador; ?></h3>
    </div>
    <div class="module-body">

        <div class="row-fluid">
            <div class="span12">
                <p>  
                <form class="form-horizontal row-fluid" name="form_pesquisa" method="post" action="#">
                    <div class='row-fluid'>
                        <div class="span3">
                            <a href="#" title="Anterior" id="previous" class="btn btn-warning"><i class="icon icon-arrow-left"></i></a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="#" title="Seguinte" id="next" class="btn btn-warning"><i class="icon icon-arrow-right"></i></a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="#" title="Actualizar" id="refresh" class="btn btn-info"><i class="icon icon-refresh"></i></a>
                        </div>
                        <div class="span3"></div>
                        <div class="span6">
                            <div class="control-group">
                                <div class="controls">
                                    <input type="text" id="search_t" placeholder="pesquisar..." class="span9">
                                    <button name="bt_pesquisar" type="submit" class="btn btn-primary"><i class="icon icon-search"></i></button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </p>
                <hr/>
                <div id="load_all">
                    dados  
                </div>

            </div>


        </div>
    </div>


</div>
</div>


