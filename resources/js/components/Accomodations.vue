<template>
  <div class="container">
    <h3>Accomodation's list</h3>

    <form class="mb-5">
      <h4 class="text-right mt-4">Search an accomodation</h4>
      <div class="form-group" required>
        <input
          type="text"
          class="form-control"
          name="address"
          placeholder="add address"
          id="address"
          @keyup="searchAddress()"
          required
        />
        <div id="suggestions-container" class="mt-2"></div>
        <!-- <input
          type="text"
          class="form-control d-none"
          name="lat"
          id="lat"
          required
        />
        <input
          type="text"
          class="form-control d-none"
          name="lon"
          id="lon"
          required
        /> -->
      </div>

      <!-- <div class="form-group">
                <label for="number_of_rooms">Number of rooms</label>
                <input type="number" class="form-control" name="number_of_rooms" placeholder="number of rooms" required min="1" max="255"
                id="number_of_rooms">
            </div>

            <div class="form-group">
                <label for="number_of_beds">Number of beds</label>
                <input type="number" class="form-control" name="number_of_beds"  placeholder="number of beds" required min="1" max="255"
                id="number_of_beds">
            </div> -->
    </form>
    <div class="row row-cols-3">
      <!-- accomodations singolo -->
      <div
        v-for="accomodation in accomodations"
        :key="accomodation.id"
        class="col"
      >
        <AccomodationCard :accomodation="accomodation" />
      </div>
      <!-- accomodation singolo -->
    </div>
    <nav aria-label="...">
      <ul class="pagination">
        <!-- scorrimento pagine -->
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <a
            @click="getAccomodations(currentPage - 1)"
            class="page-link"
            href="#"
            tabindex="-1"
            >Previous</a
          >
        </li>
        <!-- numero di pagine -->
        <li
          v-for="n in lastPage"
          :key="n"
          class="page-item"
          :class="{ active: currentPage === n }"
        >
          <a @click="getAccomodations(n)" class="page-link" href="#">
            {{ n }}
          </a>
        </li>
        <!-- bottone successivo -->
        <li class="page-item" :class="{ disabled: currentPage === lastPage }">
          <a
            @click="getAccomodations(currentPage + 1)"
            class="page-link"
            href="#"
            >Next
          </a>
        </li>
      </ul>
    </nav>
    <!-- <p>Totale post trovati: {{ totalAccomodations }}</p> -->
  </div>
</template>

<script>
import Axios from "axios";
import AccomodationCard from "./AccomodationCard.vue";
export default {
  name: "Accomodations",
  components: {
    AccomodationCard,
  },
  data() {
    return {
      accomodations: [],
      currentPage: 1,
      lastPage: 0,
      totalAccomodotations: 0,
      accomodationsPerPage: 9,
      lat: 0,
      lon: 0,
    };
  },
  created() {
    this.getAccomodations(1);
  },
  methods: {
    getAccomodations(pageNumber) {
      Axios.get("/api/accomodations", {
        params: {
          accomodations_per_page: this.accomodationsPerPage,
          page: pageNumber,
        },
      }).then((resp) => {
        this.accomodations = resp.data.results.data;
        this.currentPage = resp.data.results.current_page;
        this.lastPage = resp.data.results.last_page;
        this.totalAccomodations = resp.data.results.total;
      });
    },

    // setCoordinates(lat, lon) {
    //     this.lat = lat;
    //     this.lon = lon;
    // },

    searchAddress() {
      window.axios.defaults.headers.common = {
        Accept: "application/json",
        "Content-Type": "application/json",
      };
      const resultsContainer = document.getElementById("suggestions-container");
      resultsContainer.innerHTML = "";
      const addressQuery = document.getElementById("address").value;
      const linkApi = `https://api.tomtom.com/search/2/search/${addressQuery}.json?key=xrJRsnZQoM2oSWGgQpYwSuOSjIRcJOH7`;
      const prova = this.setCoordinates(axiosLat, axiosLon);

      axios.get(linkApi).then((resp) => {
        const response = resp.data.results;
        response.forEach((element) => {
          const divElement = document.createElement("div");
          divElement.classList.add("address-result", "border");
          divElement.style.cursor = "pointer";
          divElement.innerHTML = element.address.freeformAddress;
          document.getElementById("suggestions-container").append(divElement);

          divElement.addEventListener("click", function () {
            document.getElementById("address").value =
              element.address.freeformAddress;
            // document.getElementById("lat").value = element.position.lat;
            // document.getElementById("lon").value = element.position.lon;

            // this.axiosLat = element.position.lat;
            // this.axiosLon = element.position.lon;
            resultsContainer.innerHTML = "";
            console.log(element.address.freeformAddress);
          });
        });
      });
    },

    checkIfInRadius() {
      const spotCoordinates1 = [41.5408446218337, -8.612296123028727];
      const spotCoordinates2 = [38.817459, -9.282218];

      const center = { lat: 41.536558, lng: -8.627487 };
      const radius = 20;

      checkIfInside(spotCoordinates1);
      checkIfInside(spotCoordinates2);

      function checkIfInside(spotCoordinates) {
        let newRadius = distanceInKmBetweenEarthCoordinates(
          spotCoordinates[0],
          spotCoordinates[1],
          center.lat,
          center.lng
        );
        console.log(newRadius);

        if (newRadius < radius) {
          //point is inside the circle
          console.log("inside");
        } else if (newRadius > radius) {
          //point is outside the circle
          console.log("outside");
        } else {
          //point is on the circle
          console.log("on the circle");
        }
      }

      function distanceInKmBetweenEarthCoordinates(lat1, lon1, lat2, lon2) {
        var earthRadiusKm = 6371;

        var dLat = degreesToRadians(lat2 - lat1);
        var dLon = degreesToRadians(lon2 - lon1);

        lat1 = degreesToRadians(lat1);
        lat2 = degreesToRadians(lat2);

        var a =
          Math.sin(dLat / 2) * Math.sin(dLat / 2) +
          Math.sin(dLon / 2) *
            Math.sin(dLon / 2) *
            Math.cos(lat1) *
            Math.cos(lat2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return earthRadiusKm * c;
      }

      function degreesToRadians(degrees) {
        return (degrees * Math.PI) / 180;
      }
    },
  },
};
</script>


<style></style>
