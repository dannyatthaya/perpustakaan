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
              <th scope="col">User ID</th>
              <th scope="col">Buku ID</th>
              <th scope="col">Tanggal Kembali</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="pinjam in pinjams" :key="pinjam.id">
              <td style="width:20%"><b> {{ pinjam.tanggalpinjam }} </b></td>
              <td style="width:20%"> {{ pinjam.user_id }} </td>
              <td style="width:20%"> {{ pinjam.buku_id }} </td>
              <td style="width:20%"> {{ pinjam.tanggalkembali }} </td>
              <td style="width:20%">
                <router-link class="btn btn-default" :to="'pinjam/update/' + pinjam.id"><fa :icon="['fas', 'edit']" /></router-link>
                <button class="btn btn-default" v-on:click="deleteData(pinjam.id)"><fa :icon="['fas', 'trash']" /></button>
                <button class="btn btn-default" v-on:click="kembalikan(pinjam.id, pinjam.user_id, pinjam.buku_id, pinjam.tanggalkembali)"><fa :icon="['fas', 'check-double']" /></button>
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
      tanggaldikembalikan: '',
      terlambat: '',
      denda: '',
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
      var due = '';
      if(Math.abs(date1.diff(returned, "days")) > 0) {
        due = Math.abs(date1.diff(returned, "days"))
      } else {
        due = 0;
      }
      var fine = (due * 2000);
      // post data ke api menggunakan axios
      this.$axios
        .post("http://localhost:8000/api/kembali", {
          user_id: user_id,
          buku_id: buku_id,
          tanggalkembali: tanggalkembali,
          tanggaldikembalikan: returned,
          terlambat: due,
          denda: fine,
        })
        .then(response => {
          // delete data pinjam
          this.$axios.delete("http://localhost:8000/api/pinjam/" + id).then(response => {
            this.loadData();
          });
          // push router ke read data
          console.log(response);
          this.$router.push("/admin/pinjam");
        })
        .catch(error => {
          console.log(error)
        });
    }
  }
};

</script>