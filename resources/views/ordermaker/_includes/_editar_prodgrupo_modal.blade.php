<div class="modal inmodal" id="editar_prodgrupo_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Editar Grupo de Produto</h4>
            </div>
            <form class="form-horizontal">
                <input type="hidden" name="id" id="id" value="">
                <div class="modal-body" style="padding-bottom: 0px;">
                    <div class="form-group">
                        <label for="nome" class="col-md-2 control-label">Código</label>
                        <div class="col-md-10">
                            <input type="text" id="codigo" value="" class="form-control" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label for="nome" class="col-md-2 control-label">Nome</label>
                        <div class="col-md-10">
                            <input type="text" id="nome" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome" class="col-md-2 control-label">Ativo</label>
                        <div class="col-md-10">
                            <input type="checkbox" id="ativo" value="1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="cadastrar" type="submit">Cadastrar</button>
                    <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
