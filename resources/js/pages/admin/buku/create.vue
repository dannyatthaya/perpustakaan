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
            <label>Deskripsi</label>
            <textarea class="form-control" v-model="form.description" required rows="6"></textarea>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <label for="cover" class="custom-file-label">{{ label }}</label>
              <input type="file" class="custom-file-input" accept="image/jpg" ref="cover" name="cover" id="cover" @change="onFileChange()">
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
      cover: null,
      label: 'Choose File ...',
      image: '',
      form: {
        title: '',
        author: '',
        publisher: '',
        year: '',
        description: '',
        cover: '',
      }
    }
  },
  methods: {
    onFileChange() {
      this.cover = this.$refs.cover.files[0];
      this.label = this.cover.name ? this.cover.name : 'Choose File ...';
      this.createdImage(this.cover);
      
    },
    createdImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    addData() {
      // post data ke api menggunakan axios
      this.$axios
        .post("http://localhost:8000/api/buku", {
          title: this.form.title,
          author: this.form.author,
          publisher: this.form.publisher,
          year: this.form.year,
          description: this.form.description,
          cover: Math.random().toString(36).substring(2, 15) + '.jpg',
          image: this.image,
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
