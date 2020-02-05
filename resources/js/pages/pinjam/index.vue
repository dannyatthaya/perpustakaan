<template>
  <div class="row col-12 col-lg-12 mt-4 mb-4">
    <div class="col-lg-8 m-auto">
      <!-- BUKU SEDANG DI PINJAM -->
      <template v-if="pinjams.length">
      <h5 class="text-center">- BUKU YANG SEDANG DI PINJAM -</h5>
      <card :title="'#' + pinjam.id + ' ' + pinjam.books.title" class="mt-4" v-for="pinjam in pinjams" :key="pinjam.id">
        <div class="col-12 row">
          <div class="col-5">
            <img
              class="card-img-top"
              v-bind:src="getCover(pinjam)"
              style="width: 75%; height: auto;"
            />
          </div>
          <div class="col-7">
            <b>DETAIL</b>
            <div class="row">
              <div class="col-6 mt-2">
                <pre>
Judul Buku
Tanggal Pinjam
Tanggal Harus Dikembalikan
</pre>
                <p
                  class="text-muted"
                  style="font-size: 10px;"
                >* denda per hari 2000 jika telat mengembalikan buku</p>
              </div>
              <div class="col-6 mt-2">
                <pre>
<b>{{pinjam.books.title}}</b>
<b>{{pinjam.date_borrow}}</b>
<b>{{pinjam.date_return}}</b>
</pre>
              </div>
            </div>
          </div>
        </div>
      </card>
      </template>
      <template v-else>
        <p class="text-muted text-center"><i>Tidak ada buku yang sedang di pinjam</i></p>
      </template>
      
      <hr>
      
      <!-- BUKU SUDAH DI KEMBALIKAN -->
      <template v-if="kembalis.length">
      <h5 class="mt-4 text-center">- BUKU YANG TELAH DI KEMBALIKAN -</h5>
      <card :title="'#' + kembali.id + ' ' + kembali.books.title" class="mt-4" v-for="kembali in kembalis" :key="kembali.id">
        <div class="col-12 row">
          <div class="col-5">
            <img
              class="card-img-top"
              v-bind:src="getCover(kembali)"
              style="width: 75%; height: auto;"
            />
          </div>
          <div class="col-7">
            <b>DETAIL</b>
            <div class="row">
              <div class="col-6 mt-2">
                <pre>
Judul Buku
Tanggal Harus Dikembalikan
Tanggal Dikembalikan
Keterlambatan
Denda
</pre>
              </div>
              <div class="col-6 mt-2">
                <pre>
<b>{{kembali.books.title}}</b>
<b>{{kembali.date_return}}</b>
<b>{{kembali.date_returning}}</b>
<b>{{kembali.due}} Hari</b>
<b>Rp.{{formatPrice(kembali.fine)}}</b>
</pre>
              </div>
            </div>
          </div>
        </div>
      </card>
      </template>
      <template v-else>
        <p class="text-muted text-center"><i>Tidak ada buku yang telah di kembalikan</i></p>
      </template>

    </div>
  </div>
</template>
<!-- script js -->
<script>
export default {
  data() {
    return {
      pinjams: [],
      kembalis: [],
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
          console.log(this.pinjams);
        });

        this.$axios
        .get("http://localhost:8000/api/pengembalian/")
        .then(response => {
          this.kembalis = response.data;
          console.log(this.kembalis);
        });
    },
    getCover(pinjam) {
      let cover = "";
      if (pinjam.books.cover) {
        cover = pinjam.books.cover;
        let address = "/storage/" + cover;
        return address;
      }
    },
    formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
  }
};
</script>