const axios = require('axios').default;

const $ = require( "jquery" );

axios.get('/api/usuario')
.then(function (response) {
    // handle success
    console.log(response);
    const selectUsuario = $('#usuario');
    for (const usuario of response.data) {
        selectUsuario.append(`<option value="${usuario.UsuarioId}"> ${usuario.Nome} </option>`);
    }
});

axios.get('/api/anotacao')
.then(function (response) {
    // handle success
    console.log(response);
    const selectAnotacao = $('#lista');
    for (const anotacao of response.data) {
        selectAnotacao.append(`<p value="${anotacao.AnotacaoId}"> ${anotacao.Nome} </p>`);
    }
});