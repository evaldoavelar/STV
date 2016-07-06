jQuery(document).ready(function ($) {

    // validate the comment form when it is submitted
    $("#frmCadastroMaterial").validate({// initialize the plugin
        rules: {
            titulo: {
                required: true,
            },
            descricao: {
                required: true
            }
            ,
            arquivo: {
                required: true,
            }           
        }, messages: {
            titulo: "Informe um Título",
            descricao: "Informe a Descrição",
            arquivo: "Selecione um arquivo para upload",
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