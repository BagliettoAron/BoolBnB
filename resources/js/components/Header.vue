<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="ms_container">
      <div class="container-fluid">
        <i class="fas fa-hotel"></i>
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
              <router-link class="nav-link" :to="{ name: 'about' }"
                >About <span class="sr-only">(current)</span></router-link
              >
            </li>
            <li class="nav-item active">
              <router-link class="nav-link" :to="{ name: 'contact' }"
                >Contact <span class="sr-only">(current)</span></router-link
              >
            </li>
            <li class="nav-item active">
              <router-link class="nav-link" :to="{ name: 'accomodationscontainer' }"
                >Accomodations <span class="sr-only">(current)</span></router-link
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
</template>
  
<script>
export default {};
</script>
  
<style lang="scss" scoped>
.ms_container {
  width: 90%;
  margin: 0 auto;

  .ms_title {
    color: #ff395d;
    font-size: 1.5rem;
    font-weight: bold;
  }

  i {
    color: #ff395d;
    font-size: 1.3rem;
  }
}
</style>