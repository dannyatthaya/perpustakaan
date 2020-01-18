<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-4 mt-4">
        <card>
        <br>
        <h4>INSERT BUKU</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="addData()">
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
            <button class="btn btn-primary">Insert Buku</button>
            <router-link :to="{ path: $store.state.route.from.fullPath }" class="btn btn-secondary"> 
              Kembali
            </router-link>
          </div>
        </form>
        </card>
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
  methods: {
    addData() {
      // post data ke api menggunakan axios
      this.$axios
        .post("http://localhost:8000/api/buku", {
          title: this.form.title,
          author: this.form.author,
          publisher: this.form.publisher,
          year: this.form.year,
          description: this.form.description,
        })
        .then(response => {
          // push router ke read data
          console.log(response);
          this.$router.push("/admin/buku/");
        });
    }
  }
};

</script>
