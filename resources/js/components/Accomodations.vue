<template>
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
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
  },
};
</script>


<style lang="scss" scoped>
.page-item.active .page-link {
  color: #fff;
  background-color: #ff385d;
  border-color: #ff385d;
}

.page-link {
  color: #282828;
}

.page-link:focus {
    box-shadow: 0 0 0 0.2rem rgba(220, 52, 108, 0.25);
}
</style>
