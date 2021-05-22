<template>
  <div id="app">
    <div id="nav">
      <router-link to="/" class="mx-2">Home</router-link>
      <router-link v-if="isAuthenticated" to="/dashboard" class="mx-2">Dashboard</router-link>
      <router-link to="/about" class="mx-2">About</router-link>
      <router-link v-if="!isAuthenticated" to="/register" class="mx-2">Register</router-link>
      <router-link v-if="!isAuthenticated" to="/login" class="mx-2">Login</router-link>
      <a v-if="isAuthenticated" href="#" @click.prevent="doLogout" class="mx-2">Logout</a>
    </div>
    <router-view />
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "App",
  computed: {
    ...mapGetters(["isAuthenticated"]),
  },
  methods: {
    async doLogout() {
      await this.$store.dispatch("logout");
      this.$router.push("/login");
    },
  },
};
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
