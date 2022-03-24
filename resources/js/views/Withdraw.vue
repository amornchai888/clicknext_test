<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">บัญชีของฉัน</div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h4>
                  เงินในบัญชี :
                  <span class="text-success">{{ account.balance }}</span> บาท
                </h4>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">ยอดเงินถอน</label>
                  <input
                    type="number"
                    class="form-control"
                    placeholder="0"
                    v-model="withdraw.amount"
                  />
                </div>
              </div>
            </div>
            <div class="row mb-0 mt-2">
              <div class="col-md-8">
                <button type="submit" @click="submit()" class="btn btn-success">
                  ยืนยัน
                </button>
                <router-link to="/" class="btn btn-primary"
                  >กลับหน้าหลัก</router-link
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getData();
  },
  data() {
    return {
      account: {
        account_no: null,
        balance: 0,
        history: [],
      },
      withdraw: {
        amount: 0,
      },
    };
  },
  methods: {
    getData() {
      axios
        .post("/api/get/account-data")
        .then((response) => {
          this.account = response.data;
        })
        .catch((err) => {});
    },
    submit() {
      axios
        .post("/api/process/withdraw", this.withdraw)
        .then((response) => {
          alert("ถอนเงินสำเร็จ คงเหลือ " + response.data.balance);
        })
        .catch((err) => {
          alert("ถอนเงินไม่สำเร็จ");
        });
    },
  },
};
</script>
