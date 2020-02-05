<template>
  <div class="container">
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>LIST PEMINJAMAN</h4>
          </div>
          <div class="col-md-2">
            <!-- push router ke form membuat data -->
            <router-link :to="{ name: 'pinjamCreate' }" class="btn btn-primary">
              <fa :icon="['fas', 'plus-circle']" />
            </router-link>
          </div>
        </div>
        <br>
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Tanggal Pinjam</th>
              <th scope="col">Nama User</th>
              <th scope="col">Judul Buku</th>
              <th scope="col">Tanggal Kembali</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="pinjam in pinjams" :key="pinjam.id">
              <td style="width:20%"><b> {{ pinjam.date_borrow }} </b></td>
              <td style="width:20%"> {{ pinjam.user.name }} </td>
              <td style="width:20%"> {{ pinjam.books.title }} </td>
              <td style="width:20%"> {{ pinjam.date_return }} </td>
              <td style="width:20%">
                <router-link class="btn btn-default" :to="'pinjam/update/' + pinjam.id"><fa :icon="['fas', 'edit']" /></router-link>
                <button class="btn btn-default" v-on:click="deleteData(pinjam.id)"><fa :icon="['fas', 'trash']" /></button>
                <button class="btn btn-default" v-on:click="kembalikan(pinjam.id, pinjam.user_id, pinjam.books_id, pinjam.date_return)"><fa :icon="['fas', 'check-double']" /></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<!-- script js -->
<script>
import moment from 'moment'

export default {
  middleware: 'admin',
  data() {
    return {
      // variable array yang akan menampung hasil fetch dari api
      pinjams: [],
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      this.$axios.get("http://localhost:8000/api/pinjam").then(response => {
        this.pinjams = response.data;
      });
    },
    kembalikan(id, user_id, buku_id, tanggalkembali) {
      var date1 = moment(tanggalkembali, "YYYY-MM-DD");
      var returned = moment(new Date()).format('YYYY-MM-DD');
      var due = date1.diff(returned, "days") * -1;
      if(due > 0) {
        due = due;
      } else {
        due = 0;
      }
      var fine = (due * 2000);
      // post data ke api menggunakan axios
      this.$axios
        .post("http://localhost:8000/api/kembali", {
          user_id: user_id,
          books_id: buku_id,
          date_return: tanggalkembali,
          date_returning: returned,
          due: due,
          fine: fine,
        })
        .then(response => {
          // delete data pinjam
          this.$axios.delete("http://localhost:8000/api/pinjam/" + id).then(response => {
            this.loadData();
          });
          console.log(response);
        })
        .catch(error => {
          console.log(error)
        });
    },
    deleteData(id) {
      // delete data
      this.$axios.delete("http://localhost:8000/api/pinjam/" + id).then(response => {
        this.loadData();
      });
    }
  }
};

</script>