var app = new Vue({
    el: '#app',
    delimiters: ['${', '}'],
    data: {
        message: 'Pedro, o vue foi',
        cep : '',
        endereco : '',
        cidade : '',
        estado: '',
        bairro: '',
    },
    methods: {
        buscaCep: function (cep) {
            alert('iniciado');
            console.log(cep);
            axios.post('/buscaCep', {
                cep: cep
            }).then(function (response) {
                var dados = response.data.dados;

                console.log(response.data.dados);
                console.log(dados);

                app.endereco = dados.logradouro;
                app.cidade = dados.cidade;
                app.estado = dados.estado;
                app.bairro = dados.bairro;
            }).catch(function (data) {
                alert('Infelizmente tivemos um problema com o CEP informado.');
            })
        }
    }
});