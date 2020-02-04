<template>
  <div>
    <section class="hero-banner">
      <div class="hero-banner__content text-center">
        <h1>Perpustakaan<br />Politeknik Negeri Padang</h1>
        <router-link :to="{ name: 'buku' }" class="btn btn-primary">
          Borrow some book
        </router-link>
      </div>
    </section>
    <section>
      <div class="container static__single-position">
        <div class="row">
          <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
            <div class="card static__single bg-light">
              <h3>{{ book }}</h3>
              <h4>Banyak Buku</h4>
            </div>
          </div>
          <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
            <div class="card static__single bg-light">
              <h3>{{ members }}</h3>
              <h4>Total Anggota</h4>
            </div>
          </div>
          <div class="col-md-12 col-xl-4 mb-4 mb-xl-0">
            <div class="card static__single bg-light">
              <h3>{{ borrows }}</h3>
              <h4>Total Peminjaman</h4>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'default',
  data() {
    return {
      book: '',
      borrows: '',
      members: ''
    };
  },

  mounted() {
    this.count();
  },

  metaInfo() {
    return { title: this.$t('home') }
  },  

  computed: mapGetters({
    authenticated: 'auth/check'
  }),

  methods: {
    count() {
      this.$axios.get("http://localhost:8000/api/buku").then(response => {
        this.book = response.data.length;
      });

      this.$axios.get("http://localhost:8000/api/pinjam").then(response => {
        this.borrows = response.data.length;
      });

      this.$axios.get("http://localhost:8000/api/anggota").then(response => {
        this.members = Object.keys(response.data).length;
      });
    },
    async logout() {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: '/' })
    }
  }
}

</script>
<style scoped>
.hero-banner {
  position: relative;
  height: 400px;
  background: url("images/hero-banner.png") left center no-repeat;
  background-size: cover;
  z-index: 1
}

@media (min-width: 1000px) {
  .hero-banner {
    height: 400px
  }
}

@media (min-width: 1200px) {
  .hero-banner {
    height: 400px
  }
}

@media (min-width: 1200px) {
  .hero-banner {
    height: 400px
  }
}

.hero-banner::after {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(2, 4, 23, 0.702);
  z-index: -1
}

.hero-banner__content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #fff;
  width: 100%;
  max-width: 620px
}

.hero-banner__content h1 {
  color: #fff;
  font-weight: 700;
  margin-bottom: 50px
}

.hero-banner--sm {
  height: 280px
}

@media (min-width: 1000px) {
  .hero-banner--sm {
    height: 350px
  }
}

@media (min-width: 1200px) {
  .hero-banner--sm {
    height: 450px
  }
}

.hero-banner--sm h1 {
  margin-bottom: 12px
}

.container {
  padding-left: 15px;
  padding-right: 15px
}

.static__single {
  border-radius: 4px;
  text-align: center;
  background: #fff;
  border: 0;
  padding: 20px;
  box-shadow: 0px 15px 20px 0px rgba(153, 153, 153, 0.1)
}

.static__single-position {
  margin-top: 40px;
  margin-bottom: 40px
}

@media (min-width: 1000px) {
  .static__single-position {
    margin: auto;
    position: relative;
    bottom: 40px;
    margin-bottom: -40px;
    z-index: 50
  }
}

.static__single h3 {
  font-size: 36px;
  font-weight: 700;
  position: relative;
  padding-bottom: 5px;
  margin-bottom: 20px
}

.static__single h3::after {
  content: "";
  display: inline-block;
  width: 60%;
  height: 2px;
  background: #de6320;
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%)
}

.static__single h4 {
  font-size: 20px;
  font-weight: 700
}

</style>
