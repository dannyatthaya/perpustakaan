<template>
  <div class="container">
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>LIST BUKU</h4>
          </div>
          <div class="col-md-2">
            <!-- push router ke form membuat data -->
            <router-link :to="{ name: 'bukuCreate' }" class="btn btn-primary">
              Tambah +
            </router-link>
          </div>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Judul</th>
              <th scope="col">Pengarang</th>
              <th scope="col">Penerbit</th>
              <th scope="col">Tahun</th>
              <th scope="col">Sampul Buku</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="buku in bukus" :key="buku.id">
              <td style="width:20%"> {{ buku.title }} </td>
              <td style="width:10%"> {{ buku.author }} </td>
              <td style="width:10%"> {{ buku.publisher }} </td>
              <td style="width:10%"> {{ buku.year }} </td>
              <td style="width:30%"> {{ buku.image }} </td>
              <td style="width:20%">
                <router-link class="btn btn-warning" :to="'/detail/'+buku.id">Update</router-link>
                <button class="btn btn-danger" v-on:click="deleteData(buku.id)">Delete</button>
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
  data() {
    return {
      // variable array yang akan menampung hasil fetch dari api
      bukus: []
    };
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
    },
    deleteData(id) {
      // delete data
      this.$axios.delete("http://localhost:8000/api/buku/" + id).then(response => {
        this.loadData();
      });
    }
  }
};

</script>
