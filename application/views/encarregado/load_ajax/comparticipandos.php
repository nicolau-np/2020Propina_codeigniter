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
                    <a class="btn btn-danger"  href="<?php echo base_url() . "encarregado/eliminar_encarregado/$estudantes->id_estudante"?>" title="Selecionar"><i class="icon icon-trash"></i></a>
                </td> 
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>








