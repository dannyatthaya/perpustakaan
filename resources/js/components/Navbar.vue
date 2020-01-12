<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand">
        {{ appName }}
      </router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false">
        <span class="navbar-toggler-icon" />
      </button>
      <div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <locale-dropdown />
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li> -->
        </ul>
        <ul class="navbar-nav ml-auto">
          <template v-if="user">
            <!-- Authenticated -->
            <li class="nav-item">
              <router-link :to="{ name: 'dashboard' }" class="nav-link">
                Dashboard
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'anggota' }" class="nav-link">
                Anggota
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'buku' }" class="nav-link">
                Buku
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'peminjaman' }" class="nav-link">
                Peminjaman
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'pengembalian' }" class="nav-link">
                Pengembalian
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'settings.profile' }" class="nav-link">
                {{ $t('settings') }}
              </router-link>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" @click.prevent="logout">
                {{ $t('logout') }}
              </a>
            </li>
          </template>
          <!-- Guest -->
          <template v-else>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                {{ $t('login') }}
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
                {{ $t('register') }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}

</script>
<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}

</style>
