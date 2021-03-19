<template>
  <div>
    <b-card class="rounded shadow-sm border-0">
      <b-navbar v-if="create">
        <div class="container pt-0">
          <p class="h3 font-weight-bold text-center w-100">
            Criar tipo de tarefa
          </p>
        </div>
      </b-navbar>

      <b-form @submit="onSubmit" @reset="onReset">
        <div class="mt-4">
          <b-row>
            <b-col cols="12">
              <label for="title-type">Nome do tipo da tarefa</label>
              <b-form-input
                id="title-type"
                :state="validation"
                v-model="title"
              ></b-form-input>
              <b-form-invalid-feedback :state="validation">
                Este campo não pode ser vazio.
              </b-form-invalid-feedback>
            </b-col>
          </b-row>
        </div>
        <div class="d-flex align-items-center mt-4">
          <b-button type="submit" class="mr-2 px-4" variant="success">
            <b-spinner
              v-if="loadSave"
              variant="ligth"
              label="Salvando"
              small
            ></b-spinner>
            <div v-else>Salvar</div>
          </b-button>
          <b-button
            :disabled="loadSave"
            class="mr-2 text-danger"
            variant="ligth"
            type="reset"
            >Cancelar</b-button
          >
        </div>
      </b-form>
    </b-card>
  </div>
</template>

<script>
export default {
  name: "FormType",
  props: {
    idType: Number,
    titleType: String,
    create: Boolean,
  },

  data() {
    return {
      validation: null,
      loadSave: false,
      title: this.titleType != undefined ? this.titleType : null,
      id: this.idType != undefined ? this.idType : null,
    };
  },

  methods: {
    async onSubmit(event) {
      event.preventDefault();
      this.loadSave = true;

      if (this.title == null || this.title == "") {
        this.validation = false;
        this.loadSave = false;
        return;
      }

      var data;

      if (this.create == false) {
        data = {
          title: this.title,
          id: this.id,
        };
      } else {
        data = this.title;
      }

      var dispatch = this.create ? "createType" : "editType";
      await this.$store.dispatch(dispatch, data).then(() => {
        this.$emit("closeModal");
      });
    },
    onReset(event) {
      event.preventDefault();
      this.title = "";
      this.validation = null;
      this.$emit("closeModal");
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss"></style>
