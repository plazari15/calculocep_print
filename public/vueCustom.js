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
        origin_endereco : '',
        origin_cidade : '',
        origin_estado: '',
        origin_bairro: '',
        destination_zip_code: '',
        origin_zip_code: '',
        weight: '',
        cost_of_goods: '',
        width: '',
        height: '',
        length: ''
    },
    methods: {
        buscaCep: function (cep, cepType) {
            alert('iniciado');
            console.log(cep);
            axios.post('/buscaCep', {
                cep: cep
            }).then(function (response) {
                var dados = response.data.dados;

                console.log(response.data.dados);
                console.log(dados);
                console.log(cepType);

                if(cepType == 'origem'){
                    app.origin_endereco = dados.logradouro;
                    app.origin_cidade = dados.cidade;
                    app.origin_estado = dados.estado;
                    app.origin_bairro = dados.bairro;
                }else{
                    app.endereco = dados.logradouro;
                    app.cidade = dados.cidade;
                    app.estado = dados.estado;
                    app.bairro = dados.bairro;
                }

            }).catch(function (data) {
                alert('Infelizmente tivemos um problema com o CEP informado.');
            })
        }
    }
});