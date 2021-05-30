<template>
    <center>
        <div class="container custom-container">
          <h2 class="text-center">Sign Up</h2>
          <form @submit.prevent="addUser" class="col-md-5 col-lg-5">
            <div class="form-group">
             <input type="text" class="form-control" placeholder="Enter username" v-model="data.name" required>
            </div>
            <div class="form-group">
             <input type="email" class="form-control" placeholder="Enter email" v-model="data.email" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Enter password" v-model="data.password" required>
            </div>
            <button type="submit" class="btn btn-outline-primary btn-lg">Submit</button>
            <div id="dataDiv"></div><div v-for="error in errors" :key="error">
              {{error}}
            </div>
            <div id="errorDiv"></div>
          </form>
        </div>
    </center>
</template>

<script>
    export default {
      data(){
        return{
          data:{},
          errors:{},
        }
      },
      methods:{
        addUser(){
          this.errors='';
          let uri = '/api/register';
          this.axios.post(uri, this.data).then((response) => {
            if(response.data._metadata.outcomeCode === 0){
              $('#dataDiv').html(response.data._metadata.message);
            }else{
                this.errors=response.data.errors;
                $('#errorDiv').html(response.data._metadata.message);
            }
          });
        }
      },

    }
</script>

<style>
.custom-container{
    margin-top:100px;
}
</style>