<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaoClienteModel extends Model
{
   protected $table = 'cao_cliente';

 	public static function retornaClientes(){
    	return self::where('tp_cliente','A')->get();
    }
}
