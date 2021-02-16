<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Todo list App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/main.css')}}">
    <link rel="icon" href="{{asset('public/favicon.png')}}" type="image/gif" sizes="16x16">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="display-1">ToDos</h1>
            <div class="card card-white">
                <div class="card-body" id="app">
                    <router-view></router-view>
                </div>
            </div>
            <p>Developed By <a href="https://www.facebook.com/samir.raihan.asif/" target="_blank" style="color: primary; text-decoration: none;"><i>Samir Raihan Asif</i></a></p>
        </div>
    </div>
</div>

<script src="{{asset('public/js/app.js')}}"></script>
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/js/toastr.min.js')}}"></script>
<!-- <script type="text/javascript">
    // export default {
    //   data() {
    //         return {
    //           name: '',
    //           counttasks: '',
    //         }
    //     },
    //   methods: {
    //     counttask(){
    //         axios.get('counttask')
    //          .then((response)=>{
    //            this.counttasks = response.data.counttask
    //          })
    //     },
    //     validatedata: function(e) {
    //         var self=this;
    //         if (e.keyCode === 13) {
    //             axios.post('store', {
    //                 name: this.name
    //               })
    //               .then(function (response) {
    //                 self.getData();
    //                 self.counttask();
    //                 toastr.success('', 'ToDo Added.')
    //                 if(response.status=='success'){
    //                       this.name = '';
    //                    }
    //               })
    //               .catch(function (error) {
    //                 console.log(error);
    //               });
    //             // alert('Enter was pressed');
    //           } else if (e.keyCode === 50) {
    //             alert('@ was pressed');
    //           }      
    //       this.log += e.key;
    //     },
    //     checkbox(id) {
    //         var self=this;
    //         axios.post('update/'+id, {
    //                 name: this.name
    //           })
    //           .then(function (response) {
    //             self.getData();
    //             alert('Status Changed');
    //             if(response.status=='success'){
    //             // alert('Deleted');
    //                }
    //           })
    //           .catch(function (error) {
    //             console.log(error);
    //           });
    //     },
    //     formcreate () {
    //       // do nothing ?
    //     },
    //     deleteTask(id) {
    //         var self=this;
    //         // this.form.delete('delete/'+id)
    //         axios.post('delete/'+id, {
    //                 name: this.name
    //           })
    //           .then(function (response) {
    //             self.getData();
    //             if(response.status=='success'){
    //             // alert('Deleted');
    //                }
    //           })
    //           .catch(function (error) {
    //             console.log(error);
    //           });
    //     }
    //   },
    //     created() {
    //         this.getData();
    //         this.counttask();
    //     },
    // };







    
    $( document ).ready(function() {
    
    "use strict";
    
    var todo = function() { 
        $('.todo-list .todo-item input').click(function() {
        if($(this).is(':checked')) {
            $(this).parent().parent().parent().toggleClass('complete');
        } else {
            $(this).parent().parent().parent().toggleClass('complete');
        }
    });
    
    $('.todo-nav .all-task').click(function() {
        $('.todo-list').removeClass('only-active');
        $('.todo-list').removeClass('only-complete');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.todo-nav .active-task').click(function() {
        $('.todo-list').removeClass('only-complete');
        $('.todo-list').addClass('only-active');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.todo-nav .completed-task').click(function() {
        $('.todo-list').removeClass('only-active');
        $('.todo-list').addClass('only-complete');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('#uniform-all-complete input').click(function() {
        if($(this).is(':checked')) {
            $('.todo-item .checker span:not(.checked) input').click();
        } else {
            $('.todo-item .checker span.checked input').click();
        }
    });
    
    $('.remove-todo-item').click(function() {
        $(this).parent().remove();
    });
    };
    
    todo();
    
    

    $(".add-task1").keypress(function (e) {
        if ((e.which == 13)&&(!$(this).val().length == 0)) {
            axios.post('/create', {
                firstName: 'Fred',
                lastName: 'Flintstone'
              })
              .then(function (response) {
                console.log(response);
              })
              .catch(function (error) {
                console.log(error);
              });
            
        } else if(e.which == 13) {
            alert('Please enter new task');
        }
        $(document).on('.todo-list .todo-item.added input').click(function() {
            if($(this).is(':checked')) {
                $(this).parent().parent().parent().toggleClass('complete');
            } else {
                $(this).parent().parent().parent().toggleClass('complete');
            }
        });
        $('.todo-list .todo-item.added .remove-todo-item').click(function() {
            $(this).parent().remove();
        });
    });
});
</script> -->
</body>
</html>