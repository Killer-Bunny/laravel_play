<template>
  <div class="">
    <h6 class="text-uppercase text-secondary font-weight-bolder">
      Check Availability
      <span v-if="noAvailability" class="text-danger">(NOT AVAILABLE)</span>
      <span v-if="hasAvailability" class="text-success">(Available)</span>
    </h6>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="from">From</label>
        <input
          type="text"
          name="from"
          class="form-control form-control-sm"
          placeholder="Start date"
          v-model="from"
          @keyup.enter="check"
          :class="[{'is-invalid': this.errorFor('from')}]"
        />
        <v-errors :errors="errorFor('from')"></v-errors>
      </div>
      <div class="form-group col-md-6">
        <label for="to">To</label>
        <input
          type="text"
          name="to"
          class="form-control form-control-sm"
          placeholder="End date"
          v-model="to"
          @keyup.enter="check"
          :class="[{'is-invalid': this.errorFor('to')}]"
        />
        <v-errors :errors="errorFor('to')"></v-errors>
      </div>
    </div>
    <button class="btn btn-secondary btn-block" @click="check" :disabled="loading">Check</button>
  </div>
</template>

<style scoped>
  label {
    font-size: 0.7em;
    text-transform: uppercase;
    color: grey;
    font-weight: bolder;
  }

  .is-invalid {
    border-color: #b22222;
    background-image: none;
  }

  .invalid-feedback {
    color: #b22222;
  }
</style>

<script>
  import {is422} from './../shared/utils/response';
  import validationErrors from './../shared/mixins/validationErrors';

  export default {
    mixins: [validationErrors],
    props: {
      bookableId: [String, Number]
    },
    data() {
      return {
        from: this.$store.state.lastSearch.from,
        to: this.$store.state.lastSearch.to,
        loading: false,
        status: null
      }
    },
    methods: {
      check() {
        this.loading = true;
        this.errors = null;

        this.$store.dispatch('setLastSearch', {
          from: this.from,
          to: this.to
        })

        axios.get(
          `/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`
        ).then(response => {
          console.log(this);
          this.status = response.status;
        }).catch(error => {
          if(is422(error)) {
            console.log(this);
            this.errors = error.response.data.errors;
          }
          this.status = error.response.status;
        })
        .then(() => (this.loading = false));
      },
    },
    computed: {
      hasErrors() {
        return 422 == this.status && this.errors != null;
      },
      hasAvailability() {
        return 200 == this.status;
      },
      noAvailability() {
        return 403 == this.status;
      }
    },
    create() {
      console.log(this.$store.state)
    }
  }
</script>
