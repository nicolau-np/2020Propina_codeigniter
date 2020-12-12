<meta charset="utf-8"/>
<?php
foreach ($getTurma as $turma): endforeach;
?>
Curso: <?php echo $turma->curso; ?> &nbsp;&nbsp; Classe: <?php echo $turma->classe; ?>
&nbsp;&nbsp; Turma: <?php echo $turma->turma; ?>&nbsp;&nbsp;
Turno: <?php echo $turma->turno; ?> &nbsp;&nbsp;
Ano Lectivo: <?php echo $ano_lectivo; ?>
<br/><br/>
<table border="1">
    <tr>
        <th>Nº</th>
        <th>Nome Completo</th>
        <th>Gênero</th>
        <th>Idade</th>
    </tr>
    <?php
    $a = 0;
    foreach ($getEstudante as $estudante):
        $a++;
        $ano_nascimento = explode('-', $estudante->data_nascimento);
        $idade = $ano_lectivo - $ano_nascimento[0];
        ?>
        <tr>
            <td><?php echo $a; ?></td>
            <td><?php echo $estudante->nome; ?></td>
            <td><?php echo $estudante->genero; ?></td>
            <td><?php echo $idade; ?></td>
        </tr>
    <?php endforeach; ?>
</table>