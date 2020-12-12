<script>
    $(document).ready(function () {
        carregar_registros();

        
        function carregar_registros() {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url() . "encarregado/datatable3"; ?>',
                data: '',
                beforeSend: function () {
                    $("#load_all").text("carregando...");
                },
                success: function (retorno) {
                    $("#load_all").html(retorno);
                }
            });
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
                
                </p>
                <div id="load_all">
                    dados  
                </div>

            </div>


        </div>
    </div>


</div>
</div>
