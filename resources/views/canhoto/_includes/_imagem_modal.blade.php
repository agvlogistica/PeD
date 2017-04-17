<div class="modal inmodal" id="imagem_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Confirmar a imagem do canhoto?</h4>
            </div>
            <form action="{{ route('canhoto.upload')  }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="nf_id_controle" id="nf_id_controle" value="">
                <input type="hidden" name="nf_flag" id="nf_flag" value="1">
                <div class="modal-body" style="padding-bottom: 0px;">
                    <div class="thumbnail">
                        <img id="canhoto_img" data-src="" alt="" class="" style="width: 538px; height: 300px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Confirmar</button>
                    <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
