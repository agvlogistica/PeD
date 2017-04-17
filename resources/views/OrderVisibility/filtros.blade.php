<br>
<form method="POST" action="{{ route('order_visibility.recarregaindex') }}">
{{ csrf_field() }}
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="dtini">De:</label>
            <div class="input-group date">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <input id="dtini" name="dtini" type="text" class="form-control datas" value="{{ $data_inicial }}" />
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="dtfim"> até</label>
            <div class="input-group date">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <input id="dtfim" name="dtfim" type="text" class="form-control datas" value="{{ $data_final }}" />
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>&nbsp;</label>
            <div class="input-group">
                <button type="submit" class="btn btn-primary" id="btnatualizar"><i class="fa fa-refresh"></i> Atualizar</button>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
  <div class="col-md-5 row">
  </div>
</div>
</form>
