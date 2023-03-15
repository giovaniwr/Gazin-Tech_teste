<template cla>
  <div class="container mt-5 mx-3 bg" >
    <b-col class="mt-5">

      <b-row class="justify-content-center">
        <b-col cols="8">
          <h4 class="my-3 font-weight-bold">Cadastro de Nivel</h4> <br/>
          <b-form-group
              id="nivel"
              class="font-weight-bold"
              label="Nivel"
              label-for="Nivel"
              :state="nivel.nivel ? true : false"
          >
            <b-form-input
                id="nivel"
                type="text"
                placeholder="Nivel"
                v-model="nivel.nivel"
            ></b-form-input>

          </b-form-group>
        </b-col>
      </b-row>

      <b-row class="justify-content-center">
        <b-col class="mt-5 p-3" cols="0">
          <b-button variant="primary" class="px-5" @click="addNewNivel">
            Cadastrar
          </b-button>
        </b-col>
      </b-row>

    </b-col>
  </div>
</template>

<script>
import axios from "axios";
import {mask} from 'vue-the-mask'

export default {
  name: "CreateNivelModal",
  data() {
    return {
      success: false,
      nivel: {},
      error: null,
    };
  },
  directives: {
    mask
  },
  methods: {
    seeAlertSucesso(){
      this.$swal("Sucesso", "Nivel Criado com Sucesso", "success")
    },
    seeAlertError(){
      this.$swal("Erro", "Algo de errado aconteceu ao criar o nível", "error")
    },
    addNewNivel() {
      if (!this.nivel.nivel) {
        this.error = "O campo Nivel é obrigatório";
        return;
      }
      axios
          .post("http://127.0.0.1:8000/api/niveis", this.nivel)
          .then(() => {
            this.$emit("reloadDataTable");
            this.$emit("seeAlertSucesso");
            this.seeAlertSucesso();
            this.success = true
            this.nivel.nivel = "";
          })
          .catch(() => {
            this.seeAlertError()
          });
    },
  },
};
</script>
