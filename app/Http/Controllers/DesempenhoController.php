<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaoUsuarioModel;
use App\CaoFaturaModel;

class DesempenhoController extends Controller
{
    
 	public function index(){
 		$consultores = CaoUsuarioModel::retornaConsultor();
 		return view('con_desempenho')->with('consultores',$consultores);
 	}

 	public function relatorio(Request $request){
 		$param = $request->all();
 		$retorno = array();
 		
 		if($param['consultor'] == 'false'){
 			return '';			
 		}	
 		$dados = CaoFaturaModel::retornaDadosConsultores($param['consultor'],$param['mesini'],$param['mesfim'],$param['anoini'],$param['anofim']);

 		foreach ($dados as $key => $value) {
 			$value->mes = CaoFaturaModel::retornaMes($value->mes);
 			$retorno[$value->nome][$value->mes  . ' de ' . $value->ano]['receita_liquida'] = number_format($value->receita_liquida,2,',','.');
 			$retorno[$value->nome][$value->mes  . ' de ' . $value->ano]['receita_liquida_soma'] = $value->receita_liquida;

 			$retorno[$value->nome][$value->mes . ' de ' . $value->ano]['custo_fixo'] = number_format($value->custo_fixo,2,',','.');
 			$retorno[$value->nome][$value->mes . ' de ' . $value->ano]['custo_fixo_soma'] = $value->custo_fixo;

 			$retorno[$value->nome][$value->mes . ' de ' . $value->ano]['comissao'] = number_format($value->comissao,2,',','.');
 			$retorno[$value->nome][$value->mes . ' de ' . $value->ano]['comissao_soma'] = $value->comissao;
 			$retorno[$value->nome][$value->mes . ' de ' . $value->ano]['lucro'] = number_format($value->lucro,2,',','.');
 			$retorno[$value->nome][$value->mes . ' de ' . $value->ano]['lucro_soma'] = $value->lucro;

 		}
 		// echo '<pre>';
 		// print_r($retorno);
 		// die;
 		return view('relatorio')->with('consultores',$retorno);
 	}

 	public function grafico(Request $request){
 		$param = $request->all();

 		if($param['consultor'] == 'false'){
 			return '';			
 		}	

		$content = $this->retornaXMLgrafico($param);
		unlink("data_line_bar.xml");

		file_put_contents('data_line_bar.xml', $content);
 		
 		 return view('grafico');
 	} 

 	public function graficoPizza(Request $request){
		$param = $request->all();

 		if($param['consultor'] == 'false'){
 			return '';			
 		}

 		$content = $this->retornaXMLgraficoPizza($param);
		unlink("data_pizza.xml");

		file_put_contents('data_pizza.xml', $content);

 		return view('pizza');
 	}

 	public function retornaXMLgraficoPizza($param){
 		 $return = '<graph caption="'.utf8_decode('Participação na Receita').'" bgColor="F1f1f1" decimalPrecision="1" showPercentageValues="1" showNames="1" numberPrefix="" showValues="1" showPercentageInLabel="1" pieYScale="45" pieBorderAlpha="40" pieFillAlpha="70" pieSliceDepth="15" pieRadius="100">';
	 		
			$retorno = $this->formataValorPorConsultor($param);

			$array_soma_salario = array();	
			foreach($retorno as $chave => $mes){		
				$soma_salario = 0;
				foreach($mes as $key => $valor_liquido){
					$soma_salario = $soma_salario + $valor_liquido['receita_liquida'];
					$array_soma_salario[$chave] = $soma_salario; 
				}
			}

			$cor = 0;
	 		foreach($array_soma_salario as $consultores => $total){
	 			$return .= '<set value="'.$total.'" name="'.utf8_decode($consultores).'" color="'.CaoFaturaModel::cores()[$cor].'" />'; 
	 			$cor++;
	 		}

		return $return .= '</graph>';
			
 	}

 	public function retornaXMLgrafico($param){
 		$meses = CaoFaturaModel::retornaMesConsulta($param['consultor'],$param['mesini'],$param['mesfim'],$param['anoini'],$param['anofim']);
		
 		$retorno = array();

 		$caption = CaoFaturaModel::retornaMes($param['mesini']) .' de '. $param['anoini'] .  ' a ' . CaoFaturaModel::retornaMes($param['mesfim']) .' de '. $param['anofim'];

 		$return = '<graph bgColor="F1f1f1" caption="Performance Comercial" subCaption="'.$caption.'" showValues="0" divLineDecimalPrecision="2" formatNumberScale="2" limitsDecimalPrecision="2" PYAxisName="" SYAxisName="" decimalSeparator="," thousandSeparator="." SYAxisMaxValue="64000" PYAxisMaxValue="64000">';

		$return .='<categories>';
			foreach($meses as $chave => $mes){
				$return .='<category name="'.utf8_decode(CaoFaturaModel::retornaMes($mes['mes'])).'" hoverText="'.utf8_decode(CaoFaturaModel::retornaMes($mes['mes'])).'" />';
			}
		$return .= '</categories>';

		$retorno = $this->formataValorPorConsultor($param);

		$cor = 0;
		foreach($retorno as $chave => $mes){
			$return .= '<dataset seriesName="'.utf8_decode($chave).'" color="'.CaoFaturaModel::cores()[$cor].'" numberPrefix="R$ ">';
			$soma_salario = 0;
			$array_soma_salario = array();	
			foreach($mes as $key => $valor_liquido){
				$return .= '<set value="'.$valor_liquido['receita_liquida'].'" /> ';
				$soma_salario = $soma_salario + $valor_liquido['custo_fixo'];
				$array_soma_salario[$key] = $soma_salario; 
			}
			$return .=	'</dataset>';
			$cor++;
		}

	
		$return .= '<dataset lineThickness="3" seriesName="'.utf8_decode('Custo Fixo Médio').'" numberPrefix="R$ " parentYAxis="S" color="FF0000" anchorBorderColor="FF8000">';
		foreach($array_soma_salario as $soma){ 
			$return .= '<set value="'.$soma.'" />';	
		}
		 
		$return .= '</dataset>
 		</graph>';
			  	
		return $return;
 	}

 	public function formataValorPorConsultor($param){
 		$retorno = array();
 		$dados = CaoFaturaModel::retornaDadosConsultores($param['consultor'],$param['mesini'],$param['mesfim'],$param['anoini'],$param['anofim']);	

		foreach ($dados as $key => $value) {
 			$value->mes = CaoFaturaModel::retornaMes($value->mes);
 			$retorno[$value->nome][$value->mes]['receita_liquida'] = intval($value->receita_liquida);
 			$retorno[$value->nome][$value->mes]['custo_fixo'] = $value->custo_fixo;
		}

		return $retorno;
 	}



}
