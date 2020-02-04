<template>
  <div class="container">
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br />
        <br />

        <div class="row">
          <div class="col-md-10">
            <h4>BUKU</h4>
          </div>
        </div>

        <br />

        <div class="card-columns">
          <div class="card" v-for="buku in bukus" :key="buku.id">
            <router-link :to="'buku/detail/' + buku.id">
              <img class="card-img-top" v-bind:src="'http://localhost:8000/storage/' + buku.cover" style="background-size: cover;"/>
            </router-link>
            <div class="card-body">
              <router-link :to="'buku/detail/' + buku.id">
                <h6 class="card-title">{{ buku.title }}</h6>
              </router-link>
              <small class="text-muted">{{buku.author}}, {{ buku.year }}</small>
              <p class="card-text">{{ buku.description | truncate('100') }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<!-- script js -->
<script>
export default {
  data() {
    return {
      bukus: []
    };
  },
  created() {
    this.loadData();
  },
  filters: {
    truncate(string, value) {
      return string.substring(0, value) + "...";
    },
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      this.$axios.get("http://localhost:8000/api/buku").then(response => {
        this.bukus = response.data;
      });
    },
    deleteData(id) {
      // delete data
      this.$axios
        .delete("http://localhost:8000/api/buku/" + id)
        .then(response => {
          this.loadData();
        });
    }
  }
};
</script>
<style scoped>
@media (min-width: 1000px) {
  .card-columns {
    column-count: 5;
  }
}

@media (min-width: 1200px) {
  .card-columns {
    column-count: 5;
  }
}
</style>