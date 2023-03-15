<template>
  <b-form class="mt-5">
    <h4 class="text-center">Atualize o Desenvolvedor</h4>
    <b-row class="justify-content-center">
    
        <b-col cols="8">
          <p>Nome:</p>
            <b-form-input
                id="nome-completo"
                type="text"
                required
                placeholder="Nome Completo"
                v-model="desenvolvedor.nome"
            ></b-form-input>
        </b-col>
      </b-row>

    <b-row class="justify-content-center">
      <b-col cols="8">
        <p>Sexo:</p>
        <b-form-select
            id="sexo"
            required
            v-model="desenvolvedor.sexo">
          <option value="M">Masculino</option>
          <option value="F">Feminino</option>
          <option value="O">Outro</option>
        </b-form-select>
      </b-col>
    </b-row>

    <b-row class="justify-content-center">
      <b-col cols="8">
        <p>Nivel:</p>
        <b-form-select
            id="nivel"
            required
            placeholder="Selecione"
            v-model="desenvolvedor.nivelId">
          <option v-for="nivel of niveis" :key="nivel.id" :value="nivel.id">{{nivel.nivel}}</option>

        </b-form-select>
      </b-col>
    </b-row>


      <b-row class="justify-content-center">
        <b-col cols="8">
          <p>Data:</p>
            <b-form-input
                id="data"
                required
                type="date"
                placeholder="dd/mm/aaaa"
                v-model="desenvolvedor.datanascimento"
            ></b-form-input>
        </b-col>
      </b-row>


      <b-row class="justify-content-center mt-1">
        <b-col cols="8">
          <p>Idade:</p>
            <b-form-input
                id="idade"
                required
                placeholder="Digite a idade"
                v-model="desenvolvedor.idade"
            ></b-form-input>
        </b-col>
      </b-row>


      <b-row class="justify-content-center">
        <b-col cols="8">
          <p>Hobby:</p>
            <b-form-input
                id="hobby"
                type="email"
                required
                placeholder="Digite seu hobby"
                v-model="desenvolvedor.hobby"
            ></b-form-input>
        </b-col>
      </b-row>

    <b-row class="mt-4 ">
      <b-col cols="5">
      </b-col>
      <b-col>
         <b-button variant="primary" class="px-5 mx-2" @click="updatedesenvolvedor"
        >Salvar</b-button
        >
        <b-button variant="warning" @click="triggerClose">Close</b-button>
      </b-col>
    </b-row>
  </b-form>
</template>

<script>
import axios from "axios";

export default {
  name: "CreateDesenvolvedorModal",
  props: {
    desenvolvedorId: Number,
  },
  data() {
    return {
      niveis:[],
      desenvolvedor: {},
    };
  },
  mounted() {
    this.getCusomterByID();
    this.getNiveis();
  },
  methods: {
    getNiveis(){
      axios
          .get("http://127.0.0.1:8000/api/niveis")
          .then((response) => {
            this.niveis = response.data.data;
          })
    },
    triggerClose() {
      this.$emit("closeEditModal");
    },
    getCusomterByID() {
      axios
          .get(`http://127.0.0.1:8000/api/desenvolvedor/desenvolvedores/${this.desenvolvedorId}`)
          .then((response) => {
            this.desenvolvedor = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
    },
    updatedesenvolvedor() {
      axios
          .put(
              `http://127.0.0.1:8000/api/desenvolvedor/desenvolvedores/${this.desenvolvedorId}`,
              this.desenvolvedor
          )
          .then((response) => {
            console.log(response.data);
            this.$emit("closeEditModal");
            this.$emit("reloadDataTable");
            this.$emit("seeAlertSucesso");
          })
          .catch((error) => {
            console.log(error);
          });
    },
  },
};
</script>