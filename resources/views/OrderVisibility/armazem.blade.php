<br>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Armazém</h5>
    <div class="ibox-tools"><a href="#" class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
  </div>
  <div class="ibox-content" style="display: block;">

    <div class="row">

      <div class="col-md-1">
        <img class="img-md" src="/img/order_visibility/10.png">
      </div>

      <!-- Container Recebimento Nota Fiscal -->
      <div class="col-md-3" data-toggle="modal" data-target="#modalmsg" id="view_nota">

        <!-- Quantidade de pedidos/nf -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. Pedido/NF</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $recebidos['qtd'] }}</button>
          </div>
        </div>

        <!-- Valor -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Valor R$</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $recebidos['valor'] }}</button>
          </div>
        </div>

        <!-- Quantidade de Unidades -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. de Unidades</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $recebidos['unidades'] }}</button>
          </div>
        </div>

        <!-- Quantidade de Volumes -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. de Volumes</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $recebidos['volumes'] }}</button>
          </div>
        </div>

        <!-- Quantidade de linhas -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. de Linhas</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $recebidos['linhas'] }}</button>
          </div>
        </div>

        <!-- Peso -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Peso</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $recebidos['peso'] }}</button>
          </div>
        </div>
      </div>

      <!-- Container Em Separação -->

      <div class="col-md-1">
        <img src="/img/order_visibility/20.png">
      </div>

      <div class="col-md-3" id="view_separacao" data-toggle="modal" data-target="#modalmsg">

        <!-- Quantidade de pedidos/nf -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. Pedido/NF</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $separados['qtd'] }}</button>
          </div>
        </div>

        <!-- Valor -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Valor R$</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $separados['valor'] }}</button>
          </div>
        </div>

        <!-- Quantidade de Unidades -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. de Unidades</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $separados['unidades'] }}</button>
          </div>
        </div>

        <!-- Quantidade de Volumes -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. de Volumes</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $separados['volumes'] }}</button>
          </div>
        </div>

        <!-- Quantidade de linhas -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. de Linhas</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $separados['linhas'] }}</button>
          </div>
        </div>

        <!-- Peso -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Peso</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $separados['peso'] }}</button>
          </div>
        </div>

      </div>

      <!-- Container Em Expedição -->
      <div class="col-md-1">
        <img src="/img/order_visibility/30.png">
      </div>

      <div class="col-md-3" id="view_expedicao" data-toggle="modal" data-target="#modalmsg">

        <!-- Quantidade de pedidos/nf -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. Pedido/NF</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $expedidos['qtd'] }}</button>
          </div>
        </div>

        <!-- Valor -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Valor R$</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $expedidos['valor'] }}</button>
          </div>
        </div>

        <!-- Quantidade de Unidades -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. de Unidades</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $expedidos['unidades'] }}</button>
          </div>
        </div>

        <!-- Quantidade de Volumes -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. de Volumes</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $expedidos['volumes'] }}</button>
          </div>
        </div>

        <!-- Quantidade de linhas -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Qtd. de Linhas</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $expedidos['linhas'] }}</button>
          </div>
        </div>

        <!-- Peso -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-xs">Peso</button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary btn-xs">{{ $expedidos['peso'] }}</button>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
