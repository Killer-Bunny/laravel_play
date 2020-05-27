<template>
  <div class="w-50 m-auto">
    <div class="card card-body">
      <form>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input
            type="text"
            name="email"
            placeholder="Enter your e-mail"
            class="form-control"
            v-model="email"
            :class="[{'is-invalid': errorFor('email')}]"
          >
          <v-errors :errors="errorFor('email')"></v-errors>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            placeholder="Enter your password"
            class="form-control"
            v-model="password"
            :class="[{'is-invalid': errorFor('password')}]"
          >
          <v-errors :errors="errorFor('password')"></v-errors>
        </div>

        <button
          type="submit"
          class="btn btn-lg btn-primary btn-block"
          :disabled="loading"
          @click.prevent="login"
        >Login</button>

        <hr />

        <div>
          No account yet?
          <router-link :to="{name: 'register'}">Register</router-link>
        </div>

        <div>
          Forgot password?
          <router-link :to="{name: 'home'}">Reset password</router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import validationErrors from './../shared/mixins/validationErrors'
  import { logIn } from './../shared/utils/auth'

  export default {
    mixins: [validationErrors],
    data() {
      return {
        email: null,
        password: null,
        loading: false
      }
    },
    methods: {
      async login() {
        this.loading = true
        this.errors = null

        try {
          await axios.get('/sanctum/csrf-cookie');
          await axios.post(`/login`, {
            email: this.email,
            password: this.password
          })

          logIn()
          this.$store.dispatch('loadUser')
          this.$router.push({name: 'home'})
        } catch(error) {
          this.errors = error.response && error.response.data.errors
        }
        this.loading = false
      }
    }
  }
</script>
