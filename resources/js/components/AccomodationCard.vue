<template>
  <router-link :to="{ name: 'accomodation', params: { id: accomodation.id } }">
    <section class="d-flex align-items-center flex-column">
      <div class="card">
        <div class="card-image">
          <img
            v-if="accomodation.picture"
            class="card-img-top"
            :src="accomodation.picture"
            alt="accomodation-picture"
          />
          <div class="card-like">
            <i class="fa-regular fa-heart"></i>
          </div>
          <!-- <p>Categoria: {{ categoryName }}</p> -->
        </div>
      </div>
      <div class="card-description">
        <h6 class="card-title">{{ accomodation.title }}</h6>
        <small>{{ accomodation.price_per_night }}€ / night</small>
        <!-- <p>Number of rooms: {{ accomodation.number_of_rooms }}</p>
      <p>Number of beds: {{ accomodation.number_of_beds }}</p> -->
        <div></div>
      </div>
    </section>
  </router-link>
</template>

<script>
export default {
  name: "AccomodationsCard",
  props: {
    accomodation: Object,
  },
};
</script>

<style lang="scss" scoped>
a {
  color: inherit;
}
a:hover {
  text-decoration: none;
}
.card {
  width: 300px;
  height: 300px;
  border: none;
  border-radius: 0.7rem;
  margin-bottom: 0.5rem;

  &-image {
    position: relative;
    border-radius: inherit;
    width: 100%;
    height: 100%;

    img {
      border-radius: inherit;
      height: 100%;
      overflow: hidden;
    }

    .card-like {
      position: absolute;
      top: 15px;
      right: 20px;

      i {
        font-size: 1.3rem;
      }

      i:hover {
        color: #ff385d;
      }
    }
  }

  &-description {
    margin-bottom: 1.5rem;
    width: 300px;
    h6 {
      font-weight: bold;
    }
  }

  &-title {
    margin: 0;
  }
}
</style>