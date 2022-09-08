<template>
    <div class="ms_main-container">
      <Header />
      <router-view />
      <Footer />
    </div>
</template>
  
<script>  
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";
export default {
    name: "App",
    components: {
      Header,
      Footer,
    },
};
</script>
  
<style lang="scss" scoped>
  .ms_main-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
</style>