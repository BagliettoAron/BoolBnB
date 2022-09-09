<template>
  <div class="container">
    <div v-if="accomodation">
      <h2 class="accomodationTitle">{{ accomodation.title }}</h2>
      <img
        v-if="accomodation.picture"
        :src="accomodation.picture"
        alt="accomodation-picture"
      />
      <h4 class="mt-4">{{ accomodation.address }}</h4>
      <div class="mt-4 text-center"> 
       <span class="mr-3">&#10004; <i class="fas fa-door-open icon"></i> {{ accomodation.number_of_rooms }} Rooms </span>  
       <span class="mr-3">&#10004; <i class="fas fa-bed icon"></i> {{ accomodation.number_of_beds}} Beds </span> 
       <span class="mr-3">&#10004; <i class="fas fa-toilet icon"></i> {{ accomodation.number_of_bathrooms}} Bathrooms </span> 
       <div v-if="accomodation.square_meters">
        <span class="mr-3">&#10004; <i class="fas fa-vector-square icon"></i> {{ accomodation.square_meters}} Square meters </span> 
       </div>
      </div>
      <h5 class="mt-3 text-center">Available services</h5>
      <ul class="text-center">
        <li v-for="service in this.accomodation.services" :key="service.id">{{ service.name }}</li>
      </ul>
      <h5 class="pt-3 pb-5 price"><i class="fas fa-euro-sign"></i> {{ accomodation.price_per_night}} Price per night</h5>
    
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

<style lang="scss" scoped>
  .container {
    text-align: center;
    // height: 72vh;
    .price{
      color: #ff395d;
      font-size: 1.3rem;
    }
    .icon{
      color: #ff395d;
    }
   

  }

ul {
  list-style: none;
  padding: 0;
}
</style>