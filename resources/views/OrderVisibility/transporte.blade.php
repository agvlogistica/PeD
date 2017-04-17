  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Transporte</h5>
      <div class="ibox-tools">
        <a href="#" class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </div>
    </div>
    <div class="ibox-content" style="display: block;">

      <div class="row">

        <!-- Container Em Transporte -->
        <div class="col-md-1">
          <img src="/img/order_visibility/40.png" style="vertical-align: middle;">
        </div>

        <div class="col-md-3"  id="view_transporte" data-toggle="modal" data-target="#modalmsg">

          <!-- Quantidade de pedidos/nf -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. Pedido/NF</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $transporte['qtd'] }}</button>
            </div>
          </div>

          <!-- Valor -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Valor R$</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $transporte['valor'] }}</button>
            </div>
          </div>

          <!-- Quantidade de Unidades -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. de Unidades</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $transporte['unidades'] }}</button>
            </div>
          </div>

          <!-- Quantidade de Volumes -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. de Volumes</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $transporte['volumes'] }}</button>
            </div>
          </div>

          <!-- Quantidade de linhas -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. de Linhas</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $transporte['linhas'] }}</button>
            </div>
          </div>

          <!-- Peso -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Peso</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $transporte['peso'] }}</button>
            </div>
          </div>
        </div>

        <!-- Container Em Separação -->
        <div class="col-md-1">
          <img src="/img/order_visibility/50.png">
        </div>

        <div class="col-md-3" id="view_realizada" data-toggle="modal" data-target="#modalmsg">

          <!-- Entrega realizada -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. Pedido/NF</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $entregue['qtd'] }}</button>
            </div>
          </div>

          <!-- Valor -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Valor R$</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $entregue['valor'] }}</button>
            </div>
          </div>

          <!-- Quantidade de Unidades -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. de Unidades</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $entregue['unidades'] }}</button>
            </div>
          </div>

          <!-- Quantidade de Volumes -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. de Volumes</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $entregue['volumes'] }}</button>
            </div>
          </div>

          <!-- Quantidade de linhas -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. de Linhas</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $entregue['linhas'] }}</button>
            </div>
          </div>

          <!-- Peso -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Peso</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $entregue['peso'] }}</button>
            </div>
          </div>

        </div>

        <!-- Container Ocorrência na entrega -->
        <div class="col-md-1">
          <img src="/img/order_visibility/60.png">
        </div>

        <div class="col-md-3" id="view_ocorrencia" data-toggle="modal" data-target="#modalmsg">

          <!-- Quantidade de pedidos/nf -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. Pedido/NF</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $ocorrencia['qtd'] }}</button>
            </div>
          </div>

          <!-- Valor -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Valor R$</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $ocorrencia['valor'] }}</button>
            </div>
          </div>

          <!-- Quantidade de Unidades -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. de Unidades</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $ocorrencia['unidades'] }}</button>
            </div>
          </div>

          <!-- Quantidade de Volumes -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. de Volumes</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $ocorrencia['volumes'] }}</button>
            </div>
          </div>

          <!-- Quantidade de linhas -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Qtd. de Linhas</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $ocorrencia['linhas'] }}</button>
            </div>
          </div>

          <!-- Peso -->
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default btn-xs">Peso</button>
            </div>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary btn-xs">{{ $ocorrencia['peso'] }}</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
