<br>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" class="form-horizontal" action="{{ route('gravainfocte') }}">
  <input type="hidden" name="cte_chave" value="{{ $cte->cte_chave }}" >
  <input type="hidden" name="cte_id" value="{{ $cte->cte_id }}" >
{{ csrf_field() }}
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>CT-e - Conhecimento de Transporte</h5>
    <div class="ibox-tools"><a href="#" class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
  </div>
  <div class="ibox-content" style="display: block;">
      <div class="form-group">
        <label class="col-sm-1 control-label">Número</label>
        <div class="col-sm-2">
          <input type="hidden" name="cte_numero" value="{{ $cte->cte_numero }}" >
          <p class="form-control-static">{{ $cte->cte_numero }}</p>
        </div>
        <label class="col-sm-1 control-label">Empresa</label>
        <div class="col-sm-1">
          <p class="form-control-static">{{ $cte->codigo }}</p>
        </div>
        <label class="col-sm-1 control-label">Emissão</label>
        <div class="col-sm-2">
          <p class="form-control-static">{{ date('d/m/Y',strtotime($cte->cte_data)) }}</p>
        </div>
        <label class="col-sm-1 control-label">Previsão</label>
        <div class="col-sm-3">
          <p class="form-control-static">{{ date('d/m/Y',strtotime($cte->cte_previsao)) }}</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">Remetente</label>
        <div class="col-sm-7">
          <p class="form-control-static">{{ $cte->remetente }}</p>
        </div>
        <label class="col-sm-1 control-label">Origem</label>
        <div class="col-sm-3">
          <p class="form-control-static">{{ $cte->origemcid." - ".$cte->origemuf }}</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">Destinatário</label>
        <div class="col-sm-7">
          <p class="form-control-static">{{ $cte->destinatario }}</p>
        </div>
        <label class="col-sm-1 control-label">Destino</label>
        <div class="col-sm-3">
          <p class="form-control-static">{{ $cte->destinocid." - ".$cte->destinouf }}</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">Observação</label>
        <div class="col-sm-4">
          <textarea
            name="obs_cte"
            maxlength="140"
            data-toggle="tooltip" data-placement="right" title="Limite de 140 caracteres."
            class="form-control">{{ $cte->cte_obs }}</textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">Status</label>
        <div class="col-sm-2">
          <select id="status" class="form-control" name="status">
            <option value="">Selecione</option>
            @foreach($statuscte as $status)
              @if($status->id == $cte->cte_status)
                <option value="{{ $status->id }}" selected>{{ $status->descricao }}</option>
              @else
                <option value="{{ $status->id }}">{{ $status->descricao }}</option>
              @endif
            @endforeach
          </select>
        </div>
        <label class="col-sm-2 control-label">Data de Entrega</label>
        <div id="dtentrega" class="col-sm-2">
          <input
            type="text"
            id="data_entrega"
            class="form-control datas"
            data-provide="datepicker" data-date-end-date="0d"
            name="dataentrega" disabled
          >
        </div>
        <label class="col-sm-1 control-label">Recebedor</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="recebedor">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-2 col-md-offset-4">
          @if($gravar)
          <input type="submit" id="btngravar" class="btn btn-primary btn-block" value="Gravar" >
          @endif
        </div>
        <div class="col-md-2">
          @if($ocorrencia)
          <input
            type="button"
            id="btnoco"
            class="btn btn-danger btn-block"
            value="Ocorrência"
            onclick="window.location='{{ route('abreocorrencia',['cte' => $cte->cte_id]) }}'"
          >
          @endif
        </div>
      </div>
  </div>
</div>

<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>NF-e - Notas Fiscais</h5>
    <div class="ibox-tools"><a href="#" class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
  </div>
  <div class="ibox-content" style="display: block;">
    <div class="table-responsive">
    <table class="table table-hover table-striped table-bordered" id="tblnotas">
      <thead>
        <th>Número</th>
        <th>Série</th>
        <th>Valor</th>
        <th>Volume</th>
        <th>Peso</th>
      </thead>
      <tbody>
        @foreach($notas as $nota)
          <tr>
            <td>{{ $nota->nf_id }}</td>
            <td>{{ $nota->nf_serie }}</td>
            <td>{{ $nota->nf_valor }}</td>
            <td>{{ $nota->nf_volume }}</td>
            <td>{{ $nota->nf_peso }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
</div>
</form>
@section('script')
<script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/js/plugins/datapicker/locales/bootstrap-datepicker.pt-BR.js"></script>
<script src="/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="/js/plugins/dataTables/datatables.min.js"></script>
<script src="/js/mask_plugin.js"></script>
<script src="/js/baixamanual/funcoes.js"></script>
@endsection
<br>
