<template>
  <div id="app">
    <b-navbar class="shadow-sm" variant="light">
      <div class="container">
        <b-navbar-brand class="font-weight-bold">
          {{ $route.name }}
        </b-navbar-brand>

        <b-navbar-nav class="ml-auto">
          <b-button v-if="$route.path == '/'" to="/tipos" variant="light">
            Tipos de tarefas
          </b-button>
          <b-button v-else to="/" variant="light"> Tarefas </b-button>

          <b-button class="ml-3" variant="primary" @click="createItem()">
            <i class="fas fa-plus"></i>
          </b-button>
        </b-navbar-nav>
      </div>
    </b-navbar>

    <router-view />

    <b-modal ref="createTaskModal" hide-footer hide-header size="xl">
      <FormTask :create="true" @closeModal="closeTaskModal()" />
    </b-modal>

    <b-modal ref="createTypeModal" hide-footer size="xl" hide-header>
      <FormType :create="true" @closeModal="closeTypeModal()" />
    </b-modal>
  </div>
</template>

<script>
import FormTask from "@/components/FormTask.vue";
import FormType from "@/components/FormType.vue";

export default {
  components: {
    FormTask,
    FormType,
  },
  methods: {
    createItem() {
      if (this.$route.path == "/") {
        this.$refs["createTaskModal"].show();
      } else {
        this.$refs["createTypeModal"].show();
      }
    },
    closeTaskModal() {
      this.$refs["createTaskModal"].hide();
    },
    closeTypeModal() {
      this.$refs["createTypeModal"].hide();
    },
  },
  created() {
    this.$store.dispatch("getTask");
    this.$store.dispatch("getType");
  },
};
</script>

<style lang="scss"></style>

