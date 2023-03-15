<template>
  <b-form class="mt-5">
    <h4 class="text-center">Atualize o Nivel</h4>
    <b-row class="justify-content-center">

        <b-col cols="8">
          <p>Nivel:</p>
            <b-form-input
                id="nivel"
                type="text"
                required
                placeholder="Nivel"
                v-model="nivel.nivel"
            ></b-form-input>
        </b-col>
      </b-row>

    <b-row class="mt-4 ">
      <b-col cols="5">
      </b-col>
      <b-col>
         <b-button variant="primary" class="px-5 mx-2" @click="updateNivel"
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
  name: "CreateNivelModal",
  props: {
    nivelId: Number,
  },
  data() {
    return {
      nivel: {},
    };
  },
  mounted() {
    this.getNivelByID();
  },
  methods: {
    triggerClose() {
      this.$emit("closeEditModal");
    },
    getNivelByID() {
      axios
          .get(`http://127.0.0.1:8000/api/niveis/${this.nivelId}`)
          .then((response) => {
            this.nivel = response.data.data;
          })
          .catch(() => {
          });
    },
    updateNivel() {
      axios
          .put(
              `http://127.0.0.1:8000/api/niveis/${this.nivelId}`,
              this.nivel
          )
          .then(() => {
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