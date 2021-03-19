<template>
  <div class="container py-4">
    <b-card class="rounded shadow-sm border-0 mb-5">
      <div class="list-load" v-if="loadPage">
        <b-skeleton width="100%" height="32px"></b-skeleton>
        <b-skeleton width="100%" height="32px"></b-skeleton>
        <b-skeleton width="100%" height="32px"></b-skeleton>
      </div>
      <div class="list-view" v-else>
        <div class="none-item text-center mt-2" v-if="typeList.length == 0">
          <p class="h4 font-weight-bold">Lista vazia</p>
          <p>
            Crique no botão azul no canto superior direito para adicionar um
            item a sua lista.
          </p>
        </div>
        <div
          v-for="item in typeList"
          :key="item.id"
          class="my-2 list-item"
          v-else
        >
          <b-row class="border border-list">
            <b-col
              class="d-flex align-items-center text-truncate p-1 pl-2"
              cols="10"
              >{{ item.title }}</b-col
            >
            <b-col cols="2" class="text-right p-1">
              <div>
                <b-button
                  @click="selectForEdit(item)"
                  squared
                  size="sm"
                  variant="primary"
                  class="btn-action-list"
                >
                  <i class="fas fa-edit"></i>
                </b-button>
                <b-button
                  @click="selectForDelete(item)"
                  squared
                  size="sm"
                  variant="danger"
                  class="btn-action-list"
                >
                  <i class="fas fa-trash"></i>
                </b-button>
              </div>
            </b-col>
          </b-row>
        </div>
      </div>
    </b-card>

    <b-modal ref="deleteModal" title="Confirmação" hide-footer centered>
      <p class="mb-4">
        Deseja mesmo excluir a atividade "{{ itemDelet.title }}"?
      </p>

      <div class="mt-3 d-flex align-items-center text-right">
        <b-button @click="$refs['deleteModal'].hide()" variant="ligth"
          >Cancelar</b-button
        >
        <b-button @click="deleteType()" class="ml-2" variant="danger"
          >Confirmar</b-button
        >
      </div>
    </b-modal>

    <b-modal ref="typeEditModal" title="Edição" hide-footer size="xl">
      <FormType
        :idType="itemEdit.id"
        :titleType="itemEdit.title"
        @closeModal="closeTypeModal()"
      />
    </b-modal>
  </div>
</template>

<script>
import FormType from "@/components/FormType.vue";

export default {
  name: "Types",
  components: {
    FormType,
  },
  data() {
    return {
      itemDelet: {},
      itemEdit: {},
    };
  },
  methods: {
    selectForDelete(data) {
      this.itemDelet = data;
      this.$refs["deleteModal"].show();
    },
    deleteType() {
      this.$store.dispatch("deleteType", this.itemDelet.id);
      this.$refs["deleteModal"].hide();
    },
    selectForEdit(data) {
      this.itemEdit = data;
      this.$refs["typeEditModal"].show();
    },
    closeTypeModal() {
      this.$refs["typeEditModal"].hide();
    },
  },
  computed: {
    typeList() {
      return this.$store.state.typesTask;
    },
    loadPage() {
      return this.$store.state.load.type;
    },
  },
};
</script>

<style lang="scss">
</style>
