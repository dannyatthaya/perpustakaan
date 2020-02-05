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
            <label>Tanggal Pinjam</label>
            <input type="date" class="form-control" v-model="form.date_borrow" required>
          </div>
          <div class="form-group">
            <label>User ID</label>
            <select class="form-control" v-model="form.user_id" required>
              <option v-for="anggota in anggotas" :key="anggota.id" v-bind:value="anggota.id">{{ anggota.name }}</option>
            </select>
          </div>
          <div class="form-group">
            <label>Buku ID</label>
            <select class="form-control" v-model="form.books_id" required>
              <option v-for="buku in bukus" :key="buku.id" v-bind:value="buku.id">{{ buku.title }}</option>
            </select>
          </div>
          <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" class="form-control" v-model="form.date_return" required>
          </div>
          <div class="form-group">
            <button class="btn btn-primary">Insert Pinjam</button>
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
import moment from 'moment'

export default {
  middleware: 'admin',
  data() {
    return {
      bukus: [],
      anggotas: [],
      form: {
        date_borrow: '',
        user_id: '',
        books_id: '',
        date_return: '',
      }
    }
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
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
    addData() {
      // post data ke api menggunakan axios
      this.$axios
        .post("http://localhost:8000/api/pinjam", {
          date_borrow: moment(String(this.form.date_borrow)).format('YYYY-MM-DD'),
          user_id: this.form.user_id,
          books_id: this.form.books_id,
          date_return: moment(String(this.form.date_return)).format('YYYY-MM-DD'),
        })
        .then(response => {
          // push router ke read data
          console.log(response);
          this.$router.push("/admin/pinjam/");
        })
        .catch(error => {
          console.log(error)
        });
    }
  }
};

</script>
