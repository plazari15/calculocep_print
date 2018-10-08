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
        length: '',
        frete_escolhido: {
            delivery_method_name: '',
            final_shipping_cost: '',
            delivery_estimate_business_days: ''
        },
        fretes_encontrados: []
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
        },
        buscaFretes: function () {
            console.log('iniciando a busca de fretes');
            axios.post('/buscaFrete', {
                cep_origem: app.origin_zip_code,
                cep_destino: app.destination_zip_code,
                weight: app.weight,
                cost_of_goods: app.cost_of_goods,
                width: app.width,
                height: app.height,
                length: app.length
            }).then(function (data) {
                console.log('Tivemos um retorno');
                console.log(data.data);
                app.fretes_encontrados = data.data.fretes;

                app.fretes_encontrados.forEach(function (frete) {
                   if(frete.delivery_estimate_business_days == 0){
                       frete.mesmodia = true;
                   }else{
                       frete.mesmodia = false;
                   }
                });
            }).catch(function (data) {
                console.log('tivemos um erro');
            });

            return false;
        },
        freteEscolhido: function (frete) {
            app.frete_escolhido.delivery_method_name = frete.delivery_method_name;
            app.frete_escolhido.final_shipping_cost = frete.final_shipping_cost;
            app.frete_escolhido.delivery_estimate_business_days = frete.delivery_estimate_business_days;
        },
        btnFretePressed: function () {
            alert(app.frete_escolhido.delivery_method_name + ", R$"+app.frete_escolhido.final_shipping_cost + ", "+app.frete_escolhido.delivery_estimate_business_days+" dia");
        }
    }
});