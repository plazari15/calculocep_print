@extends('template.app')
@section('corpo')

    <div class="row">
        <div class="col-md-12">
            <h1>Teste Printi</h1>
            <p>Calculo de Frete</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cep">CEP:</label>
                        <input type="text" name="cep" v-model="cep" v-on:blur="buscaCep(cep)" aria-describedby="cepHelp" placeholder="00000-000">
                        <small id="emailHelp" class="form-text text-muted">Insira o CEP</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cep">Endereço:</label>
                        <input type="text" name="cep" v-model="endereco" v-bind:value="endereco">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cep">Cidade:</label>
                        <input type="text" name="cep" v-model="cidade" >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cep">Estado:</label>
                        <input type="text" name="cep" v-model="estado" >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cep">Bairro:</label>
                        <input type="text" name="cep" v-model="bairro" >
                    </div>
                </div>


            </form>
        </div>
    </div>
    ${message}
    @stop