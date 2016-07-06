jQuery(document).ready(function ($) {

    // validate the comment form when it is submitted
    $("#frmCadastroVideo").validate({// initialize the plugin
        rules: {
            titulo: {
                required: true,
            },
            descricao: {
                required: true
            }
            ,
            url: {
                required: true,
               // url: true
            }           
        }, messages: {
            titulo: "Informe um Título",
            descricao: "Informe a Descrição",
            url: "Informe a URL do vídeo",
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