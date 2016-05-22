{{-- Enunciado da pergunta --}}
<div class="questao">
    <div class="form-group">
        <div class="col-sm-3 "></div>
        <div class="col-sm-9">
            <div class=" btn-group btn-group-xs pull-right" role="group" aria-label="...">
                <button type="button" class="btn btn-primary questao-excluir">
                    <span class="glyphicon  glyphicon-ban-circle"></span>&nbsp;Excluir Questão
                </button>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="titulo" class="col-sm-3 control-label">Enunciado</label>
        <div class="col-sm-9">
            <textarea class="form-control" id="pergunta1" name="pergunta1" placeholder="Enuciado da Questão"></textarea>
            <p class="help-block">Respostas</p>
        </div>
    </div>

    <div class="respostas">
        {{-- inserir 4 respostas iniciais para a atividade--}}
        @for ($i = 0; $i < 4; $i++)
            @include('cursos.partial.atividade-resposta',array( "valor" => $i  ))
        @endfor
    </div>

    {{-- Botão de adicionar novas respostas--}}
    <div class="form-group ">
        <div class="col-sm-3 "></div>
        <div class="col-sm-9">
            <div class=" btn-group btn-group-xs " role="group" aria-label="...">
                <button type="button" class="btn btn-success questao-adicionar">
                    <span class="glyphicon  glyphicon-plus"></span>Adicionar Resposta
                </button>
            </div>
        </div>
    </div>
    <legend></legend>
</div>