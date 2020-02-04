<template>
  <div class="container">
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>LIST PENGEMBALIAN</h4>
          </div>
        </div>
        <br>
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Used ID</th>
              <th scope="col">Buku ID</th>
              <th scope="col">Tanggal Kembali</th>
              <th scope="col">Tanggal Dikembalikan</th>
              <th scope="col">Terlambat</th>
              <th scope="col">Denda</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="kembali in kembalis" :key="kembali.id">
              <td style="width:10%"><b> {{ kembali.user_id }} </b></td>
              <td style="width:10%"> {{ kembali.buku_id }} </td>
              <td style="width:20%"> {{ kembali.tanggalkembali }} </td>
              <td style="width:20%"> {{ kembali.tanggaldikembalikan }} </td>
              <td style="width:10%"> {{ kembali.terlambat }} </td>
              <td style="width:10%"> Rp{{ formatPrice(kembali.denda) }} </td>
              <td style="width:20%">
                <button class="btn btn-default" v-on:click="deleteData(kembali.id)"><fa :icon="['fas', 'trash']" /></button>
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
export default {
  middleware: 'admin',
  data() {
    return {
      // variable array yang akan menampung hasil fetch dari api
      kembalis: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      this.$axios.get("http://localhost:8000/api/kembali").then(response => {
        this.kembalis = response.data;
      });
    },
    deleteData(id) {
      // delete data
      this.$axios.delete("http://localhost:8000/api/kembali/" + id).then(response => {
        this.loadData();
      });
    },
    formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
  }
};

</script>