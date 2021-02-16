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
      <div class="todo-list ex1" v-if="tasks">
        <div class="todo-item" v-for="(task, index) in tasks" :key="task.id">
          <div class="checker">
            <span class=""><input type="checkbox" :value="task.status" @change="checkbox(task.id)"></span>
          </div>
          <span contenteditable="true" @input="handleInput" v-model="editname" id="editname" v-on:keyup.13.preventDefault="editdata(task.id)">{{task.name | strippedContent}}</span>
          <a href="javascript:void(0);" @click="deleteTask(task.id)" class="float-right remove-todo-item"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
      </div>
      <div v-else>
        <div class="todo-list">
          <div class="todo-item">
            <span>No To Do Found Here!</span>
          </div>
        </div>
      </div>
    </span>
</template>
<script type="text/javascript">
  export default {
    data() {
        return {
            name: '',
            editname: '',
            tasks: {},
            counttasks: '0',
        }
    },
    methods: {
        getData() {
            axios.get('api/show/status/1')
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
                        self.name = '';
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
        checkbox(id) {
            var self = this;
            axios.post('api/update/' + id, {
                    name: this.name
                })
                .then(function(response) {
                    self.getData();
                    self.counttask();
                    toastr.success('', 'To do Completed.')
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        formcreate() {},
        handleInput: function(e) {
            this.editname = e.target.innerHTML;
            // console.log(this.editname);
        },
        editdata(id) {
            var self = this;
            if (!(this.editname)) {
              toastr.error('', 'Task Name Required!')
            } else {
                axios.post('api/update/task/' + id, {
                        editname: this.editname
                    })
                    .then(function(response) {
                        self.editname = '';
                        self.getData();
                        self.counttask();
                        document.getElementById('editname').contentEditable = false;
                        setInterval(document.getElementById('editname').contentEditable = true, 1000)
                        toastr.success('', 'To do Edited.')
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
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
    filters: {
        strippedContent: function(string) {
            return string.replace(/<\/?[^>]+>/ig, " ");
        }
    },
    created() {
        this.getData();
        this.counttask();
    },
  };
</script>