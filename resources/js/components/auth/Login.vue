<template>
    <center>
        <div class="container custom-container">
          <h2 class="text-center">Sign In</h2>
          <form @submit.prevent="loginUser" class="col-md-5 col-lg-5">
            <div class="form-group">
              <input type="email" class="form-control" id="email" placeholder="Enter email" v-model="data.email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="pwd" placeholder="Enter password" v-model="data.password">
            </div>
            <button type="submit" class="btn btn-outline-primary btn-lg">Submit</button>
            <div id="errorDiv"></div>
          </form>
        </div>
    </center>
</template>

<script>
    export default {
      data(){
        return{
          data:{}
        }
      },
      methods:{
        loginUser(){
          let uri="/api/login";
          this.axios.post(uri, this.data).then((response) => {
              if(response.data.records.status){
                localStorage.setItem('_token', response.data.records._token);
                this.$router.push({ name: 'list' });
              }else{
                $('#errorDiv').html(response.data._metadata.message);
              }
          });
        }
      }
    }
</script>

<style>
.custom-container{
    margin-top:100px;
}
</style>