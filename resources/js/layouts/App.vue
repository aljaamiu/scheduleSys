<template>
  <div>
  
    <nav class="navbar navbar-light bg-success mt-3">
        
    <!-- <FlashMessage></FlashMessage> -->
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                
                <li class="nav-item active">
                  <router-link
                    class="nav-link"
                    data-toggle="collapse"
                    :to="{ name: 'home' }"
                  >
                    Home
                  </router-link>
                </li>

                <li class="nav-item">
                  <router-link
                    class="nav-link"
                    data-toggle="collapse"
                    :to="{ name: 'about' }"
                  >
                    About
                  </router-link>
                </li>
                
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button type="button" class="btn btn-outline-success my-2 my-sm-0" >Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
      <router-view></router-view>
    </div>

  </div>
</template>

<style>
    .image{
        width: 30px !important;
    }
    td{
        font-family:Arial, Helvetica, sans-serif;
        font-size: 18px;
        text-align: center;
    }
    th{
        font-family:Arial, Helvetica, sans-serif;
        font-size: 18px;
        text-align: center;
    }
</style>

<script>
export default {
  watch: {
    $route() {
      $("#navbarCollapse").collapse("hide");
    },
  },
};
</script>