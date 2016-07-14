jQuery(document).ready(function ($) {

    // validate the comment form when it is submitted
    $("#frmCadastroUnidade").validate({// initialize the plugin
        rules: {
            descricao: {
                required: true
            }

        }, messages: {
            descricao: "Informe a Descrição",
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