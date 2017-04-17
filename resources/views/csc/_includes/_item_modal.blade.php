<div class="modal inmodal" id="item_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Itens</h4>
                <p class="font-bold">DAP: <span id="cod_pre_rat"></span> - <span id="nome_fornec"></span> - NF <span id="numero_nota_fiscal"></span> - <span id="valor_nota_fiscal"></span></p>
            </div>
            <div class="modal-body" style="padding-bottom: 0px;">
                <table id="lista_item_table" class="table table-striped table-condensed" style="font-size: 11px;">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Conta</th>
                            <th>Centro de Custo</th>
                            <th>Item</th>
                            <th>Quantidade</th>
                            <th>Valor Unitário</th>
                            <th>Valor Total</th>
                            <th>Observação</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <p class='text-center font-bold'>Processo: <span id="numero_processo"></span>          Meio Pgto.: <span id="meio_pagto"></span></p>
                <p class='text-center font-bold'>Motivo: <span id="motivo"></span></p>
            </div>
        </div>
    </div>
</div>
