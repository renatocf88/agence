@extends('layouts.app')

@section('content')

</HEAD>
<BODY>
  @extends('layouts.menu')

  <div class="pricing-header pb-md-4 mx-auto text-center"">
     <a href="con_desempenho"><button type="button" class="btn btn-outline-light text-dark ">Por Consultor</button></a>
    <a href="con_desempenho_cliente"><button type="button" class="btn btn-outline-light text-dark active">Por Cliente</button></a>
    </div>
  <div class="container">
      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <div class="col-md-12">
            Período
          </div>
             <select name="select5" id='mesini'>
                        <option value="01">Jan
                        <option selected value="02">Fev
                        <option value="03">Mar
                        <option value="04">Abr
                        <option value="05">Mai                        
                        <option value="06">Jun
                        <option value="07">Jul
                        <option value="08">Ago
                        <option  value="09">Set 
                        <option value="10">Out                          
                        <option value="11">Nov
                        <option value="12">Dez
                      </select>
                      <select name="select" id='anoini'>
                        <option value="2003">2003
                        <option value="2004">2004
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007" selected>2007</option>
                      </select>
                      a
                      <select name="select3" id='mesfim'>
                        <option value="01">Jan
                        <option value="02">Fev
                        <option value="03">Mar
                        <option value="04">Abr
                        <option value="05">Mai                        
                        <option value="06">Jun
                        <option value="07">Jul
                        <option value="08">Ago
                        <option selected value="09">Set 
                        <option value="10">Out                          
                        <option value="11">Nov
                        <option value="12">Dez
                      </select>
                      <select name="select4" id='anofim'>
                        <option value="2003">2003
                        <option value="2004">2004
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007" selected>2007</option>
                      </select>
          </div>
          <div class="card-body">
               <select multiple size="8" name="list1" id="list1" style="width:100%">
                    @foreach($clientes as $cliente)                                 
                        <option value="{{$cliente->co_cliente}}" >{{$cliente->no_fantasia}}</option>
                    @endforeach  
              </select>
          </div>
        </div>
        <div>
          <div>
            <div class="col-md-12">
              <input name="button" type="button" onClick="move(list1,list2)" value=">>">
            </div>
              <div class="col-md-12">
            <input name="button" type="button" onClick="move(list2,list1)" value="<<">
          </div>
          </div>
        </div>
        <br>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            Clientes para pesquisa<br><br>
          </div>
          <div class="card-body">
            <select multiple size="8" name="list2" id="list2" style="width:100%"></select>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            Relatórios<br><br>
          </div>
          <div class="card-body" style="padding-left: 25%;">
            <div class="col-md-12">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text "><img src="{{ asset('img/icone_relatorio.png') }}"></span>
                </div>
                <button type="button"  class="input-group-text pointer" id='relatorio_consultor_cliente'>Listagem</button>
              </div>
          </div>
          <br>
          <div class="col-md-12">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><img src="{{ asset('img/icone_grafico.png') }}"></span>
                </div>
                <button type="button"  class="input-group-text pointer" id='grafico_consultor_cliente'>Gr&aacute;fico</button>
              </div>
          </div>
          <br>
          <div class="col-md-12">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><img src="{{ asset('img/icone_pizza.png') }}"></span>
                </div>
                <button type="button"  class="input-group-text pointer" id='pizza_consultor_cliente'>Pizza</button> 
              </div>             
          </div>
          </div>
        </div>
      </div>
    </div>
    </BODY></HTML>
<div id="conteudo" class="center"></div>
    @endsection