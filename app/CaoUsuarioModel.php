<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaoUsuarioModel extends Model
{

	protected $table = 'cao_usuario';

 	public static function retornaConsultor(){
    	return self::join('permissao_sistema','permissao_sistema.co_usuario','=','cao_usuario.co_usuario')
    		->where('permissao_sistema.co_sistema',1)
    		->where('permissao_sistema.in_ativo','S')
    		->whereIN('co_tipo_usuario',array(0,1, 2))->orderBy('cao_usuario.no_usuario')->get();
    }
}
