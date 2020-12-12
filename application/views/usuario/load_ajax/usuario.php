<input type="hidden" id="txtna" value="<?php echo $pagina; ?>"/><input type="hidden" value="<?php echo $numpagina; ?>"
                                                                       id="txtna2"/>
<table class="table table-striped table-bordered table-condensed">
    <thead>
    <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Gênero</th>
        <th>Usuário</th>
        <th>Estado</th>
        <th>Operações</th>
    </tr>
    </thead>

    <tbody>
    <?php
    $a = 0;
    foreach ($getUsuario as $usuario):
        $a++;
      ?>
            <tr>
                <td><?php echo $a; ?></td>
                <td><?php echo $usuario->nome; ?></td>
                <td><?php echo $usuario->genero; ?></td>
                <td><?php echo $usuario->nome_usuario; ?></td>
                <td><?php echo $usuario->estado_usuario; ?></td>
                <td>
                    <a class="btn btn-success" href="<?php echo base_url() . "usuario/permissao/$usuario->id_usuario";?>" title="Permições"><i class="icon icon-lock"></i></a>&nbsp;&nbsp;&nbsp;
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

        if (a != 1) {
            $("#previous").show();
        }
        if (a != b) {
            $("#next").show();
        }
    });
</script>


