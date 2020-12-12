<input type="hidden" id="txtna" value="<?php echo $pagina; ?>"/><input type="hidden" value="<?php echo $numpagina; ?>" id="txtna2"/>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th>Descrição</th>
            <th>Modalidade</th>
            <th>Valor</th>
            <th>Operações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $a = 0;
        foreach ($getPagamentos as $pagamentos):
            $a++;
            ?>
            <tr>
                <td><?php echo $a; ?></td>
                <td><?php echo $pagamentos->descricao; ?></td>
                <td><?php echo $pagamentos->modalidade; ?></td>
                <td><?php echo number_format($pagamentos->valor, 2, ',','.'); ?></td>
                <td>
                    <a class="btn btn-success" href="<?php echo base_url() . "pagamento/extra/$pagamentos->id_tipoPagamento";?>" title="Extras"><i class="icon icon-exchange"></i></a>&nbsp;&nbsp;&nbsp;
                   <a class="btn btn-info" href="#" title="Editar"><i class="icon icon-edit"></i></a>&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-danger" href="#" title="Eliminar"><i class="icon icon-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/jquery-1.5.2.js"></script>
<script>
    $(document).ready(function () {
        $("#previous").hide();
        $("#next").hide();

        var a = $("#txtna").val();
        var b = $("#txtna2").val();

        if (a != 1)
        {
            $("#previous").show();
        }
        if (a != b)
        {
            $("#next").show();
        }
    });
</script>


















