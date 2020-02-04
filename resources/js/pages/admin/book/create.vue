<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-4 mt-4">
        <card>
        <br>
        <h4>INSERT BUKU</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="addData()" enctype="multipart/form-data">
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
            <label>Deskripsi</label>
            <textarea class="form-control" v-model="form.description" required rows="6"></textarea>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <input type="file" id="file" ref="file" class="custom-file-input" accept="image/jpg" @change="onImageChanged" >
              <label class="custom-file-label" for="file" id="inputImage">{{ inputImage }}</label>
            </div>
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
      file: null,
      inputImage: 'Choose File',
      form: {
        title: '',
        author: '',
        publisher: '',
        year: '',
        image: '',
        description: ''
      }
    }
  },
  methods: {
    onImageChanged() {
      this.file = this.$refs.file.files[0];
      this.inputImage = this.file.name ? this.file.name : 'Choose File';
    },
    addData() {
      // post data ke api menggunakan axios
      this.$axios
        .post("http://localhost:8000/api/buku", {
          title: this.form.title,
          author: this.form.author,
          publisher: this.form.publisher,
          year: this.form.year,
          image: this.inputImage,
          description: this.form.description,
          headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'multipart/form-data'
                },
          files: this.file,
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
