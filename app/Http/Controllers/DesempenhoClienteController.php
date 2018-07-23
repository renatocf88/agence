<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaoClienteModel;
use App\CaoFaturaModel;

class DesempenhoClienteController extends Controller
{
    public function index(){
 		$clientes = CaoClienteModel::retornaClientes();
 		return view('con_desempenho_cliente')->with('clientes',$clientes);
 	}

 	public function relatorio(Request $request){
 		$param = $request->all();
 		$retorno = array();
 		
 		if($param['consultor'] == 'false'){
 			return '';			
 		}	
 		$dados = CaoFaturaModel::retornaDadosClientes($param['consultor'],$param['mesini'],$param['mesfim'],$param['anoini'],$param['anofim']);
 		
 		foreach ($dados as $key => $value) {
 			$value->mes = CaoFaturaModel::retornaMes($value->mes);
 			$retorno[$value->nome][$value->mes  . ' de ' . $value->ano]['receita_liquida'] = number_format($value->receita_liquida,2,'.',',');
 			$retorno[$value->nome][$value->mes  . ' de ' . $value->ano]['receita_liquida_soma'] = $value->receita_liquida;
 			
 		}
 		// echo '<pre>';
 		// print_r($retorno);
 		// die;
 		return view('relatorio-cliente')->with('consultores',$retorno);
 	}

 	public function grafico(Request $request){
 		$param = $request->all();

 		if($param['consultor'] == 'false'){
 			return '';			
 		}	

		$content = $this->retornaXMLgrafico($param);
		unlink("data_line_graf.xml");

		file_put_contents('data_line_graf.xml', $content);
 		
 		 return view('grafico-cliente');
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
			
			$retorno = $this->formataValorPorCliente($param);

			$array_soma_salario = array();	
			foreach($retorno as $chave => $mes){		
				$soma_salario = 0;
				foreach($mes as $key => $valor_liquido){
					$soma_salario = $soma_salario + $valor_liquido['receita_liquida'];
					$array_soma_salario[$chave] = $soma_salario; 
				}
			}

			$cor = 0;
	 		foreach($array_soma_salario as $clientes => $total){
	 			$return .= '<set value="'.$total.'" name="'.utf8_decode($clientes).'" color="'.CaoFaturaModel::cores()[$cor].'" />'; 
	 			
		 		if($cor == 7){
					break;	
				}
				$cor++;
	 		}

			return $return .= '</graph>';
 	}

 	public function retornaXMLgrafico($param){
		$meses = CaoFaturaModel::retornaMesGraficoClientes($param['consultor'],$param['mesini'],$param['mesfim'],$param['anoini'],$param['anofim']);

		$caption = CaoFaturaModel::captionGrafico($param);

 		$return = '<graph bgColor="F1f1f1" caption="Performance Comercial" subCaption="'.$caption.'" numdivlines="4" lineThickness="3" showValues="0" numVDivLines="10" formatNumberScale="2" rotateNames="0" decimalPrecision="2" anchorRadius="2" anchorBgAlpha="0" numberPrefix="R$ " divLineAlpha="30" showAlternateHGridColor="1" yAxisMinValue="800000" shadowAlpha="50" decimalSeparator="," thousandSeparator=".">';

		$return .='<categories>';
			foreach($meses as $chave => $mes){
				$return .='<category name="'.utf8_decode(CaoFaturaModel::retornaMes($mes['mes'])).'" hoverText="'.CaoFaturaModel::retornaMes($mes['mes']).'" />';
			}
		$return .= '</categories>';

		$retorno = $this->formataValorPorCliente($param);

		$cor = 0;
		foreach($retorno as $nome => $dados){
			$return .= '<dataset seriesName="'.utf8_decode($nome).'" color="'.CaoFaturaModel::cores()[$cor].'" anchorBorderColor="A66EDD" anchorRadius="4">';
			foreach($dados as $mes => $valor){
				$return .= '<set value="'.$valor['receita_liquida'].'" />'; 
			}
			$return .=	'</dataset>';
			if($cor == 7){
				break;	
			}
			$cor++;
		}

		return $return .= '</graph>';
 	}

 	public function formataValorPorCliente($param){
 		$retorno = array();
 		$dados = CaoFaturaModel::retornaDadosClientes($param['consultor'],$param['mesini'],$param['mesfim'],$param['anoini'],$param['anofim']);	

		foreach ($dados as $key => $value) {
 			$value->mes = CaoFaturaModel::retornaMes($value->mes);
 			$retorno[$value->nome][$value->mes]['receita_liquida'] = intval($value->receita_liquida);
		}

		return $retorno;
 	}
}
