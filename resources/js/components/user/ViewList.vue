<template>
	<center>
		<h1>User lists</h1>
		<div>
			<div class="left-section">
				Avaliable Lists <hr>
				<div class="child-div" v-for="list in lists" :key="list.id" @click="getListDetails(list)">
					{{list.title}}
				</div>
			</div>
			<div v-if="flag" class="right-section">
				<h2>Add Task</h2>
				 <div class="container custom-container">
		          <form @submit.prevent="addTask(data)" class="col-md-10 col-lg-10">
		            <div class="form-group">
		              <input type="text" class="form-control" id="title" placeholder="Enter title" v-model="data.title" required>
		            </div>
		            <div class="form-group">
		              <textarea cols='55' id="description" v-model="data.description" rows="5"></textarea>
		            </div>
		            Status: <input v-model="data.status_check" type="checkbox"><br>
		            <button type="submit" class="btn btn-outline-primary btn-lg">Submit</button>
		            <div id="dataDiv"></div><div v-for="error in errors" :key="error">
              			{{error}}
           			</div>
           			<div id="errorDiv"></div>
		          </form>
		        </div>
		        <br><br><hr>
		        <h2>Avaliable Tasks</h2>
		        <div>
		        	<div class="task-div" v-for="task in Oldlists" :key="task.id">
		        		<span style="font-weight:bolder">{{task.title}}</span><br><hr>
		        		<span style="font-weight:bolder">{{task.description}}</span><br><hr>
		        		<b-progress :value="task.progress*33.3" :max="max" show-progress animated></b-progress>
		        		<small>progress</small><br>
		        		<div class="action-div">
		        			<i class="fa fa-edit" @click="editTaskDetails(task)"></i>
		        			<i class="fa fa-trash" @click="deleteTask(task)"></i>
		        		</div>
		        	</div>
		        </div>
			</div>
		</div>
	</center>
</template>
<script>
	export default {
		data(){
			return{
				data:{},
				lists:[],
				Oldlists:[],
				flag:false,
				staus:0,
				refferenceList:0,
                listId:0,
				refferenceListObj:[],
				errors:{},
                value:0,
                max:100
			}
		},
		methods:{
			getList(){
				let uri = '/api/lists';
			    this.axios.get(uri).then(response => {
			      this.lists = response.data.records;
			    });
			},
			getListDetails(list){
				this.refferenceList=list.id;
				this.refferenceListObj=list;
				this.axios.get('/api/getlisttask/'+list.id).then(response => {
                    if(typeof response.data !==""){
                        this.Oldlists=response.data.records;
                    }
			    });
				this.flag=true;
			},
			editTaskDetails(task){
				this.data=task;
			},
			deleteTask(task){
				let uri = '/api/deletetask/'+task.id;
			    this.axios.get(uri).then(response => {
			      this.getListDetails(this.refferenceListObj)
			    });
			},
			addTask(data){
                let calProgress=0;
                if(typeof data.title !== 'undefined') calProgress++;
                if(typeof data.description !== 'undefined') calProgress++;
                if(data.status_check) calProgress++;
				let uri="";
				if(data.id){
					uri = '/api/edittask/'+data.id;
				}else{
					uri = '/api/createtask';
				}
                if(typeof data.refferenceList){
                    this.$set(this.data, "list_id", this.refferenceList);
                }
                this.$set(this.data, "progress", calProgress);
			    this.axios.post(uri,data).then(res => {
			    	if(res.data._metadata.outcomeCode === 0){
		              $('#dataDiv').html(res.data._metadata.message);
		            }else{
		                this.errors=res.data.errors;
		                $('#errorDiv').html(res.data._metadata.message);
		            }
			    	this.getListDetails(this.refferenceListObj);
                    data.id="";
			    });
			}
		},
		mounted(){
			this.getList();
		}
	}
</script>
<style>
.left-section{
	width:40%;
	border:1px solid black;
	border-radius:5px;
	float:left;
	padding-bottom:5px;
}
.child-div{
	background-color:#343a40;
	width:80%;
	padding:5px;
	margin-top:3px;
	border-radius:10px;
	color:white;
	font-weight:bolder;
	cursor:pointer;
}
.right-section{
	width:60%;
	float:right;
	padding-bottom:5px;
}
.task-div{
	width:45%;
	min-height:150px;
	float:left;
	margin:10px;
	padding:10px;
	text-align:center;
	border:1px solid black;
	border-radius:20px;
}
.action-div{
	float:right;
	cursor:pointer;
}
</style>
