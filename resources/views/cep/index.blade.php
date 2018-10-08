@extends('template.app')
@section('corpo')

    <div class="row">
        <div class="col-md-12">
            <h1>Teste Printi</h1>
            <p>Calculo de Frete</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cep">CEP Origem:</label>
                        <input type="text" name="cep" v-model="origin_zip_code" v-on:blur="buscaCep(origin_zip_code, 'origem')" aria-describedby="cepHelp" placeholder="00000-000">
                        <small id="emailHelp" class="form-text text-muted">Insira o CEP</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cep">CEP Destino:</label>
                        <input type="text" name="cep" v-model="destination_zip_code" v-on:blur="buscaCep(destination_zip_code, 'destino')" aria-describedby="cepHelp" placeholder="00000-000">
                        <small id="emailHelp" class="form-text text-muted">Insira o CEP</small>
                    </div>
                </div>




                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cep">Peso:</label>
                        <input type="text" name="weight" v-model="weight" >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cep">Custo dos produtos:</label>
                        <input type="text" name="cost_of_goods" v-model="cost_of_goods" >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cep">Largura:</label>
                        <input type="text" name="width​" v-model="width" >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cep">Altura:</label>
                        <input type="text" name="height​" v-model="height" >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cep">Comprimento:</label>
                        <input type="text" name="length​" v-model="length" >
                    </div>

                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-success">Calcular!</button>
                    </div>
                </div>


            </form>
        </div>

        <div class="col-md-3">
            <div class="row">
                <p><b>Endereço de Origem:</b> ${origin_endereco}</p>
            </div>
            <div class="row">
                <p><b>Cidade de Origem:</b> ${origin_cidade}</p>
            </div>
            <div class="row">
                <p><b>Estado de Origem:</b> ${origin_estado}</p>
            </div>
            <div class="row">
                <p><b>Bairro de Origem:</b> ${origin_bairro}</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="row">
                <p><b>Endereço de Entrega:</b> ${endereco}</p>
            </div>
            <div class="row">
                <p><b>Cidade de Entrega:</b> ${cidade}</p>
            </div>
            <div class="row">
                <p><b>Estado de Entrega:</b> ${estado}</p>
            </div>
            <div class="row">
                <p><b>Bairro de Entrega:</b> ${bairro}</p>
            </div>
        </div>
    </div>
    ${message}
    @stop