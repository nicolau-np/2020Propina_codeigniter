<?php 
foreach ($getEstudantes as $estudantes): endforeach;?>

<div class="module">
    <div class="module-head"><h3><i class="icon-user"></i> <?php echo $estudantes->nome;?></h3></div>
    <div class="module-body">
        <div class="row-fluid">
            <div class="span6" id="dados_pessoais">
                <fieldset class="span12">
                    <legend><label><i class="icon-user"></i>&nbsp;&nbsp;Pessoais</label></legend>
                    <span class="field">Nome Completo:</span>&nbsp;&nbsp;&nbsp;<span class="value"><?php echo $estudantes->nome; ?></span><hr/>
                    <span class="field">Data de Nascimento:</span>&nbsp;&nbsp;&nbsp;<span class="value"><?php echo date("d/m/Y", strtotime($estudantes->data_nascimento)); ?></span><hr/>
                    <span class="field">Gênero:</span>&nbsp;&nbsp;&nbsp;<span class="value"><?php if($estudantes->genero == "M"): echo "Masculino"; else: echo "Femenino"; endif; ?></span><hr/>
                    <span class="field">Nº de B.I:</span>&nbsp;&nbsp;&nbsp;<span class="value"><?php if($estudantes->bi == ""): echo "---"; else: echo $estudantes->bi; endif; ?></span><hr/>
                     <span class="field">Encarregado:</span>&nbsp;&nbsp;&nbsp;<span class="value"><?php  echo $encarregado; ?></span><br/><br/>
                </fieldset>
            </div>
            <div class="span6" id="dados_academicos">
                <fieldset class="span12">
                    <legend><label><i class="icon-briefcase"></i>&nbsp;&nbsp;Acadêmicos</label></legend>
                    <span class="field">Curso:</span>&nbsp;&nbsp;&nbsp;<span class="value"><?php if($estudantes->curso == "Nenhum"): echo "---"; else: echo $estudantes->curso; endif; ?></span><hr/>
                    <span class="field">Classe:</span>&nbsp;&nbsp;&nbsp;<span class="value"><?php if($estudantes->classe == "Nenhum"): echo "---"; else: echo $estudantes->classe; endif; ?></span><hr/>
                    <span class="field">Turma:</span>&nbsp;&nbsp;&nbsp;<span class="value"><?php if($estudantes->turma == "Nenhum"): echo "---"; else: echo $estudantes->turma; endif; ?></span><hr/>
                    <span class="field">Turno:</span>&nbsp;&nbsp;&nbsp;<span class="value"><?php if($estudantes->turno == "Nenhum"): echo "---"; else: echo $estudantes->turno; endif; ?></span><hr/>
                    <span class="field">Ano Lectivo:</span>&nbsp;&nbsp;&nbsp;<span class="value"><?php echo $estudantes->ano_lectivo;?></span><br/><br/>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="module-foot">
        <a class="btn btn-primary" href="<?php echo base_url() . "estudante/confirmacao/$estudantes->id_estudante/$estudantes->id_pessoa";?>" title="Confirmação"><i class="icon icon-check"></i></a>&nbsp;&nbsp;&nbsp;
       <a class="btn btn-success" href="<?php echo base_url(). "pagamento/efectuar/$estudantes->id_estudante";?>" title="Pagamento"><i class="icon icon-money"></i></a>&nbsp;&nbsp;&nbsp;
       <a class="btn btn-info" href="#" title="Editar"><i class="icon icon-edit"></i></a>&nbsp;&nbsp;&nbsp;
       <a class="btn btn-danger" href="#" title="Eliminar"><i class="icon icon-trash"></i></a> 
    </div>
</div>






























