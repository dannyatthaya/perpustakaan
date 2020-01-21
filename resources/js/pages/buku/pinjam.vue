<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card :title="pinjams.id" class="mt-4">
        <div class="mt-3">
          <b>DETAIL</b>
          <div class="row">
            <div class="col-6 mt-2">
              <pre>
Tanggal Pinjam
Buku ID
Tanggal Kembali
</pre>
            </div>
            <div class="col-6 mt-2">
              <pre>
<b>{{pinjams.tanggalpinjam}}</b>
<b>{{pinjams.buku_id}}</b>
<b>{{pinjams.tanggalkembali}}</b>
</pre>
            </div>
          </div>
        </div>
      </card>
    </div>
  </div>
</template>
<!-- script js -->
<script>
export default {
  data() {
    return {
      pinjams: {
        tanggalpinjam: "",
        user_id: "",
        buku_id: "",
        tanggalkembali: ""
      }
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      this.$axios
        .get("http://localhost:8000/api/pinjam/" + this.$route.params.id)
        .then(response => {
          this.pinjams = response.data;
        });
    }
  }
};
</script>
<style scoped>
</style>