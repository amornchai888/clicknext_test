<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="/">Laravel SPA Clicknext </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto"></ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            <li class="nav-item" v-if="!isAuthenticated">
              <a class="nav-link" href="">Login</a>
            </li>
            <li class="nav-item" v-if="!isAuthenticated">
              <a class="nav-link" href="">Register</a>
            </li>

            <li class="nav-item dropdown">
              <a
                id="navbarDropdown"
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre
              >
                You are logged in!!!
              </a>

              <div
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdown"
              >
                <a class="dropdown-item">Logout </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- <router-view /> -->

    <main class="py-4">
      <router-view />
    </main>
  </div>
</template>

<script>
export default {
  mounted() {
    //this.getData();
  },
  data() {
    return {};
  },
  methods: {},
  computed: {
    // a computed getter
    isAuthenticated() {
      return !!localStorage.getItem("auth.token");
    },
  },
};
</script>