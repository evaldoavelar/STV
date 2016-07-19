<script>
    $(function () {

        //id dos elementos
        var idResposta = 0;
        var idQuestao = 0;

        $("#btnNovaQuestao").click(function (event) {

            idQuestao++;

            $.ajax({
                url: "{{ url('/atividade-questao') }}/" + idQuestao,
                success: function (result) {
                    console.log("Requisição Ajax completada com sucesso");
                    console.log("Adicionando resultado");

                    $("#questoes").append(result);

                    configurarAdicionarQuestao('.questao-adicionar', idQuestao);

                    configurarExcluirQuestao('.questao-excluir');

                    configurarExcluirResposta('.resposta-excluir');

                    //adicionar respostas
                    for (i = 0; i < 4; i++) {
                        AdicionarResposta($("#questao-" + idQuestao).find('.respostas'), idQuestao);
                    }
                },
                error: function (event) {
                    console.log("Erro na Requisição Ajax ");
                }
            });
        });

        function configurarAdicionarQuestao(classe, id) {
            console.log("Configurar o click do botão de adicionar resposta");
            $.each($(classe), function (i, value) {

                //remover o onclick de dos botões criados anteriormente para não gerar conflito
                $(value).attr('onclick', '').unbind('click');

                //adicionar o novo click
                $(value).click(function () {
                    var root = this.parentNode.parentNode.parentNode.parentNode;
                    AdicionarResposta($(root).find('.respostas'), id);
                });
            });
        }


        function configurarExcluirResposta(classe) {
            console.log("Configurar o click do botão de remover resposta");
            $.each($(classe), function (i, value) {
                console.log(value);

                //remover o onclick de dos botões criados anteriormente para não gerar conflito
                $(value).attr('onclick', '').unbind('click');

                //adicionar o novo click
                $(value).click(function () {
                    var root = this.parentNode.parentNode.parentNode;
                    if (root.childElementCount === 2) {
                        alert('A questão deve ter ao menos duas respostas!');
                    } else {
                        if (confirm('Excluir a resposta?')) {
                            //auto remover
                            $(this.parentNode.parentNode).remove();
                        }
                    }
                });

            });
        }

        function configurarExcluirQuestao(classe) {
            console.log("Configurar o click do botão de remover questão");
            $.each($(classe), function (i, value) {

                //remover o onclick de dos botões criados anteriormente para não gerar conflito
                $(value).attr('onclick', '').unbind('click');

                //adicionar o novo click
                $(value).click(function () {
                    if (confirm('Excluir a Questão?')) {
                        //auto remover
                        $(this.parentNode.parentNode).closest('.questao').remove();
                    }
                });

            });
        }

        function AdicionarResposta(div, id) {

            idResposta++;

            $.ajax({
                url: "{{ url('/atividade-resposta') }}/" + id + "/" + idResposta,
                success: function (result) {
                    console.log("Requisição Ajax completada com sucesso");
                    console.log("Adicionando resultado");
                    $(div).append(result);
                    configurarExcluirResposta('.resposta-excluir');
                },
                error: function (event) {
                    console.log("Erro na Requisição Ajax ");
                }
            });

        }

        $('#frmAtividade').submit(function (event) {
            var erros = 0;
            var semCorreta = 0;

            //validar respostas
            $.each($('.questao'), function (i, value) {
                //verificar se as repostas estão preenchidas
                $.each($(value).find('textarea'), function (i, item) {
                    if (item.value.trim() === '') {
                        item.parentElement.parentNode.classList.add('has-error');
                        erros++;
                        console.log(item);
                    } else {
                        item.parentElement.parentNode.classList.remove('has-error');
                    }
                });

                value.classList.remove('has-error');

                //verficar se as questões tem a respotas correta selecionada
                if( $(value).find('input[type=radio]:checked').size() === 0 ){
                    value.classList.add('has-error');
                    semCorreta++;
                }
            });

            if (erros > 0){
                alert('Informe os campos em destaque');
                return false;
            } else if  (semCorreta > 0){
                alert('Marque a respota correta de todas as questões');
                return false;
            }

            return true;
        });




    })
    ;
</script>