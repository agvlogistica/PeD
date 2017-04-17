<br>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Filtros</h5>
    <div class="ibox-tools"><a href="#" class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
  </div>
  <div class="ibox-content" style="display: block;">
    <form method="GET" class="form-horizontal" action="">
      <input type="hidden" id="codtransp" value='{{ $codtransp }}' >
      <div class="form-group">
        <label class="col-sm-1 control-label">CT-e</label>
        <div class="col-sm-1">
          <input type="text" id="cte" name="cte" class="form-control numero">
        </div>
        <label class="col-sm-1 control-label">Remetente</label>
        <div class="col-sm-4">
          <input type="text" id="remetente" name="remetente" class="form-control">
        </div>
        <label class="col-sm-1 control-label">Origem</label>
        <div class="col-sm-2">
          <input type="text" id="origem" name="origem" class="form-control">
        </div>
        <div class="col-sm-2">
          <input type="button" id="btnfiltrar" class="btn btn-w-m btn-default" value="Filtrar">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-1 control-label">NF</label>
        <div class="col-sm-1">
          <input type="text" id="nf" name="nf" class="form-control numero">
        </div>
        <label class="col-sm-1 control-label">Destinatário</label>
        <div class="col-sm-4">
          <input type="text" id="destinatario" name="destinatario" class="form-control">
        </div>
        <label class="col-sm-1 control-label">Destino</label>
        <div class="col-sm-2">
          <input type="text" id="destino" name="destino" class="form-control">
        </div>
      </div>
    </form>
  </div>
</div>
