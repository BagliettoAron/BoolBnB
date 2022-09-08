<template>
  <div class="container">
    <div v-if="accomodation">
      <h2>{{ accomodation.title }}</h2>
      <img
        v-if="accomodation.picture"
        :src="accomodation.picture"
        alt="accomodation-picture"
      />
    </div>
    <div v-else>Loading...</div>
  </div>
</template>

<script>
import Axios from "axios";

export default {
  name: "Accomodation",
  data() {
    return {
      accomodation: null,
    };
  },
  created() {
    // console.log(this.$route.params.id);
    Axios.get(`/api/accomodation/${this.$route.params.id}`).then((resp) => {
      // console.log(resp.data.results);
      this.accomodation = resp.data.results;
      console.log(this.accomodation.services);
    });
  },
};
</script>

<style>

</style>