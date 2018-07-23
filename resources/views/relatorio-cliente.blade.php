
@foreach($consultores as $nome => $consultor)
  <div class="row blue">
    {{$nome}}
  </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="left">Período</th>
          <th scope="col">Receita líquida</th>
        </tr>
      </thead>
      <tbody>
         <?php $soma_liquida = 0; ?>
        @foreach($consultor as $mes => $valores)
          <tr>
            <th style="font-size: 0.8em;" class="left">{{$mes}}</th>
            <td class="">{{$valores['receita_liquida']}}</td>
          </tr>
           <?php 
              $soma_liquida += $valores['receita_liquida_soma'];
          ?>
        @endforeach
        <tr>
            <th scope="row" style="font-size: 0.8em;" class="left">Total</th>
            <td><b>{{ number_format($soma_liquida,2,',','.')}}</b></td
          </tr>
      </tbody>
    </table>  
@endforeach
