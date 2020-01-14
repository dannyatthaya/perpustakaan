<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 mb-4">
        <br>
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
            <label>Sampul Buku</label>
            <input type="file" class="form-control-file" ref="file" name="file" @change="fileUpload($event.target)" required>
          </div>
          <div class="progress form-group">
            <!-- PROGRESS BAR DENGAN VALUE NYA KITA DAPATKAN DARI VARIABLE progressBar -->
            <div class="progress-bar" role="progressbar" :style="{width: progressBar + '%'}" :aria-valuenow="progressBar" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" :disabled="isLoading">{{ isLoading ? 'Loading...':'Upload' }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      progressBar: 0, //VARIABLE INI NILAINYA AKAN BERUBAH SESUAI PROGRESS UPLOADING
      message: '',
      isLoading: false,
      file: '', //UNTUK MENYIMPAN DATA FILE YANG AKAN DIUPLOAD
      files: [], //MENYIMPAN DATA FILE YANG TELAH DIUPLOAD
      form: {
        title: '',
        author: '',
        publisher: '',
        year: '',
        image: '',
      }
    }
  },
  methods: {
    addData() {
      // post data ke api menggunakan axios
      axios
        .post("http://localhost:8000/api/person", {
          first_name: this.form.firstName,
          last_name: this.form.lastName
        })
        .then(response => {
          // push router ke read data
          this.$router.push("/");
        });
    }
  }
};

</script>
