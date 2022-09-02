<template>
    <div class="container">
        <h3>Accomodation's list</h3>

        <form>

            <div class="form-group" required>
                <input type="text" class="form-control" name="address" placeholder="Search" id="address" @keyup="searchAddress()" required>
                <div id="suggestions-container" class="mt-2" ></div>
                <input type="text" class="form-control d-none" name="lat" id="lat"  required>
                
                <input type="text" class="form-control d-none" name="lon" id="lon"  required>
                
            </div>

            <div class="form-group">
                <label for="number_of_rooms">Number of rooms *</label>
                <input type="number" class="form-control" name="number_of_rooms" required min="1" max="255"
                    id="number_of_rooms">
            </div>

            <div class="form-group">
                <label for="number_of_beds">Number of beds *</label>
                <input type="number" class="form-control" name="number_of_beds" required min="1" max="255"
                    id="number_of_beds">
            </div>
            
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
                <li
                    class="page-item"
                    :class="{ disabled: currentPage === lastPage }"
                >
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
            Axios
                .get("/api/accomodations", {
                    params: {
                        accomodations_per_page: this.accomodationsPerPage, 
                        page: pageNumber,
                    },
                })
                .then((resp) => {
                    this.accomodations = resp.data.results.data;
                    this.currentPage = resp.data.results.current_page;
                    this.lastPage = resp.data.results.last_page;
                    this.totalAccomodations = resp.data.results.total;
                });
        },

        searchAddress() {
            window.axios.defaults.headers.common = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            };
            const resultsContainer = document.getElementById('suggestions-container');
            resultsContainer.innerHTML = '';
            const addressQuery = document.getElementById('address').value;
            const linkApi =
            `https://api.tomtom.com/search/2/search/${addressQuery}.json?key=xrJRsnZQoM2oSWGgQpYwSuOSjIRcJOH7`
            console.log(linkApi);
            axios.get(linkApi).then(resp => {
                const response = resp.data.results;
                response.forEach(element => {
                    const divElement = document.createElement('div');
                    divElement.classList.add('address-result', 'border');
                    divElement.style.cursor= "pointer";
                    divElement.innerHTML = element.address.freeformAddress;
                    document.getElementById('suggestions-container').append(divElement);
                    divElement.addEventListener('click', function() {
                        document.getElementById('address').value = element.address.freeformAddress;
                        document.getElementById('lat').value = element.position.lat;
                        document.getElementById('lon').value = element.position.lon;
                        resultsContainer.innerHTML = '';
                    });
                });
                
            })
        }

    },
};


</script>


<style></style>
