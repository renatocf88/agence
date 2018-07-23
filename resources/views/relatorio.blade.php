
@foreach($consultores as $nome => $consultor)
  <div class="row">
    {{$nome}}
  </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="left">Periodo</th>
          <th scope="col">Receita líquida</th>
          <th scope="col">Custo total</th>
          <th scope="col">Comissão</th>
          <th scope="col">Lucro</th>
        </tr>
      </thead>
      <tbody>
        <?php $soma_liquida = 0;
              $soma_custo = 0;
              $soma_comissao = 0;
              $soma_lucro = 0; ?>
        @foreach($consultor as $mes => $valores)
          <tr>
            <th scope="row" style="font-size: 0.8em;" class="left">{{$mes}}</th>
            <td>{{$valores['receita_liquida']}}</td>
            <td>{{$valores['custo_fixo']}}</td>
            <td>{{$valores['comissao']}}</td>
            <td>{{$valores['lucro']}}</td>
          </tr>
          <?php 
              $soma_liquida += $valores['receita_liquida_soma'];
              $soma_custo += $valores['custo_fixo_soma'];
              $soma_comissao += $valores['comissao_soma'];
              $soma_lucro += $valores['lucro_soma']; 
          ?>
        @endforeach
        <tr>
            <th scope="row" style="font-size: 0.8em;" class="left">Total</th>
            <td><b>{{ number_format($soma_liquida,2,',','.')}}</b></td>
            <td><b>{{number_format($soma_custo,2,',','.')}}</b></td>
            <td><b>{{number_format($soma_comissao,2,',','.')}}</b></td>
            <td><b>{{number_format($soma_lucro,2,',','.')}}</b></td>
          </tr>
      </tbody>
    </table>  
@endforeach
