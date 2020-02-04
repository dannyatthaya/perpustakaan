<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12 col-12 row">
        <br />
        <br />
        <div class="col-4">
          <img class="card-img-top" v-bind:src="getCover()" />
          <div class="mt-3">
            <b>DETAIL</b>
            <div class="row">
              <div class="col-6 mt-2">
                <pre>
Tahun Terbit
Bahasa
Penerbit
</pre>
              </div>
              <div class="col-6 mt-2">
                <pre>
<b>{{bukus.year}}</b>
<b>Bahasa Indonesia</b>
<b>{{bukus.publisher}}</b>
</pre>
              </div>
            </div>
          </div>
        </div>
        <div class="col-5">
          <div class="m-2">
            <h4>{{bukus.title}}</h4>
            <h6 class="text-muted">&nbsp;{{bukus.author}}</h6>
            <p>{{bukus.description}}</p>
          </div>
        </div>
        <div class="col-3">
          <button
            class="btn btn-primary btn-block"
            v-on:click="addData()"
          >
            <b>PINJAM</b>
          </button>
          <router-link
            :to="{ path: $store.state.route.from.fullPath }"
            class="btn btn-secondary btn-block"
          >Kembali</router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<!-- script js -->
<script>
import moment from 'moment'
export default {
  data() {
    return {
      bukus: {
        title: "",
        author: "",
        publisher: "",
        year: "",
        description: "",
        cover: "",
      },
      pinjam: {
        user_id: '',
        book_id: this.$route.params.id,
      },
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      this.$axios.get('http://localhost:8000/api/getuserid').then( (response) => {
        this.pinjam.user_id = response.data;
      });
      this.$axios
        .get("http://localhost:8000/api/buku/" + this.$route.params.id)
        .then(response => {
          // post value yang dari response ke form
          this.bukus.title = response.data.title;
          this.bukus.author = response.data.author;
          this.bukus.publisher = response.data.publisher;
          this.bukus.year = response.data.year;
          this.bukus.description = response.data.description;
          this.bukus.cover = response.data.cover;
        });
    },
    getCover() {
      let cover = "";
      if (this.bukus.cover) {
        cover = this.bukus.cover;
        let address = '/storage/' + cover;
        return address;
      }
    },
    addData() {
      var current = new Date();
      var kembali = new Date();
      var kembaliAdd = 7;
      kembali.setDate(kembali.getDate() + kembaliAdd);
      this.$axios
        .post("http://localhost:8000/api/pinjam", {
          date_borrow: moment(current).format('YYYY-MM-DD'),
          user_id: this.pinjam.user_id,
          book_id: this.pinjam.book_id,
          date_return: moment(kembali).format('YYYY-MM-DD'),
        })
        .then(response => {
          console.log(response);
          this.$router.push("/buku/detail/pinjam/" + response.data.id);
        })
        .catch(error => {
          console.log(error)
        });
    }
  }
};
</script>
<style scoped>
</style>