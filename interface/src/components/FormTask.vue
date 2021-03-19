<template>
  <div>
    <b-card class="rounded shadow-sm border-0">
      <b-navbar v-if="create">
        <div class="container pt-0">
          <p class="h3 font-weight-bold text-center w-100">Criar atividade</p>
        </div>
      </b-navbar>

      <b-form @submit="onSubmit" @reset="onReset">
        <div class="mt-4">
          <b-row>
            <b-col cols="12">
              <label for="title-list">Descrição</label>
              <b-form-input
                id="title-list"
                :state="validation.title"
                v-model="form.title"
              ></b-form-input>
              <b-form-invalid-feedback :state="validation.title">
                Este campo não pode ser vazio.
              </b-form-invalid-feedback>
            </b-col>
          </b-row>
          <b-row class="mt-3">
            <b-col cols="6">
              <label for="type-list">Tipo de tarefa</label>
              <b-form-select
                :options="typesList"
                value-field="id"
                text-field="title"
                v-model="form.id_type"
                id="type-list"
                :state="validation.idType"
              ></b-form-select>
              <b-form-invalid-feedback :state="validation.idType">
                Este campo não pode ser vazio.
              </b-form-invalid-feedback>
            </b-col>
            <b-col cols="6">
              <label for="date-list">Data limite</label>
              <b-form-datepicker
                id="date-list"
                v-model="form.date_limite"
                :state="validation.data"
              ></b-form-datepicker>
              <b-form-invalid-feedback :state="validation.data">
                Este campo não pode ser vazio.
              </b-form-invalid-feedback>
            </b-col>
          </b-row>
        </div>
        <div class="d-flex align-items-center mt-4">
          <b-button
            :disabled="loadSave"
            class="mr-2 text-danger"
            variant="ligth"
            type="reset"
          >
            Cancelar
          </b-button>
          <b-button type="submit" class="mr-2 px-4" variant="success">
            <b-spinner
              v-if="loadSave"
              variant="ligth"
              label="Salvando"
              small
            ></b-spinner>
            <div v-else>Salvar</div>
          </b-button>
        </div>
      </b-form>
    </b-card>
  </div>
</template>

<script>
export default {
  name: "FormTask",
  props: {
    idTask: Number,
    dateTask: String,
    typeId: Number,
    titleTask: String,
    create: Boolean,
  },
  data() {
    return {
      validation: {
        title: null,
        date_limite: null,
        id_type: null,
      },
      form: {
        id: this.idTask != undefined ? this.idTask : false,
        title: this.titleTask != undefined ? this.titleTask : null,
        date_limite: this.dateTask != undefined ? this.dateTask : null,
        id_type: this.typeId != undefined ? this.typeId : null,
      },
      loadSave: false,
    };
  },
  methods: {
    async onSubmit(event) {
      event.preventDefault();
      this.loadSave = true;
      var data = this.form;

      var invalidForm = false;

      for (var item in data) {
        if (data[item] == null) {
          this.validation[item] = false;
          this.loadSave = false;
          invalidForm = true;
          console.log(item);
        }
      }

      if (invalidForm === true) return;

      var dispatch = this.create ? "createTask" : "editeTask";
      await this.$store.dispatch(dispatch, data).then(() => {
        this.$emit("closeModal");
      });
    },
    onReset(event) {
      event.preventDefault();
      this.form = {
        id: null,
        title: null,
        date_limite: null,
        id_type: null,
      };
      this.validation = {
        title: null,
        data: null,
        idType: null,
      };
      this.$emit("closeModal");
    },
  },
  computed: {
    typesList() {
      return this.$store.state.typesTask;
    },
  },
};
</script>

<style scoped lang="scss"></style>
