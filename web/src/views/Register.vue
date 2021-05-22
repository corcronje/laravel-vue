<template>
  <div id="register">
    <h1>Register</h1>
    <b-form @submit.prevent="onSubmit">
      <b-form-group label="Name">
        <b-form-input
          v-model="credentials.name"
          placeholder="Name"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group label="Email">
        <b-form-input
          v-model="credentials.email"
          type="email"
          placeholder="Enter email"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group label="Password">
        <b-form-input
          type="password"
          v-model="credentials.name"
          required
        ></b-form-input>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>
  </div>
</template>

<script>
export default {
  name: 'Register',
  data() {
    return {
      credentials: {
        name: 'Demo User',
        email: 'demo@company.local',
        password: 'password',
      }
    }
  },
  methods: {
    async onSubmit() {
      await this.$store.dispatch('register', this.credentials);
      this.$router.push('/dashboard');
    }
  }
}
</script>
