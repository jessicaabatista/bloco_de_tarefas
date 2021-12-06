//select ta tabela
$('tr[data-href]').on("click", function () {
    document.location = $(this).data('href');
});

//sumir com os alerts
setTimeout(function () {
    $('.alert').fadeOut('fast');
}, 3200);

$("[data-toggle=tooltip]").tooltip();

//tela de carregamento
window.onload = function () {
    //criando a div
    var blockUI = document.createElement("div");
    blockUI.setAttribute("id", "blocker");
    //<div class="c-loader"></div>
    blockUI.innerHTML = '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status" style="width: 6rem; height: 6rem;"></div></div>';
    document.body.appendChild(blockUI);

    var cover = document.getElementById("blocker").style.display = "none";

    //id do botões
    var btn = document.getElementById("home");
    var btn3 = document.getElementById("cadastroAnotacao");
    var btn4 = document.getElementById("anotacoes");
    var btn5 = document.getElementById("cadastroUsuario");

    btn.onclick = block;
    btn3.onclick = block;
    btn4.onclick = block;
    btn5.onclick = block;

    function block() {
        document.getElementById("blocker").style.display = "";
        setTimeout(function () {
            document.getElementById("blocker").style.display = "none";
        }, 15000);
    }
}

function MudarBotao(botao = '#botao') {
    document.getElementById(botao).innerHTML = "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Carregando...";
    return true;
}

function MudarBotaoComInputs(botao = '#botao', formulario = '#form') {

    if (!validar('#' + formulario)) {
        return false;
    }
    document.getElementById(botao).innerHTML = "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Carregando...";
    return true;
}

function validar(form = '#form-cadastrar') {
    campos = '';
    $(form + " input[required] ," + form + " select[required], " + form + " textarea[required]").each(function (index, el) {
        if ($(this).val() == null || $(this).val() == '') {
            var element = $(this).parent().prev();
            var idTask = $(element).text();


            $(this).addClass('inputRequire');
            $(this).change(function (event) {
                if ($(this).val() == null || $(this).val() == '') {

                } else {
                    $(this).removeClass('inputRequire');
                    $(this).off('change');
                }

            });
            console.log($(this));
            data = $(this).attr('data-required');
            label = $("label[for='" + $(this).attr('id') + "']").html();
            title = $(this).attr('title');
            placeholder = $(this).attr('placeholder');
            id = $(this).attr('id');

            if (typeof data != "undefined") {
                nomeCampo = data;
            } else if (typeof label != "undefined") {
                nomeCampo = label;
            } else if (typeof title != "undefined") {
                nomeCampo = title;
            } else if (typeof placeholder != "undefined") {
                nomeCampo = placeholder;
            } else {
                nomeCampo = idTask;
            }

            campos += '<br> <b>' + nomeCampo + '</b>';
        }
    });

    if (campos != '') {
        alertify.confirm('', '<b style="color:#008FDC">Atenção</b>, os seguintes campos precisam ser preenchidos: ' + campos + '</b> ', function () {
        }, function () {
        }).set('labels', { ok: 'OK', cancel: null });
        return false;

    }
    return true;
}

function carregarLoading(idRecebido = '#btnRecebido') {
    //criando a div
    var blockUI = document.createElement("div");
    blockUI.setAttribute("id", "blocker");
    //<div class="c-loader"></div>
    blockUI.innerHTML = '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status" style="width: 6rem; height: 6rem;"></div></div>';
    document.body.appendChild(blockUI);

    var cover = document.getElementById("blocker").style.display = "none";

    //id do botões
    var btn = idRecebido;

    function block() {
        document.getElementById("blocker").style.display = "";
        setTimeout(function () {
            document.getElementById("blocker").style.display = "none";
        }, 15000);
    }

}
