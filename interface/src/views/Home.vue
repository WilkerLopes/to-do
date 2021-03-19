<template>
  <div class="container py-4">
    <b-card class="rounded shadow-sm border-0 mb-5">
      <div class="list-load" v-if="loadPage">
        <div class="d-flex align-items-center justify-content-start mb-4">
          <b-skeleton width="100px" height="32px"></b-skeleton>
          <b-skeleton width="50%" height="32px" class="mx-4"></b-skeleton>
          <b-skeleton width="100px" height="32px"></b-skeleton>
        </div>
        <b-skeleton width="100%" height="32px"></b-skeleton>
        <b-skeleton width="100%" height="32px"></b-skeleton>
        <b-skeleton width="100%" height="32px"></b-skeleton>
      </div>
      <div class="view" v-else>
        <div class="d-flex align-items-center justify-content-start">
          <div class="font-weight-bold">Filtro</div>
          <b-form-select
            v-model="filterValue"
            :options="typesList"
            value-field="id"
            text-field="title"
            size="sm"
            class="mx-3"
          >
            <template #first>
              <b-form-select-option :value="null" disabled
                >Escolha um tipo de tarefa</b-form-select-option
              >
            </template>
          </b-form-select>
          <b-button
            small
            variant="ligth"
            class="border"
            style="height: 30px; padding: 0 12px"
            @click="filterValue = null"
            >Limpar</b-button
          >
        </div>

        <div class="none-item text-center mt-4" v-if="taskList.length == 0">
          <p class="h4 font-weight-bold">Lista vazia</p>
          <p>
            Crique no botão azul no canto superior direito para adicionar um
            item a sua lista.
          </p>
        </div>
        <div class="list-view mt-4" v-else>
          <div
            v-for="item in renderList"
            :key="item.id"
            class="mt-2 d-flex align-items-center justify-content-between list-item"
          >
            <b-button
              variant="none"
              class="rounded-circle check-button"
              :class="{
                'border border-list btn-ligth': !item.status_check,
                'btn-success': item.status_check,
              }"
              @click="
                changeStaus(item.id, item.status_check);
                item.status_check = !item.status_check;
              "
            >
              <i class="fas fa-check text-white"></i>
            </b-button>

            <b-row class="border border-list">
              <b-col class="d-flex align-items-center bg-list p-1">
                {{ dateformate(item.date_limite) }}
              </b-col>
              <b-col
                class="d-flex align-items-center text-truncate border-right border-list p-1"
              >
                {{ titleType(item.id_type) }}
              </b-col>
              <b-col
                class="d-flex align-items-center text-truncate p-1"
                cols="6"
              >
                {{ item.title }}
              </b-col>
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
      </div>
    </b-card>

    <b-modal ref="deleteModal" title="Confirmação" hide-footer centered>
      <p class="mb-4">
        Deseja mesmo excluir a atividade "{{ itemDelet.title }}"? Ela
        {{ itemDelet.status_check ? "já" : "não" }} foi concluida!
      </p>

      <div class="mt-3 d-flex align-items-center text-right">
        <b-button @click="$refs['deleteModal'].hide()" variant="ligth"
          >Cancelar</b-button
        >
        <b-button @click="deleteTask()" class="ml-2" variant="danger"
          >Confirmar</b-button
        >
      </div>
    </b-modal>

    <b-modal ref="taskEditModal" title="Edição" hide-footer size="xl">
      <FormTask
        :idTask="itemEdite.id"
        :dateTask="itemEdite.date_limite"
        :typeId="itemEdite.id_type"
        :titleTask="itemEdite.title"
        @closeModal="closeTaskModal()"
      />
    </b-modal>
  </div>
</template>

<script>
import FormTask from "@/components/FormTask.vue";

export default {
  name: "Home",
  components: {
    FormTask,
  },
  data() {
    return {
      filterValue: null,
      itemDelet: {},
      itemEdite: {},
    };
  },
  methods: {
    titleType(id) {
      var entry = this.typesList.map((el) => el.id);

      return this.typesList[entry.indexOf(id)].title;
    },
    dateformate(date) {
      var d = date.split("-");

      return [d[2], d[1], d[0]].join("/");
    },
    selectForDelete(data) {
      this.itemDelet = data;
      this.$refs["deleteModal"].show();
    },
    deleteTask() {
      this.$store.dispatch("deleteTask", this.itemDelet.id);
      this.$refs["deleteModal"].hide();
    },
    selectForEdit(data) {
      this.itemEdite = data;
      this.$refs["taskEditModal"].show();
    },
    changeStaus(id, status) {
      this.$store.dispatch("statusTask", {
        id: id,
        status_check: !status,
      });
    },
    closeTaskModal() {
      this.$refs["taskEditModal"].hide();
    },
  },
  computed: {
    taskList() {
      return this.$store.state.tasks;
    },
    typesList() {
      return this.$store.state.typesTask;
    },
    loadPage() {
      return this.$store.state.load.task;
    },
    renderList() {
      var list = this.taskList;
      const search = this.filterValue;

      if (!search) return list;

      return list.filter((item) => item.id_type === search);
    },
  },
};
</script>

<style lang="scss">
</style>
