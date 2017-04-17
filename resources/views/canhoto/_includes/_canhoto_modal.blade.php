<div class="modal inmodal" id="canhoto_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Canhoto</h4>
            </div>
            <form action="{{ route('canhoto.upload')  }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="nf_id_controle" id="nf_id_controle" value="">
                <div class="modal-body" style="padding-bottom: 0px;">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 538px; height: 300px;">
                            <img id="canhoto_img" data-src="" alt="">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 538px; max-height: 300px;"></div>
                        <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">Selecione a imagem</span><span class="fileinput-exists">Alterar</span><input type="file" name="nf_canhoto"></span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                    <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
