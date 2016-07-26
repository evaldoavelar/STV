{{-- resposta da atividade --}}
<div class="form-group" id="resposta-{{$valor}}">
    <div class="col-xs-1 col-sm-3"></div>
    <div class="col-xs-1 col-sm-1">
        <input type="radio" name="questao[{{$indice}}][correta]" class="pull-right" value="{{ isset($valor)? $valor : '1'  }}">
    </div>
    <div class="col-xs-7 col-sm-7">
        <input type="hidden" name="questao[{{$indice}}][resposta][{{$valor}}][status]" value="N">
        <textarea type="text"
                  class="form-control" id="resposta"
                  rows="3"
                  name="questao[{{$indice}}][resposta][{{$valor}}][enunciado]" placeholder="Resposta"></textarea>
    </div>
    <div class="col-xs-1 col-sm-1">
        {{-- excluir a resposta --}}
        <span class="glyphicon glyphicon-ban-circle resposta-excluir" title="Remover Opção"></span>
    </div>
</div>
