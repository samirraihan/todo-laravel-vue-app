<template>
	<span>
	    <form v-on:submit.prevent="formcreate">
	        <input type="text" class="form-control add-task" placeholder="New Task..." v-model="name" v-on:keyup="validatedata">
	    </form>
	    <br>
	    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	      <div class="container-fluid">
	        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarSupportedContent">
	          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	            <li class="nav-item">
	              <a class="nav-link">{{counttasks}} items left</a>
	            </li>
	            <li class="nav-item">
	              <router-link to="/" class="nav-link">All</router-link>
	            </li>
	            <li class="nav-item">
	              <router-link to="/active" class="nav-link">Active</router-link>
	            </li>
	            <li class="nav-item">
	              <router-link to="/completed" class="nav-link">Completed</router-link>
	            </li>
	          </ul>
	        </div>
	      </div>
	    </nav>
		<br>
		<span v-if="tasks">
			<button @click="clearCompleted" class="btn btn-light">Clear Completed</button>
			<br>
			<div class="todo-list ex1">
				<div class="todo-item" v-for="(task, index) in tasks" :key="task.id">
					<span><i class="fa fa-check-circle-o" aria-hidden="true"></i> <del>{{task.name}}</del></span>
					<a href="javascript:void(0);" @click="deleteTask(task.id)" class="float-right remove-todo-item"><i class="fa fa-times" aria-hidden="true"></i></a>
				</div>
			</div>
		</span>
		<span v-else>
			<div class="todo-list">
				<div class="todo-item">
					<span>No To Do Found Here!</span>
				</div>
			</div>
		</span>
	</span>
</template>
<script type="text/javascript">
	export default {
    data() {
        return {
            name: '',
            tasks: {},
            counttasks: '0',
        }
    },
    methods: {
        getData() {
            axios.get('api/show/status/2')
                .then((response) => {
                    this.tasks = response.data.showbystatus
                })
        },
        counttask() {
            axios.get('api/counttask')
                .then((response) => {
                    this.counttasks = response.data.counttask
                })
        },
        validatedata: function(e) {
            var self = this;
            if (this.name && e.keyCode === 13) {
                axios.post('api/store', {
                        name: this.name
                    })
                    .then(function(response) {
                        self.getData();
                        self.counttask();
                        toastr.success('', 'To do Added.')
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
            if(!(this.name) && e.keyCode === 13){
              toastr.error('', 'Task Name Required!')
            }
            this.log += e.key;
        },
        formcreate() {
            // do nothing ?
        },
        clearCompleted() {
            var self = this;
            axios.post('api/destroy/completed')
                .then(function(response) {
                    self.getData();
                    self.counttask();
                    toastr.success('', 'Completed To do/s Deleted.')
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        deleteTask(id) {
            var self = this;
            axios.post('api/delete/' + id, {
                    name: this.name
                })
                .then(function(response) {
                    self.getData();
                    self.counttask();
                    toastr.success('', 'To do Deleted.')
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    },
    created() {
        this.getData();
        this.counttask();
    },
  };
</script>