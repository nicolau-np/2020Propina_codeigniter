<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("PagamentoMDL", "pagamentomdl");
        $this->load->model("HistoricoMDL", "historicomdl");
        $this->load->model("TurmaMDL", "turmamdl");
        $this->load->model("EstComparticipadoresMDL", "estComparticipadores");
        $this->load->model("TipoPagamentoMDL", "tipopagamentomdl");
        $this->load->model("MesMDL", "mesmdl");
        $this->load->model("EstudanteMDL", "estudantemdl");
        $this->load->model("HistoricoMDL", "historicomdl");
    }


    public function designer_factura($dataset, $dataset1)
    {
        foreach ($dataset1['dataset'] as $historico) {

        }
        foreach ($dataset['dataset'] as $pagamento) {

        }
        $dataset2 = $this->turmamdl->verificar(array('id_turma' => $historico->id_turma));
        foreach ($dataset2['dataset'] as $turma) {

        }

        $string_data = explode("-", $pagamento->data_pagamento);

        $string_hora = explode(":", $pagamento->hora_pagamento);


        $html = "<div class='pagina'><br/>";
        /* cabecalho */
        $html .= "<div class='cabecalho' style='font-size:15px; font-weight:bold;'>
		Instituto Técnico Privado Colégio Esperança<br/><br/>
		$pagamento->descricao<br/><br/>
		
				Factura nº " . ($string_data[0]) . "" . ($string_data[1]) . "" . ($string_data[2]) . "" . ($string_hora[0]) . "" . ($string_hora[1]) . "" . ($string_hora[2]) . "
		<hr/>
                </div>";
        /* fim */

        /* conteudo */
        $html .= "<div class='conteudo'>
			<div class='dados_pessoais'>
			Nome: $historico->nome<br/>
				Turma: $turma->turma<br/>
				Data & Hora: " . (date("d/m/Y", strtotime($pagamento->data_pagamento))) . " $pagamento->hora_pagamento
			</div>
		<hr/>

                <table border='1'>
                    <tr>
                        <td>Meses</td>
                        <td>Valor</td>
                    </tr>
        ";
        $total_pago = 0;
        foreach ($dataset['dataset'] as $pagamento):
            $total_pago += $pagamento->valor_pago;
            $html .= "<tr>
                    <td>$pagamento->mes</td>
                    <td>" . (number_format($pagamento->valor_pago, 2, ',', '.')) . "</td>
                  </tr>
        ";
        endforeach;

        $html .= "
                </table>
		<hr/>
		Total Pago: " . (number_format($total_pago, 2, ',', '.')) . "
		
                  </div>";
        /* fim */

        /* rodape */
        $html .= "<div class='rodape'></div>";
        /* fim */

        $html .= "</div>";

        return $html;
    }

    public function designer_facturaCompart($dataset, $dataset1)
    {
        foreach ($dataset1['dataset'] as $historico) {
        }
        foreach ($dataset['dataset'] as $pagamento) {
        }
        $dataset2 = $this->turmamdl->verificar(array('id_turma' => $historico->id_turma));
        foreach ($dataset2['dataset'] as $turma) {
        }
        $dataset3 = $this->estComparticipadores->verificar(array('id_estudante' => $historico->id_estudante));
        foreach ($dataset3['dataset'] as $comparticipador) {
        }
        $dataset4 = $this->estComparticipadores->verificar(array('id_comparticipadores' => $comparticipador->id_comparticipadores));

        $string_data = explode("-", $pagamento->data_pagamento);

        $string_hora = explode(":", $pagamento->hora_pagamento);


        $html = "<div class='pagina'><br/>";
        /* cabecalho */
        $html .= "<div class='cabecalho' style='font-size:15px; font-weight:bold;'>
		Instituto Técnico Privado Colégio Esperança<br/><br/>
		$pagamento->descricao<br/><br/>
		
				Factura nº " . ($string_data[0]) . "" . ($string_data[1]) . "" . ($string_data[2]) . "" . ($string_hora[0]) . "" . ($string_hora[1]) . "" . ($string_hora[2]) . "
		<hr/>
                </div>";
        /* fim */

        /* conteudo */
        $html .= "<div class='conteudo'>
			<div class='dados_pessoais'>";

        $html .= "<table border='1'>
                    <tr>
                        <td>Estudante</td>
                        <td>Genero</td>
                        <td>Turma</td>
                    </tr>";

        foreach ($dataset4['dataset'] as $comparticipandos) {
            $html .= "<tr>
                        <td>$comparticipandos->nome</td>
                        <td>$comparticipandos->genero</td>
                        <td>$comparticipandos->turma</td>
                      </tr>";
        }
        $html .= "</table>
                    <br/>
                    Data & Hora: " . (date("d/m/Y", strtotime($pagamento->data_pagamento))) . " $pagamento->hora_pagamento
            </div>
              <hr/>";

        $html .= "<table border='1'>
                    <tr>
                        <td>Meses</td>
                        <td>Valor</td>
                    </tr>
        ";
        $total_pago = 0;
        foreach ($dataset['dataset'] as $pagamento):
            $total_pago += $pagamento->valor_pago;
            $html .= "<tr>
                    <td>$pagamento->mes</td>
                    <td>" . (number_format($pagamento->valor_pago, 2, ',', '.')) . "</td>
                  </tr>
        ";
        endforeach;

        $html .= "
                </table>
		<hr/>
		Total Pago: " . (number_format($total_pago, 2, ',', '.')) . "
		
                  </div>";
        /* fim */

        /* rodape */
        $html .= "<div class='rodape'></div>";
        /* fim */

        $html .= "</div>";

        return $html;
    }

    public function designer_listaPagamento($dataset, $dataset1, $ano_lectivo)
    {
        foreach ($dataset['dataset'] as $tipoPagamento) {
        }
        foreach ($dataset1['dataset'] as $turma) {
        }
        if ($tipoPagamento->modalidade == "Mensal") {
            $tipo = 1;
        } elseif ($tipoPagamento->modalidade == "Trimestral") {
            $tipo = 2;
        } elseif ($tipoPagamento->modalidade == "Semestral") {
            $tipo = 3;
        } elseif ($tipoPagamento->modalidade == "Anual") {
            $tipo = 4;
        } elseif ($tipoPagamento->modalidade == "Nenhum") {
            $tipo = 5;
        }
        $retorno = $this->mesmdl->verificar(array('tipo' => $tipo));
        $form_data = array('id_turma' => $turma->id_turma, 'ano_lectivo' => $ano_lectivo);
        $retorno1 = $this->historicomdl->verificar($form_data);

        $html = "<div class = 'pagina'>";
        $html .= "<div class='cabecalho' style='font-size:15px; font-weight:bold;'>
		Instituto Técnico Privado Colégio Esperança<br/><br/>
		Lista de Pagamento referente à $tipoPagamento->descricao<br/><br/>
		<hr/>
		
</div>";

        $html .= "
        		Curso: $turma->curso &nbsp;&nbsp; Classe: $turma->classe &nbsp;&nbsp; Turma: $turma->turma 
		&nbsp;&nbsp; Turno: $turma->turno &nbsp;&nbsp; Ano Lectivo: $ano_lectivo
		<hr/>
        ";

        $html .= "<div class='conteudo'>
<table border='1'>
<tr>
<th>Nº</th>
<th>Nome Estudante</th>";
        foreach ($retorno['dataset'] as $modalidades):
            $html .= "<td>$modalidades->mes</td>";
        endforeach;
        $html .= "</tr>";
        $a = 0;
        foreach ($retorno1['dataset'] as $historico):
            $a++;
            $html .= "<tr>
<td>$a</td>
<td>$historico->nome</td>";
            foreach ($retorno['dataset'] as $modalidades):
                $form_data1 = array(
                    'id_estudante' => $historico->id_estudante,
                    'id_mes' => $modalidades->id_mes,
                    'ano_lectivo' => $ano_lectivo
                );
                $retorno2 = $this->pagamentomdl->verificar($form_data1);
                if ($retorno2['row_count'] <= 0):
                    $estado = "nao pago";
                elseif ($retorno2['row_count'] >= 1):
                    foreach ($retorno2['dataset'] as $value): endforeach;
                    $estado = number_format($value->valor_pago, 2, ',', '.');
                endif;


                $html .= "<td>$estado</td>";
            endforeach;
            $html .= "
</tr>";
        endforeach;
        $html .= "</table>
</div>";

        $html .= "<div class='rodape'>

</div>";

        $html .= "</div>";
        return $html;
    }


    public function gerar_factura($id_estudate, $id_tipoPagamento, $ano_lectivo, $data_pagamento, $hora_pagamento)
    {

        $data_pagamento = array(
            'id_estudante' => $id_estudate,
            'id_tipoPagamento' => $id_tipoPagamento,
            'ano_lectivo' => $ano_lectivo,
            'data_pagamento' => $data_pagamento,
            'hora_pagamento' => $hora_pagamento
        );

        $retorno = $this->pagamentomdl->verificar($data_pagamento);
        $retorno1 = $this->historicomdl->verificar(array('id_estudante' => $id_estudate, 'ano_lectivo' => $ano_lectivo));


        $mpdf = new mPDF('C', 'A4', '0', 'arial');
        foreach ($retorno['dataset'] as $pagamento) {
        }
        if ($pagamento->descricao == "Comparticipação de Pais") {
            $mpdf->WriteHTML($this->designer_facturaCompart($retorno, $retorno1));
        } else {
            $mpdf->WriteHTML($this->designer_factura($retorno, $retorno1));
        }
        $mpdf->Output();

    }

    public function listas_pagamento($id_tipoPagamento, $ano_lectivo, $id_turma)
    {
        if ($id_tipoPagamento != null && $ano_lectivo != null) {
            $retorno = $this->tipopagamentomdl->verificar(array('id_tipoPagamento' => $id_tipoPagamento));
            $retorno1 = $this->turmamdl->verificar(array('id_turma' => $id_turma));

            $mpdf = new mPDF('C', 'A4', '0', 'arial');
            $mpdf->WriteHTML($this->designer_listaPagamento($retorno, $retorno1, $ano_lectivo));
            $mpdf->Output();
        }
    }

}



