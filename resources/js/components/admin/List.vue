<template>
	<center>
        <div class="container custom-container">
          <h2 class="text-center">Add List</h2>
          <form @submit.prevent="addList" class="col-md-5 col-lg-5">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Enter title" v-model="data.title" required>
            </div>
            <button type="submit" class="btn btn-outline-primary btn-lg">Submit</button>
          </form>
          <br><br>
          <h1>Avaliable List</h1>
          <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Progress</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="list in lists" :key="list.id">
                	<td>{{list.id}}</td>
                	<td>{{list.title}}</td>
                	<td>{{list.progress}}%</td>
                </tr>
            </tbody>
        </table>
        </div>
    </center>
</template>

<script>
    export default {
    	data(){
    		return{
    			data:{},
    			lists:[]
    		}
    	},
    	methods:{
    		getList(){
    			let uri = '/api/lists';
			    this.axios.get(uri).then(response => {
			      this.lists = response.data.records;
			    });
    		},
    		addList(){
    			let uri = '/api/createlists';
			    this.axios.post(uri,this.data).then(response => {
			      this.getList();
			    });
    		}
    	},
    	mounted(){
    		this.getList();
    	}
    }
</script>
