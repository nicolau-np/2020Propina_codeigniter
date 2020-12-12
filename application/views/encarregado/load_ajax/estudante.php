<input type="hidden" id="txtna" value="<?php echo $pagina; ?>"/><input type="hidden" value="<?php echo $numpagina; ?>" id="txtna2"/>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Nascimento</th>
            <th>Turma</th>
            <th>Operações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $a = 0;
        foreach ($getEstudantes as $estudantes):
            $a++;
            ?>
            <tr>
                <td><?php echo $a; ?></td>
                <td><?php echo $estudantes->nome; ?></td>
                <td><?php echo $estudantes->genero; ?></td>
                <td><?php echo date("d/m/Y", strtotime($estudantes->data_nascimento)); ?></td>
                <td><?php echo $estudantes->turma; ?></td>
                <td>
                    <a class="btn btn-primary"  href="<?php echo base_url() . "encarregado/salvar_encarregado/$estudantes->id_estudante"?>" title="Selecionar"><i class="icon icon-check"></i></a>
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
