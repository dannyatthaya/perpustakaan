<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-4">
        <br>
        <br>
        <h4>UPDATE PEMINJAMAN</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="updateData()">
          <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="date" class="form-control" v-model="form.tanggalpinjam" required>
          </div>
          <div class="form-group">
            <label>User ID</label>
            <select class="form-control" v-model="form.user_id" required>
              <option v-for="anggota in anggotas" :key="anggota.id" v-bind:value="anggota.id">{{ anggota.name }}</option>
            </select>
          </div>
          <div class="form-group">
            <label>Buku ID</label>
            <select class="form-control" v-model="form.buku_id" required>
              <option v-for="buku in bukus" :key="buku.id" v-bind:value="buku.id">{{ buku.title }}</option>
            </select>
          </div>
          <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" class="form-control" v-model="form.tanggalkembali" required>
          </div>
          <div class="form-group">
            <button class="btn btn-primary">Update Pinjam</button>
            <router-link :to="{ path: $store.state.route.from.fullPath }" class="btn btn-secondary"> 
              Kembali
            </router-link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  middleware: 'admin',
  data() {
    return {
      bukus: [],
      anggotas: [],
      form: {
        tanggalpinjam: '',
        user_id: '',
        buku_id: '',
        tanggalkembali: '',
      }
    }
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
        // load data berdasarkan id
            this.$axios
                .get("http://localhost:8000/api/pinjam/" + this.$route.params.id)
                .then(response => {
                    // post value yang dari response ke form
                    this.form.tanggalpinjam = response.data.tanggalpinjam;
                    this.form.user_id = response.data.user_id;
                    this.form.buku_id = response.data.buku_id;
                    this.form.tanggalkembali = response.data.tanggalkembali;
                    console.log(response.data);
                    console.log(this.form);
                });
            // fetch data dari api menggunakan axios
            this.$axios.get("http://localhost:8000/api/buku").then(response => {
              // mengirim data hasil fetch ke varibale array bukus
              this.bukus = response.data;
            });

            // fetch data dari api menggunakan axios
            this.$axios.get("http://localhost:8000/api/anggota").then(response => {
              // mengirim data hasil fetch ke varibale array anggotas
              this.anggotas = response.data;
            });
        },
        updateData() {
            // put data ke api menggunakan axios
            this.$axios
                .put("http://localhost:8000/api/pinjam/" + this.$route.params.id, {
                    title: this.form.title,
                    author: this.form.author,
                    publisher: this.form.publisher,
                    year: this.form.year,
                    description: this.form.description,
                })
                .then(response => {
                    // push router ke read data
                    this.$router.push("/admin/buku/");
                });
    }
  }
};

</script>
