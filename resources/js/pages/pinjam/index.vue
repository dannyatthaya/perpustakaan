<template>
  <div class="row col-12 col-lg-12 mt-4 mb-4">
    <div class="col-lg-8 m-auto">
      <card :title="'#' + pinjam.id" class="mt-4" v-for="pinjam in pinjams" :key="pinjam.id">
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
<b>{{pinjam.date_borrow}}</b>
<b>{{pinjam.book_id}}</b>
<b>{{pinjam.date_return}}</b>
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
      pinjams: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      this.$axios
        .get("http://localhost:8000/api/peminjaman/")
        .then(response => {
          this.pinjams = response.data;
        });
    }
  }
};
</script>