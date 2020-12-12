<input type="hidden" id="txtna" value="<?php echo $pagina; ?>"/><input type="hidden" value="<?php echo $numpagina; ?>"
                                                                       id="txtna2"/>
<table class="table table-striped table-bordered table-condensed">
    <thead>
    <tr>
        <th>#</th>
        <th>Turma</th>
        <th>Curso</th>
        <th>Classe</th>
        <th>Turno</th>
        <th>Operações</th>
    </tr>
    </thead>

    <tbody>
    <?php
    $a = 0;
    foreach ($getTurma as $turma):
        $a++;
        if ($turma->turma != "Nenhum"):
            ?>
            <tr>
                <td><?php echo $a; ?></td>
                <td><?php echo $turma->turma; ?></td>
                <td><?php echo $turma->curso; ?></td>
                <td><?php echo $turma->classe; ?></td>
                <td><?php echo $turma->turno; ?></td>
                <td>
                    <a class="btn btn-warning" href="<?php echo base_url() . "institucional/turmas_details/$turma->id_turma";?>" title="Detalhes"><i class="icon icon-list-alt"></i></a> &nbsp;&nbsp;
                    <a class="btn btn-info" href="#" title="Editar"><i class="icon icon-edit"></i></a>&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-danger" href="#" title="Eliminar"><i class="icon icon-trash"></i></a>
                </td>
            </tr>
        <?php endif; endforeach; ?>
    </tbody>
</table>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/jquery-1.5.2.js"></script>
<script>
    $(document).ready(function () {
        $("#previous").hide();
        $("#next").hide();

        var a = $("#txtna").val();
        var b = $("#txtna2").val();

        if (a != 1) {
            $("#previous").show();
        }
        if (a != b) {
            $("#next").show();
        }
    });
</script>


