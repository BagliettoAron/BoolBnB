<template>
  <section class="d-flex align-items-center flex-column">
    <div class="card">
      <div class="card-image">
        <div class="card-like">
          <i class="fa-regular fa-heart"></i>
        </div>
        <!-- <p>Categoria: {{ categoryName }}</p> -->
      </div>
    </div>
    <div class="card-description">
      <p class="card-title">{{ accomodation.title }}</p>
      <small>{{ accomodation.price_per_night }}€ / notte</small>
      <p>Number of rooms: {{ accomodation.number_of_rooms }}</p>
      <p>Number of beds: {{ accomodation.number_of_beds }}</p>
      <!-- <p>Servizi: {{accomodation.services}}</p> -->
      <!-- <router-link :to="{ name: 'single-post', params: { slug: post.slug } }" class="card-link">Leggi post</router-link> -->
      <router-link
        :to="{ name: 'accomodation', params: accomodation.id }"
        class="card-link"
        >Show</router-link
      >
    </div>
  </section>
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
.card {
  width: 300px;
  height: 300px;
  border-radius: 0.7rem;
  margin-bottom: 1rem;
  position: relative;

  &-like {
    position: absolute;
    top: 10px;
    right: 10px;

    i {
      font-size: 1.3rem;
    }

    i:hover {
      color: #ff385d;
    }
  }

  &-description {
    margin-bottom: 1.5rem;
    margin-left: 1rem;
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