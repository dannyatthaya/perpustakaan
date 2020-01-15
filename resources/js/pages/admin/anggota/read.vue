<template>
  <div class="container">
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-12">
            <h4>LIST ANGGOTA</h4>
          </div>
        </div>
        <br>
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Tanggal Daftar</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="anggota in anggotas" :key="anggota.id">
              <td style="width:20%"><b> {{ anggota.name }} </b></td>
              <td style="width:30%"> {{ anggota.email }} </td>
              <td style="width:30%"> {{ anggota.created_at }} </td>
              <td style="width:20%">
                <router-link class="btn btn-default" :to="'anggota/update/' + anggota.id"><fa :icon="['fas', 'edit']" /></router-link>
                <button class="btn btn-default" v-on:click="deleteData(anggota.id)"><fa :icon="['fas', 'trash']" /></button>
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
      anggotas: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      this.$axios.get("http://localhost:8000/api/anggota").then(response => {
        // mengirim data hasil fetch ke varibale array bukus
        this.anggotas = response.data;
      });
    },
    deleteData(id) {
      // delete data
      this.$axios.delete("http://localhost:8000/api/anggota/" + id).then(response => {
        this.loadData();
      });
    }
  }
};
</script>