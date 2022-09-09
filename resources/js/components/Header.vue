<template>
  <header>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
            <li class="nav-item active">
              <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="/register">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <router-link
          class="nav-link navbar-brand"
          href="#"
          :to="{ name: 'home' }"
          ><div>
            <i class="fa-brands fa-airbnb"></i>
            <span class="ms_title">BoolBnB</span>
          </div>
        </router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <router-link class="nav-link" :to="{ name: 'home' }"
                >Home <span class="sr-only">(current)</span></router-link
              >
            </li>
            <li class="nav-item active">
              <router-link
                class="nav-link"
                :to="{ name: 'searchaccomodations' }"
                >Advanced search<span class="sr-only"
                  >(current)</span
                ></router-link
              >
            </li>
          </ul>
          <div class="form-inline my-2 my-lg-0 ms_authentication">
            <a class="nav-link" href="/login">Login</a>
            <a class="nav-link" href="/register">Register</a>
            <!-- <input
              class="form-control mr-sm-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
              Search
            </button> -->
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
// header {
//   border-bottom: 1px solid lightgray;
//   height: 80px;
//   line-height: 40px;
//   margin-bottom: 2rem;
// }
// .ms_container {
//   width: 90%;
//   margin: 0 auto;

//   .ms_title {
//     color: #ff385d;
//     font-size: 1.2rem;
//     margin-left: .5rem;
//   }

//   i {
//     color: #ff395d;
//     font-size: 1.9rem;
//   }
// }
header {
  border-bottom: 1px solid lightgray;
  height: 80px;
  line-height: 40px;
  margin-bottom: 2rem;
}

#navbarSupportedContent {
  z-index: 1;
  background-color: rgb(248, 250, 252);
}
.ms_title {
  color: #ff385d;
  font-size: 1.2rem;
  margin-left: 0.4rem;
}

i {
  color: #ff395d;
  font-size: 1.5rem;
}

.ms_authentication {
  a {
    color: rgba($color: #000000, $alpha: 0.5);
  }
  a:hover {
    color: #ff395d;
  }
}
</style>