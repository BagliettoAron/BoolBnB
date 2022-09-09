<template>
  <div class="container">
    <h4 class="text-center mt-4">Search an accomodation</h4>
    <form class="mb-5 row">
      <!-- Address filter -->
      <div class="form-group col-md-8 col-9">
        <label for="address">Search for your desired location</label>
        <input
          type="text"
          class="form-control"
          name="address"
          placeholder="Type a city or an address..."
          id="address"
          @keyup="searchAddress()"
        />
        <ul
          id="suggestions-container"
          class="list-group mt-2 position-absolute"
        ></ul>
      </div>
      <!-- /Address filter -->

      <!-- Search radius -->
      <div class="form-group col-md-4 col-3">
        <label class="d-none d-md-block" for="radius">Radius (km)</label>
        <label class="d-block d-md-none" for="radius">Km</label>
        <input
          type="number"
          name="radius"
          class="form-control"
          id="radius"
          min="1"
          v-model="searchRadius"
          />
        </div>
        <!-- /Search radius -->
        
        <!-- Min. rooms -->
        <div class="form-group col-6">
          <label class="d-none d-md-block" for="rooms">Minimum number of rooms</label>
          <label class="d-block d-md-none" for="rooms">Min Rooms</label>
          <input
            type="number"
            name="rooms"
            class="form-control"
            id="rooms"
            min="1"
            placeholder="Ex. 3"
            v-model="nbrOfRooms"
          />
        </div>
        <!-- /Min. rooms -->
    
        <!-- Min. beds -->
        <div class="form-group col-6">
          <label class="d-none d-md-block" for="beds">Minimum number of beds</label>
          <label class="d-block d-md-none" for="beds">Min Beds</label>
          <input
            type="number"
            name="beds"
            class="form-control"
            min="1"
            id="beds"
            placeholder="Ex. 5"
            v-model="nbrOfBeds"
          />
        </div>
        <!-- /Min. beds -->
    
        <!-- Services -->
        <!-- <p class="mb-1">Check the services you need</p>
        <div
          class="form-check"
          v-for="(service, index) in availableServices"
          :key="index"
        >
          <input
            class="form-check-input"
            name="services"
            type="checkbox"
            :value="service.id"
            v-model="selectedServices"
          />
          <label class="form-check-label" for="services">
            {{ service.name }}
          </label>
        </div> -->
        <!-- /Services -->
      
      <!-- Search button -->
      <button type="button" class="btn btn-primary mt-3" @click="getResults()">
        Search
      </button>
      <!-- /Search button -->
    </form>

    <!-- Accomodations container -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
      <!-- Single accomodation -->
      <div
        v-for="accomodation in accomodationsInRadius"
        :key="accomodation.index"
        class="col"
      >
        <AccomodationCard :accomodation="accomodation" />
      </div>
      <!-- /Single accomodation -->
    </div>
    <!-- /Accomodations container -->
  </div>
</template>

<script>
import Axios from "axios";
import AccomodationCard from "../components/AccomodationCard.vue";

export default {
  name: "searchaccomodations",
  components: {
    AccomodationCard,
  },
  data() {
    return {
      lat: 0,
      lon: 0,
      searchRadius: 20,
      nbrOfRooms: "",
      nbrOfBeds: "",
      accomodationsInRadius: [],
      // availableServices: [],
      // selectedServices: [],
    };
  },
  methods: {
    searchAddress() {
      window.axios.defaults.headers.common = {
        Accept: "application/json",
        "Content-Type": "application/json",
      };
      const addressQuery = document.getElementById("address").value;
      const linkApi = `https://api.tomtom.com/search/2/search/${addressQuery}.json?key=xrJRsnZQoM2oSWGgQpYwSuOSjIRcJOH7`;

      Axios.get(linkApi).then((resp) => {
        this.collectAddress(resp);
      });
    },

    collectAddress(addressData) {
      const resultsContainer = document.getElementById("suggestions-container");
      resultsContainer.innerHTML = "";
      const response = addressData.data.results;
      response.forEach((element) => {
        const listItem = document.createElement("li");
        listItem.classList.add("address-result", "border", "list-group-item");
        listItem.style.cursor = "pointer";
        listItem.innerHTML = element.address.freeformAddress;
        document.getElementById("suggestions-container").append(listItem);
        listItem.addEventListener("mouseover", () => {
          listItem.classList.add("active");
        });
        listItem.addEventListener("mouseleave", () => {
          listItem.classList.remove("active");
        });
        listItem.addEventListener("click", () => {
          document.getElementById("address").value =
            element.address.freeformAddress;
          resultsContainer.innerHTML = "";
          this.lat = element.position.lat;
          this.lon = element.position.lon;
        });
      });
    },

    getResults() {

      Axios.get("/api/accomodations/search", {
        params: {
          lat: this.lat,
          lon: this.lon,
          searchRadius: this.searchRadius,
          nbrOfRooms: this.nbrOfRooms,
          nbrOfBeds: this.nbrOfBeds,
          // selectedServices: this.selectedServices
        }
      }).then((resp) => {
        console.log(this.selectedServices);
        console.log(resp.data.accomodationsInRadius);
        this.accomodationsInRadius = resp.data.accomodationsInRadius;
      });
    },
  },

  created() {
    Axios.get("/api/services").then((resp) => {
      this.availableServices = resp.data;
    });
  },
};
</script>

<style scoped>
  .container {
    background-color: #FAF6F6;
  }

  #suggestions-container {
    z-index: 1;
  }

  .btn-primary {
    margin-left: 12px;
    background-color: #ff395d;
    border-color: #ff395d;
  }
</style>
