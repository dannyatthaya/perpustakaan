<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-4">
        <br>
        <br>
        <h4>UPDATE BUKU</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="updateData()">
          <div class="form-group">
            <label>Judul Buku</label>
            <input type="textfield" class="form-control" v-model="form.title" required>
          </div>
          <div class="form-group">
            <label>Pengarang</label>
            <input type="textfield" class="form-control" v-model="form.author" required>
          </div>
          <div class="form-group">
            <label>Penerbit</label>
            <input type="textfield" class="form-control" v-model="form.publisher" required>
          </div>
          <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="textfield" class="form-control" v-model="form.year" required>
          </div>
          <div class="form-group">
            <label>Tahun Terbit</label>
            <textarea class="form-control" v-model="form.description" required rows="6"></textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-primary">Update Buku</button>
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
            form: {
                title: '',
                author: '',
                publisher: '',
                year: '',
                description: '',
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
                .get("http://localhost:8000/api/buku/" + this.$route.params.id)
                .then(response => {
                    // post value yang dari response ke form
                    this.form.title = response.data.title;
                    this.form.author = response.data.author;
                    this.form.publisher = response.data.publisher;
                    this.form.year = response.data.year;
                    this.form.description = response.data.description;
                });
        },
        updateData() {
            // put data ke api menggunakan axios
            this.$axios
                .put("http://localhost:8000/api/buku/" + this.$route.params.id, {
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
}

</script>
