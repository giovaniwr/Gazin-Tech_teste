<template>
  <b-container class="card">
    <b-row>
      <b-col class="mt-3">
        <b-form-group label="Nível" label-for="nivel" label-class="h4 font-weight-bold" class="mb-4 ">
          <b-input-group class="rounded-pill">
            <b-form-input
                id="nivel"
                v-model="form.searchNivel"
                placeholder="Pesquisar Nível"
                class=" col-6"
            ></b-form-input>
            <b-col cols="auto">
              <div class="form-group">
                <b-button variant="primary" @click='searchData'>
                  <i class="fas fa-search"></i>
                  <span>Filtrar</span>
                </b-button>
                <b-button type="reset" variant="danger" @click="cleanFild">
                  <i class="fas fa-times"></i>
                  <span>Limpar</span>
                </b-button>
              </div>
            </b-col>
          </b-input-group>
        </b-form-group>
      </b-col>
    </b-row>

    <b-table
        striped
        hover
        :items="items"
        :fields="fields"
        :per-page="perPage"
        :current-page="currentPage"
        :sort-by.sync="form.sortBy"
        class="text-center"
    >
      <template #cell(contact_name)="data">
        {{ `${data.item.contact_firstname} ` }}
      </template>
      <template #cell(nivel_status)="data">
        <b-icon-bookmark-check-fill
            variant="success"
            v-if="data.item.nivel_status === 'active'"
        ></b-icon-bookmark-check-fill>
        <b-icon-bookmark-x-fill
            variant="danger"
            v-else
        ></b-icon-bookmark-x-fill>
      </template>
      <template #cell(actions)="data" >
        <b-row class="justify-content-center">
          <b-col cols="1" class="align-items-end">
            <b-icon-pencil-square
                class="action-item"
                variant="primary"
                @click="getRowData(data.item.id)"
            ></b-icon-pencil-square>
          </b-col>
          <b-col cols="1">
            <b-icon-trash-fill
                class="action-item"
                variant="danger"
                @click="deleteCadastro(data.item.id)"
            ></b-icon-trash-fill>
          </b-col>
        </b-row>
      </template>
    </b-table>

    <div class="overflow-auto">
      <b-pagination
          v-model="currentPage"
          :total-rows="rows"
          :per-page="perPage"
          aria-controls="my-table"
      ></b-pagination>
    </div>

    <b-modal
        ref="edit-nivel-modal"
        size="xl"
        hide-footer
    >
      <edit-nivel-form
          @closeEditModal="closeEditModal"
          @reloadDataTable="getnivelData"
          @seeAlertSucesso="seeAlertSucesso"
          :nivelId="nivelId"
      ></edit-nivel-form>
    </b-modal>

  </b-container>
</template>

<script>
import axios from "axios";
import EditNivelForm from "@/components/EditNivelForm.vue";

export default {
  components: {
    EditNivelForm,

  },
  data() {
    return {
      perPage: 7,
      currentPage: 7,
      fields: [
        {
          key: "id",
          label: "",
        },
        {
          key: "nivel",
          label: "Nivel",
          sortable: true,
        },
        {
          key: "totalDev",
          label: "Devs cadastrados",
          sortable: false,
        },
        "actions",
      ],
      items: [],
      form: {
        sortBy: 'nivel',
        sortDesc: false,
        page: 1,
        nivel: null,
        searchNivel: ''
      },
      nivelId: 0,

    };
  },
  mounted() {
    this.getnivelData();
  },
  methods: {
    getnivelData() {
      axios
          .get("http://127.0.0.1:8000/api/niveis")
          .then((response) => {
            this.items = response.data.data;
            console.log(this.items)
          })

          .catch((error) => {
            alert("Não foi possivel buscar os nivel")
            console.log(error);
          });
    },
    getRowData(id) {
      this.$refs["edit-nivel-modal"].show();
      this.nivelId = id;
    },
    closeEditModal() {
      this.$refs["edit-nivel-modal"].hide();
    },
    searchData() {
      const  searchNivel = this.form.searchNivel.toLowerCase();
      this.items = this.items.filter(item => {
        return item.nivel.toLowerCase().includes(searchNivel);
      });
    },
    seeAlertSucesso() {
      this.$swal("Sucesso", "Desenvolvedor Atualizado com Sucesso", "success")
    },
    seeAlertDeleted() {
      this.$swal("Sucesso", "Desenvolvedor Deletado com Sucesso", "success")
    },
    seeAlertNivelcreated() {
      this.$swal("Erro", "Não foi possivel deletar, o nivel está cadastrado em um Desenvolvedor", "error")
    },
    seeAlertError() {
      this.$swal("Erro", "Algo de errado aconteceu ao atualizar o Desenvolvedor", "error")
    },
    cleanFild(){
      this.form.searchNivel = '';
      this.getnivelData();
    },

    deleteCadastro(id) {
      return this.$swal({
        text: 'Deseja deletar o Nivel',
        icon: 'warning',
        showCancelButton: true,
      }).then((value) => {
        if (value.isConfirmed) {
          axios
              .delete(`http://127.0.0.1:8000/api/niveis/${[id]}`)
              .then((response) => {
                console.log(response.data);
                this.getnivelData()
                this.seeAlertDeleted()
              })
              .catch((error) => {
                if (error.response.status === 400) {
                  this.seeAlertNivelcreated()
                  // alert(error.response.data.error)
                }
                console.log(error);
              });
        }
      })
    },
  },
  computed: {
    rows() {
      return this.items.length
    }
  }
};
</script>

<style>
.action-item:hover {
  cursor: pointer;
}

</style>