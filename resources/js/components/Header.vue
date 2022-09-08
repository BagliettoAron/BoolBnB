<template>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="ms_container">
      <div class="container-fluid">
        <i class="fa-brands fa-airbnb"></i>
        <span class="navbar-brand ms_title">BoolBnB</span>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <router-link class="nav-link" :to="{ name: 'home' }"
                >Home <span class="sr-only">(current)</span></router-link
              >
            </li>
            <li class="nav-item active">
              <router-link class="nav-link" :to="{ name: 'searchaccomodations' }"
                >Advanced search<span class="sr-only">(current)</span></router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>
</template>
  
<script>
export default {
    name: "Header",
};
</script>
  
<style lang="scss" scoped>
header {
  border-bottom: 1px solid lightgray;
  height: 80px;
  line-height: 40px;
  margin-bottom: 2rem;
}
.ms_container {
  width: 90%;
  margin: 0 auto;

  .ms_title {
    color: #ff385d;
    font-size: 1.2rem;
    margin-left: .5rem;
  }

  i {
    color: #ff395d;
    font-size: 1.9rem;
  }
}
</style>