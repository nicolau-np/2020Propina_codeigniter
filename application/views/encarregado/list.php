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
                url: '<?php echo base_url() . "encarregado/datatable"; ?>',
                data: '',
                beforeSend: function () {
                    $(".data_table").text("carregando...");
                },
                success: function (retorno) {
                    $(".data_table").html(retorno);
                }
            });
        }

        function pesquisar(nome) {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() . "encarregado/pesquisa_encarregado"; ?>',
                data: {nome: nome},
                beforeSend: function () {
                    $(".data_table").text("carregando...");
                },
                success: function (retorno) {
                    $(".data_table").html(retorno);
                }
            });
        }

        function carregar_paginacao(pagina) {
            $(".data_table").load("<?php echo base_url() . 'encarregado/datatable/'; ?>" + pagina);
        }
    });
</script>
<div class="module">
    <div class="module-head">
        <h3><?php echo $submenu; ?></h3>
    </div>
    <div class="module-body">
        <p>  
        <form class="form-horizontal row-fluid" name="form_pesquisa" method="post" action="#">
            <div class="span4">
                <a href="#" title="Anterior" id="previous" class="btn btn-warning"><i class="icon icon-arrow-left"></i></a>
                &nbsp;&nbsp;&nbsp;
                <a href="#" title="Seguinte" id="next" class="btn btn-warning"><i class="icon icon-arrow-right"></i></a>
                &nbsp;&nbsp;&nbsp;
                <a href="<?php echo base_url() . "encarregado/novo"; ?>" title="Novo" id="new" class="btn btn-success"><i class="icon icon-plus"></i></a>
                &nbsp;&nbsp;&nbsp;
                <a href="#" title="Actualizar" id="refresh" class="btn btn-info"><i class="icon icon-refresh"></i></a>
            </div>
            <div class="span2"></div>
            <div class="span6">
                <div class="control-group">
                    <div class="controls">
                        <input type="text" id="search_t" placeholder="pesquisar..." class="span9">
                        <button name="bt_pesquisar" type="submit" class="btn btn-primary"><i class="icon icon-search"></i></button> 
                    </div>
                </div>
            </div>
        </form>
        </p>
        <hr/>
        <div class="data_table">

        </div>
    </div>
</div>


