<template>
  <div class="row col-12">
    <div class="col-lg-8 m-auto">
      <card :title="'#' + pinjams.id + ' ' + title" class="mt-4">
        <div class="col-12 row">
          <div class="col-5">
            <img class="card-img-top" v-bind:src="getCover()" style="width: 75%; height: auto;" />
          </div>
          <div class="col-7">
            <b>DETAIL</b>
            <div class="row">
              <div class="col-6 mt-2">
<pre>
Judul Buku
Tanggal Pinjam
Tanggal Harus Dikembalikan
</pre>
                <p
                  class="text-muted"
                  style="font-size: 10px;"
                >* denda per hari 2000 jika telat mengembalikan buku</p>
              </div>
              <div class="col-6 mt-2">
<pre>
<b>{{title}}</b>
<b>{{pinjams.date_borrow}}</b>
<b>{{pinjams.date_return}}</b>
</pre>
              </div>
            </div>
          </div>
        </div>
      </card>
    </div>
  </div>
</template>
<!-- script js -->
<script>
import store from "~/store";

export default {
  data() {
    return {
      pinjams: [],
      cover: "",
      title: ""
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      if (store.getters["auth/user"]) {
        // fetch data dari api menggunakan axios
        this.$axios
          .get("http://localhost:8000/api/pinjam/" + this.$route.params.id)
          .then(response => {
            this.pinjams = response.data[0];
            this.cover = response.data[0].books.cover;
            this.title = response.data[0].books.title;
            console.log(this.pinjams);
          });
      } else {
        return this.$router.push("/404");
      }
    },
    getCover() {
      let cover = "";
      if (this.cover) {
        cover = this.pinjams.books.cover;
        let address = "/storage/" + cover;
        return address;
      } else {
        return;
      }
    }
  }
};
</script>
<style scoped>
</style>