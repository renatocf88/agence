<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaoFaturaModel extends Model
{
    protected $table = 'cao_fatura';

 	public static function retornaDadosConsultores($consutores,$mesini,$mesfim,$anoini,$anofim){
    	return self::select(\DB::raw("sum((cao_fatura.valor - (cao_fatura.valor * concat(0,'.',cao_fatura.total_imp_inc)))) as receita_liquida,
    				cao_salario.brut_salario as custo_fixo,
    				((cao_fatura.comissao_cn / 100) * SUM((cao_fatura.valor - (cao_fatura.valor * CONCAT(0,'.',cao_fatura.total_imp_inc)))))  AS comissao, 
    				SUM((cao_fatura.valor - (cao_fatura.valor * CONCAT(0,'.',cao_fatura.total_imp_inc)))) - (((cao_fatura.comissao_cn / 100) * SUM((cao_fatura.valor - (cao_fatura.valor * CONCAT(0,'.',cao_fatura.total_imp_inc))))) + cao_salario.brut_salario) as lucro,
    				cao_usuario.no_usuario as nome,month(data_emissao) as mes,year(data_emissao) as ano
    				"))
    				->join('cao_cliente', 'cao_fatura.co_cliente', '=', 'cao_cliente.co_cliente')
    				->join('cao_sistema', 'cao_fatura.co_sistema', '=', 'cao_sistema.co_sistema')	
    				->join('cao_os', 'cao_fatura.co_os', '=', 'cao_os.co_os')
    				->join('cao_salario', 'cao_salario.co_usuario', '=', 'cao_os.co_usuario')
    				->join('cao_usuario', 'cao_usuario.co_usuario', '=', 'cao_os.co_usuario')
	    		->whereIN('cao_os.co_usuario',$consutores)
	    		->whereRaw("(month(data_emissao) >= '".$mesini."' and month(data_emissao) <= '".$mesfim."')
							and (year(data_emissao) >= '".$anoini."' and year(data_emissao) <= '".$anofim."')")
	    		->groupBy(\DB::raw('month(data_emissao),year(data_emissao),cao_salario.brut_salario,cao_usuario.no_usuario,cao_fatura.comissao_cn'))
	    		->orderBy('cao_usuario.no_usuario')->
                orderBy(\DB::raw('month(data_emissao)'))->orderBy(\DB::raw('year(data_emissao)'))->get();
    }

    public static function retornaMesConsulta($consutores,$mesini,$mesfim,$anoini,$anofim){ 	
    	return self::select(\DB::raw("distinct(month(data_emissao)) as mes"))
    				->join('cao_cliente', 'cao_fatura.co_cliente', '=', 'cao_cliente.co_cliente')
    				->join('cao_sistema', 'cao_fatura.co_sistema', '=', 'cao_sistema.co_sistema')	
    				->join('cao_os', 'cao_fatura.co_os', '=', 'cao_os.co_os')
    				->join('cao_salario', 'cao_salario.co_usuario', '=', 'cao_os.co_usuario')
    				->join('cao_usuario', 'cao_usuario.co_usuario', '=', 'cao_os.co_usuario')
	    		->whereIN('cao_os.co_usuario',$consutores)
	    		->whereRaw("(month(data_emissao) >= '".$mesini."' and month(data_emissao) <= '".$mesfim."')
							and (year(data_emissao) >= '".$anoini."' and year(data_emissao) <= '".$anofim."')")
	    		->groupBy(\DB::raw('cao_fatura.data_emissao,month(data_emissao),year(data_emissao),cao_salario.brut_salario,cao_usuario.no_usuario,cao_fatura.comissao_cn'))
	    		->orderBy('cao_usuario.no_usuario')
                ->orderBy(\DB::raw('month(data_emissao)'))
                ->orderBy(\DB::raw('year(data_emissao)'))->get();
    }

    public static function retornaMes($mes){
    	    $meses = array(
				    '1'=>'Janeiro',
				    '2'=>'Fevereiro',
				    '3'=>'Março',
				    '4'=>'Abril',
				    '5'=>'Maio',
				    '6'=>'Junho',
				    '7'=>'Julho',
				    '8'=>'Agosto',
				    '9'=>'Setembro',
				    '10'=>'Outubro',
				    '11'=>'Novembro',
				    '12'=>'Dezembro'
				);
    	    return $meses[intval($mes)];
    }

    public static function retornaMesGraficoClientes($clientes,$mesini,$mesfim,$anoini,$anofim){
    	return self::select(\DB::raw("distinct(month(data_emissao)) as mes"))
    				->join('cao_cliente', 'cao_fatura.co_cliente', '=', 'cao_cliente.co_cliente')
    				->join('cao_sistema', 'cao_fatura.co_sistema', '=', 'cao_sistema.co_sistema')	
    				->join('cao_os', 'cao_fatura.co_os', '=', 'cao_os.co_os')
	    		->whereIN('cao_fatura.co_cliente',$clientes)
	    		->whereRaw("(month(data_emissao) >= '".$mesini."' and month(data_emissao) <= '".$mesfim."')
							and (year(data_emissao) >= '".$anoini."' and year(data_emissao) <= '".$anofim."')")
	    		->groupBy(\DB::raw('cao_fatura.data_emissao,month(data_emissao),year(data_emissao),cao_cliente.no_fantasia'))
	    		->orderBy('mes')->orderBy(\DB::raw('month(data_emissao)'))->orderBy(\DB::raw('year(data_emissao)'))->get();
    }

    public static function retornaDadosClientes($clientes,$mesini,$mesfim,$anoini,$anofim){
    	return self::select(\DB::raw("sum((cao_fatura.valor - (cao_fatura.valor * concat(0,'.',cao_fatura.total_imp_inc)))) as receita_liquida,
    				cao_cliente.no_fantasia as nome,
    				month(data_emissao) as mes,year(data_emissao) as ano
    				"))
    				->join('cao_cliente', 'cao_fatura.co_cliente', '=', 'cao_cliente.co_cliente')
    				->join('cao_sistema', 'cao_fatura.co_sistema', '=', 'cao_sistema.co_sistema')	
    				->join('cao_os', 'cao_fatura.co_os', '=', 'cao_os.co_os')
	    		->whereIN('cao_fatura.co_cliente',$clientes)
	    		->whereRaw("(month(data_emissao) >= '".$mesini."' and month(data_emissao) <= '".$mesfim."')
							and (year(data_emissao) >= '".$anoini."' and year(data_emissao) <= '".$anofim."')")
	    		->groupBy(\DB::raw('month(data_emissao),year(data_emissao),cao_cliente.no_fantasia'))
	    		->orderBy('cao_cliente.no_fantasia')->orderBy(\DB::raw('month(data_emissao)'))->orderBy(\DB::raw('year(data_emissao)'))->get();
    }

    public static function cores(){
    	return array("0" => "#CCCCCC",       
							 "1" => "#5A6D42",
							 "2" => "#006699",
							 "3" => "#996600",
							 "4" => "#000000",
							 "5" => "#666666",
							 "6" => "#8aa61d",
							 "7" => "#FF0000",
							 "6" => "F0F0F0");
    }

    public static function captionGrafico($param){
		return CaoFaturaModel::retornaMes($param['mesini']) .' de '. $param['anoini'] .  ' a ' . CaoFaturaModel::retornaMes($param['mesfim']) .' de '. $param['anofim'];
 	}
}
