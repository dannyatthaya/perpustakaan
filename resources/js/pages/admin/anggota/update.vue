<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-4">
        <br>
        <br>
        <h4>UPDATE ANGGOTA</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="updateData()">
          <div class="form-group">
            <label>Nama</label>
            <input type="textfield" class="form-control" v-model="form.name" required>
          </div>
          <div class="form-group">
            <label>Pengarang</label>
            <input type="textfield" class="form-control" v-model="form.email" required>
          </div>
          <div class="form-group">
            <button class="btn btn-primary">Update Anggota</button>
            <router-link :to="{ path: $store.state.route.from.fullPath }" class="btn btn-secondary"> 
              Kembali
            </router-link>
          </div>
        </form>
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
                name: '',
                email: '',
            }
        }
    },
    created() {
        this.loadData();
    },
    methods: {
        loadData() {
        // load data berdasarkan id
            this.$axios
                .get("http://localhost:8000/api/anggota/" + this.$route.params.id)
                .then(response => {
                    // post value yang dari response ke form
                    this.form.name = response.data.name;
                    this.form.email = response.data.email;
                });
        },
        updateData() {
            // put data ke api menggunakan axios
            this.$axios
                .put("http://localhost:8000/api/anggota/" + this.$route.params.id, {
                    name: this.form.name,
                    email: this.form.email,
                })
                .then(response => {
                    // push router ke read data
                    this.$router.push("/admin/anggota/");
                });
    }
}
}

</script>
