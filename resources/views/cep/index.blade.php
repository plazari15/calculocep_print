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

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cep">CEP Origem:</label>
                        <input type="text" id="cep" name="cep" v-model="origin_zip_code" v-on:blur="buscaCep(origin_zip_code, 'origem')" aria-describedby="cepHelp" placeholder="00000-000">
                        <small id="emailHelp" class="form-text text-muted">Insira o CEP</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cep">CEP Destino:</label>
                        <input type="text" class="cep" name="cep" v-model="destination_zip_code" v-on:blur="buscaCep(destination_zip_code, 'destino')" aria-describedby="cepHelp" placeholder="00000-000">
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
                        <button class="btn btn-success" v-on:click="buscaFretes(); return false;">Calcular!</button>
                    </div>
                </div>


            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dias para entrega</th>
                    <th scope="col">Custo (R$)</th>
                    <th scope="col">Descrição</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="frete in fretes_encontrados">
                    <th scope="row"><input type="radio" name="frete" v-bind:value="frete.delivery_method_name" v-model="frete_escolhido.delivery_method_name" v-on:click="freteEscolhido(frete)"></th>
                    <td v-if="frete.mesmodia == true">ENTREGA HOJE</td>
                    <td v-if="frete.mesmodia == false">${frete.delivery_estimate_business_days} dia(s) úteis</td>
                    <td>R$ ${frete.final_shipping_cost}</td>
                    <td>${frete.description}</td>
                </tr>
                </tbody>
            </table>

            <button type="submit" name="escolherFrete" v-on:click="btnFretePressed()">Selecionar Frete</button>
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
    @stop