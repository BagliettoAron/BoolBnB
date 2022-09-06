<template>
    <div class="container">
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
            </div>
        </form>
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
    methods: {
        searchAddress() {
            window.axios.defaults.headers.common = {
                Accept: "application/json",
                "Content-Type": "application/json",
            };
            const resultsContainer = document.getElementById(
                "suggestions-container"
            );
            resultsContainer.innerHTML = "";
            const addressQuery = document.getElementById("address").value;
            const linkApi = `https://api.tomtom.com/search/2/search/${addressQuery}.json?key=xrJRsnZQoM2oSWGgQpYwSuOSjIRcJOH7`;

            Axios.get(linkApi).then((resp) => {
                const response = resp.data.results;
                response.forEach((element) => {
                    const divElement = document.createElement("div");
                    divElement.classList.add("address-result", "border");
                    divElement.style.cursor = "pointer";
                    divElement.innerHTML = element.address.freeformAddress;
                    document
                        .getElementById("suggestions-container")
                        .append(divElement);

                    divElement.addEventListener("click", function () {
                        document.getElementById("address").value =
                            element.address.freeformAddress;
                        resultsContainer.innerHTML = "";
                        const lat = element.position.lat;
                        const lon = element.position.lon;
                        Axios.get(
                            `https://api.tomtom.com/search/2/search/via roma.json?key=xrJRsnZQoM2oSWGgQpYwSuOSjIRcJOH7`
                        ).then((resp) => {
                            console.log(resp);
                        });

                        console.log(element.address.freeformAddress);
                        console.log(element.position.lat);
                        console.log(element.position.lon);
                    });
                });
            });
        },
    },
};
</script>

<style></style>
