<template>
  <div class="container mt-5 mx-3 bg" >
    <b-col class="mt-5">
      <b-row class="justify-content-center">
        <b-col cols="8">
          <h4 class="my-3 font-weight-bold">Cadastro de Desenvolvedor</h4> <br/>
          <b-form-group
              id="nome-completo"
              class="font-weight-bold"
              label="Nome Completo"
              label-for="Nome Completo"
              :state="desenvolvedor.nivel ? true : false"
            >
            <b-form-input
                id="nome-completo"
                type="text"
                required
                placeholder="Nome Completo"
                v-model="desenvolvedor.nome"
            ></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>

      <b-row class="justify-content-center">
        <b-col cols="8">
          <b-form-group
              id="sexo"
              label="Sexo"
              class=" font-weight-bold"
              label-for="sexo">
            <b-form-select
                id="sexo"
                required
                v-model="desenvolvedor.sexo">
              <option value="M">Masculino</option>
              <option value="F">Feminino</option>
              <option value="O">Outro</option>
            </b-form-select>
          </b-form-group>
        </b-col>
      </b-row>


      <b-row class="justify-content-center">
        <b-col cols="8">
          <b-form-group
              id="nivel"
              label="Nivel"
              class="font-weight-bold"
              label-for="nivel">
            <b-form-select
                id="nivel"
                required
                placeholder="Selecione"
                v-model="desenvolvedor.nivelId">
              <option v-for="nivel of niveis" :key="nivel.id" :value="nivel.id">{{nivel.nivel}}</option>

            </b-form-select>
          </b-form-group>
        </b-col>
      </b-row>

      <b-row class="justify-content-center">
        <b-col cols="8">
          <b-form-group
              id="data"
              label="Data:"
              class="font-weight-bold"
              label-for="data">
            <b-form-input
                id="data"
                required
                type="date"
                placeholder="dd/mm/aaaa"
                v-model="desenvolvedor.datanascimento"
            ></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>

      <b-row class="justify-content-center">
        <b-col cols="8">
          <b-form-group
              id="idade"
              label="Idade: "
              class="font-weight-bold"
              label-for="idade">
            <b-form-input
                id="idade"
                required
                min="0"
                max="120"
                v-mask="'##'"
                placeholder="Digite a idade"
                v-model="desenvolvedor.idade"
            ></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>

      <b-row class="justify-content-center">
        <b-col cols="8">
          <b-form-group
              id="hobby"
              label="Hobby: "
              class="font-weight-bold"
              label-for="hobby">
            <b-form-input
                id="hobby"
                required
                placeholder="Digite seu hobby"
                v-model="desenvolvedor.hobby"
            ></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>

      <b-row class="justify-content-center">

          <b-col class="mt-5 p-3" cols="0">

            <b-button variant="primary" class="px-5" @click="addNewdesenvolvedor"
            >Cadastrar
            </b-button
            >
          </b-col>
      </b-row>
    </b-col>
  </div>
</template>

<script>
import axios from "axios";
import {mask} from 'vue-the-mask'

export default {
  name: "CreatedesenvolvedorModal",

  data() {
    return {
      niveis:[],
      success: false,
      desenvolvedor: {},
      error: null,
    };
  },
  directives: {
        mask
    },
  created() {
    this.getNiveis()
  },
  methods: {
    seeAlertSucesso(){
      this.$swal("Sucesso", "Desenvolvedor Criado com Sucesso", "success")
    },
    seeAlertError(){
      this.$swal("Erro", "Algo de errado aconteceu ao criar o Desenvolvedor", "error")
    },
    getNiveis(){
      axios
          .get("http://127.0.0.1:8000/api/niveis")
          .then((response) => {
            this.niveis = response.data.data;
          })
    },

    addNewdesenvolvedor() {
      if (!this.desenvolvedor.nome) {
        this.error = "O campo Nome é obrigatório";
        return;
      }
      axios
          .post("http://127.0.0.1:8000/api/desenvolvedor/desenvolvedores/", this.desenvolvedor)
          .then((response) => {
            console.log(response.data);
            this.$emit("reloadDataTable");
            this.$emit("showSuccessAlert");
            this.success = true;
            this.seeAlertSucesso();
            this.desenvolvedor.nome = "";
            this.desenvolvedor.sexo = "";
            this.desenvolvedor.nivelId = "";
            this.desenvolvedor.datanascimento = "";
            this.desenvolvedor.idade = "";
            this.desenvolvedor.hobby = "";

          })
          .catch((error) => {
            console.log(error);
            this.seeAlertError();
          });
    },
  },
};
</script>