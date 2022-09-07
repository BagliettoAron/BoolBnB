<template>
  <div class="container">
    <form class="mb-5">
      <h4 class="text-right mt-4">Search an accomodation</h4>
      <!-- Address filter -->
      <div class="form-group">
        <label for="address">Search for your desired location</label>
        <input
          type="text"
          class="form-control"
          name="address"
          placeholder="Type ad address..."
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
      <div class="form-group">
        <label for="radius">Maximum distance from searched point (km)</label>
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
      <div class="form-group">
        <label for="rooms">Minimum number of rooms</label>
        <input
          type="number"
          name="rooms"
          class="form-control"
          id="rooms"
          min="1"
          placeholder="Ex. 3"
          v-model="nbrOfRooms"
          @change="getResults()"
        />
      </div>
      <!-- /Min. rooms -->

      <!-- Min. beds -->
      <div class="form-group">
        <label for="beds">Minimum number of beds</label>
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
      <p class="mb-1">Check the services you need</p>
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
      </div>
      <!-- /Services -->

      <!-- Search button -->
      <button type="button" class="btn btn-primary mt-3" @click="getResults()">
        Search
      </button>
      <!-- /Search button -->
    </form>
    <!-- Single accomodation -->
    <div class="row row-cols-3">
      <div
        v-for="item in filterBy"
        :key="item.index"
        class="col"
      >
        <AccomodationCard :accomodation="item" />
      </div>
    </div>
    <!-- /Single accomodation -->
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
      availableServices: [],
      selectedServices: [],
      accomodationsInRadius: [],
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
          //   Axios.get(
          //     `https://api.tomtom.com/search/2/search/via roma.json?key=xrJRsnZQoM2oSWGgQpYwSuOSjIRcJOH7`
          //   ).then((addressData) => {
          //     console.log(addressData);
          //   });
        });
      });
    },

    getResults() {
      const axiosLink = `http://127.0.0.1:8000/api/accomodations/search?lat=${this.lat}&lon=${this.lon}&searchRadius=${this.searchRadius}&nbrOfRooms=${this.nbrOfRooms}&nbrOfBeds=${this.nbrOfBeds}`;

      Axios.get(axiosLink).then((resp) => {
        // console.log(resp.data.accomodationsInRadius);
        this.accomodationsInRadius = resp.data.accomodationsInRadius;
        console.log(this.accomodationsInRadius);
      });
    },
  },

  computed: {
    filterBy() {
      if (this.nbrOfRooms || this.nbrOfBeds) {
        return this.accomodationsInRadius.filter((item) => {
          return (
              // console.log(item.number_of_beds)
              item.number_of_beds > this.nbrOfBeds &&
              item.number_of_rooms > this.nbrOfRooms
          );
        });
      } else {
        return this.accomodationsInRadius;
      }
    },
  },

  created() {
    Axios.get("/api/services").then((resp) => {
      this.availableServices = resp.data;
    });
  },
};
</script>

<style></style>
