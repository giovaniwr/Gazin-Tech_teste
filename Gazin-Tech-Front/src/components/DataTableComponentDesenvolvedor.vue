<template>
  <b-container class="card">
    <b-row>
      <b-col class="mt-3">
        <b-form-group label="Nome Completo" label-for="nome" label-class="h4 font-weight-bold" class="mb-4">
          <b-input-group class="rounded-pill">
            <b-form-input
                id="nome"
                v-model="form.searchDesenv"
                placeholder="Pesquisar Desenvolvedor"
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
        :sort-desc.sync="form.sortDesc"
        class="text-center"
    >
      <template #cell(contact_name)="data">
        {{ `${data.item.contact_firstname} ` }}
      </template>
      <template #cell(desenvolvedor_status)="data">
        <b-icon-bookmark-check-fill
            variant="success"
            v-if="data.item.desenvolvedor_status === 'active'"
        ></b-icon-bookmark-check-fill>
        <b-icon-bookmark-x-fill
            variant="danger"
            v-else
        ></b-icon-bookmark-x-fill>
      </template>
      <template #cell(actions)="data">
        <b-row class="justify-content-center">
          <b-col cols="1">
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
        ref="edit-desenvolvedor-modal"
        size="xl"
        hide-footer
    >
      <edit-desenvolvedor-form
          @closeEditModal="closeEditModal"
          @reloadDataTable="getdesenvolvedorData"
          @seeAlertSucesso="seeAlertSucesso"
          :desenvolvedorId="desenvolvedorId"
      ></edit-desenvolvedor-form>
    </b-modal>

  </b-container>
</template>

<script>
import axios from "axios";
import EditDesenvolvedorForm from "@/components/EditDesenvolvedorForm.vue";

export default {
  components: {
    EditDesenvolvedorForm,

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
          key: "nome",
          label: "Nome Completo",
          sortable: true,
        },
        {
          key: "nivel.nivel",
          label: "Nivel",
          sortable: false,
        },
        {
          key: "sexo",
          label: "Sexo",
          sortable: false,
        },
        {
          key: "datanascimento",
          label: "Data",
          sortable: false,
        },
        {
          key: "idade",
          label: "Idade",
          sortable: false,
        },
        {
          key: "hobby",
          label: "Hobby",
          sortable: false,
        },
        "actions",
      ],
      form: {
        sortBy: 'nome',
        sortDesc: false,
        page: 1,
        nome: null,
        searchDesenv: '',
      },
      items: [],
      desenvolvedorId: 0,

    };
  },
  mounted() {
    this.getdesenvolvedorData();
  },
  methods: {
    getdesenvolvedorData() {
      axios
          .get("http://127.0.0.1:8000/api/desenvolvedor/desenvolvedores/")
          .then((response) => {
            this.items = response.data;
            console.log(this.items)
          })
          .catch((error) => {
            console.log(error);
          });
    },
    getRowData(id) {
      this.$refs["edit-desenvolvedor-modal"].show();
      this.desenvolvedorId = id;
    },
    closeEditModal() {
      this.$refs["edit-desenvolvedor-modal"].hide();
    },
    searchData() {
      const searchDesenv = this.form.searchDesenv.toLowerCase();
      this.items = this.items.filter(item => {
        return item.nome.toLowerCase().includes(searchDesenv);
      });
    },
    seeAlertSucesso() {
      this.$swal("Sucesso", "Desenvolvedor Atualizado com Sucesso", "success")
    },
    seeAlertDeleted() {
      this.$swal("Sucesso", "Nivel Deletado com Sucesso", "success")
    },
    seeAlertError() {
      this.$swal("Erro", "Algo de errado aconteceu ao atualizar o Desenvolvedor", "error")
    },
    cleanFild(){
      this.form.searchDesenv = '';
      this.getdesenvolvedorData();
    },
    deleteCadastro(id) {
      return this.$swal({
        text: 'Deseja deletar o Desenvolvedor',
        icon: 'warning',
        showCancelButton: true,
      }).then((value) => {
        if (value.isConfirmed) {
          axios
              .delete(`http://127.0.0.1:8000/api/desenvolvedor/desenvolvedores/${[id]}`)
              .then((response) => {
                console.log(response.data);
                this.getdesenvolvedorData()
                this.seeAlertDeleted()
              })
              .catch((error) => {
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

.alert {
  width: 100%;
  text-align: center;
}
</style>