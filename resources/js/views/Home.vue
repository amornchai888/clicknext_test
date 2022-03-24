<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">บัญชีของฉัน</div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h5>เลขบัญชี : {{ account.account_no }}</h5>
                <h4>
                  เงินในบัญชี :
                  <span class="text-success">{{ account.balance }}</span> บาท
                </h4>
                <small>ดอกเบี้ยที่จะได้รับในสิ้นปี : </small>
              </div>
              <div class="col-md-12">
                <table class="table">
                  <thead>
                    <tr class="success">
                      <th>รายการ</th>
                      <th>จำนวนเงิน</th>
                      <th>วันเวลา</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>โอนเงิน</td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>ถอนเงิน</td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <router-link to="/withdraw" class="btn btn-primary">ถอนเงิน</router-link>
          <button class="btn btn-success">โอนเงิน</button>
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
    };
  },
  methods: {
    getData() {
      axios
        .post("/api/get/account-data")
        .then((response) => {
          this.account = response.data;
        })
        .catch((err) => {
          console.log(err);
          alert("Error");
        });
    },
  },
};
</script>
