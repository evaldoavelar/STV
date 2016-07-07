jQuery(document).ready(function ($) {

    // validate the comment form when it is submitted
    $("#frm-curso").validate({// initialize the plugin
        rules: {
            titulo: {
                required: true,               
            },
            descricao: {
                required: true
            }
            ,
            instrutor: {
                required: true,
            }
            ,
            categoria_id: {
                required: true
            },
            palavras_chaves: {
                required: true,
                minlength :3
            }
        }, messages: {
            titulo: "Informe um Título",
            descricao: "Informe a Descrição",
            instrutor: "Informe o nome do Instrutor",
            categoria_id: "Informe a Categoria",
            palavras_chaves: {
                required: "Informe algumas palavras chaves para identificar o curso",
                minlength: "Numero de Palavras-Chaves muito curto"
            }

        },
        onfocusout: function (element) {
            $(element).valid();
        },
        errorPlacement: function (error, element) {
            error.insertBefore(element);
        },
        submitHandler: function (form) {           
            return true;
        }
    });
});