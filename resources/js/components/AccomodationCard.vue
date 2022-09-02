<template>
    <section>
        <div class="card mb-3">
            <div class="card-body">
                <!-- <p>Categoria: {{ categoryName }}</p> -->
                <h5 class="card-title">{{ accomodation.title }}</h5>
            </div>
            <div class="card-body">
                <!-- <router-link :to="{ name: 'single-post', params: { slug: post.slug } }" class="card-link">Leggi post</router-link> -->
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "AccomodationsCard",
    props: {
        accomodation: Object
    },
}

</script>

<style>
</style>