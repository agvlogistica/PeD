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
<form method="post" class="form-horizontal" action="{{ route('gravainfocorrencia') }}">
  <input type="hidden" name="cte_chave" value="{{ $cte->cte_chave }}" >
  <input type="hidden" name="cte_id" value="{{ $cte->cte_id }}" >
  <input type="hidden" name="obs_cte" value="CTe com ocorrencia" >
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
        <label class="col-sm-1 control-label">Status</label>
        <div class="col-sm-2">
          <select id="status" class="form-control" name="status">
            <option value="">Selecione</option>
            @foreach($statuscte as $status)
              <option value="{{ $status->id }}">{{ $status->descricao }}</option>
            @endforeach
          </select>
        </div>
        <label class="col-sm-2 control-label">Data de Entrega</label>
        <div id="dtentrega" class="col-sm-2">
          <input
            type="text"
            id="data_entrega"
            class="form-control datas"
            name="data_entrega"
            data-provide="datepicker" data-date-end-date="0d"
            disabled
          >
        </div>
        <label class="col-sm-1 control-label">Recebedor</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="recebedor">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-2 col-md-offset-5">
          <input type="submit" id="btngravar" class="btn btn-primary btn-block" value="Gravar" >
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
        <th>Ocorrência</th>
        <th>Obs. Ocorrência</th>
      </thead>
      <tbody>
        @foreach($notas as $nota)
          <tr>
            <td>{{ $nota->nf_id }}</td>
            <td>{{ $nota->nf_serie }}</td>
            <td>{{ $nota->nf_valor }}</td>
            <td>{{ $nota->nf_volume }}</td>
            <td>{{ $nota->nf_peso }}</td>
            <td>
              <select name="cmbocorrencia_{{ $nota->nf_chave }}" class="form-control">
                <option value="">Selecione</option>
                @foreach($ocorrencias as $ocorrencia)
                  @if($ocorrencia->oco_id == $nota->nf_ocorrencia)
                  <option value="{{ $ocorrencia->oco_id }}" selected>{{ $ocorrencia->oco_descricao }}</option>
                  @else
                  <option value="{{ $ocorrencia->oco_id }}">{{ $ocorrencia->oco_descricao }}</option>
                  @endif
                @endforeach
              </select>
            </td>
            <td>
              <textarea
                name="obsoco_{{ $nota->nf_chave }}"
                class="form-control"
                maxlength="240"
                data-toggle="tooltip" data-placement="left" title="Limite de 200 caracteres."
              >{{ $nota->nf_obs }}</textarea>
            </td>
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
