<template>
        <div class="container">
            <div class="row justify-content-center">
                <draggable element="div" class="col-md-12" v-model="categories" :options="dragOptions2">
                    <transition-group class="row">
                        <div class="col-md-4" v-for="element,index in categories" :key="element.id">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{element.name}}</h4>
                                </div>
                                <div class="card-body card-body-dark">
                                    <draggable :options="dragOptions" element="div" @end="changeOrder" v-model="element.tasks">
                                        <transition-group :id="element.id">
                                            <div v-for="task,index in element.tasks" :key="task.category_id+','+task.order" class="transit-1" :id="task.id">
                                                <div class="small-card">
                                                    <textarea v-if="task === editingTask" class="text-input" @keyup.enter="endEditing(task)" @blur="endEditing(task)" v-model="task.name"></textarea>
                                                    <label for="checkbox" v-if="task !== editingTask" @dblclick="editTask(task)">{{ task.name }}</label>
                                                    <v-btn color="error" class="ml-5" @click="deleteTask(index, index2 ,task)">Remove</v-btn>
                                                </div>
                                            </div>
                                        </transition-group>
                                    </draggable>
                                    <div class="small-card">
                                        <h5 class="text-center" @click="addNew(index)">Add new card</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition-group>
                </draggable>
            </div>
        </div>
</template>

<script>
import draggable from 'vuedraggable'
    export default {
        components: {
            draggable
        },
        data(){
            return {
                categories : [],
                editingTask : null
            }
        },
        methods : {
                addNew(id) {
                    let user_id = 1
                    let name = "New task"
                    let category_id = this.categories[id].id
                    let order = this.categories[id].tasks.length

                    axios.post('api/v1/user/task', {user_id, name, order, category_id}).then(response => {
                        this.categories[id].tasks.push(response.data.data)
                    })
                },
                loadTasks() {
                    this.categories.map(category => {
                        axios.get(`api/v1/user/category/${category.id}/tasks`).then(response => {
                            category.tasks = response.data
                        })
                    })
                },
                changeOrder(data) {
                    let toTask = data.to
                    let fromTask = data.from
                    let task_id = data.item.id
                    let category_id = fromTask.id;// == toTask.id ? null : toTask.id
                    let order = data.newIndex == data.oldIndex ? false : data.newIndex

                    if (order !== false) {
                        axios.patch(`api/v1/user/task/${task_id}`, {order, category_id}).then(response => {
                            // Do anything you want here
                        });
                    }
                },
                editTask(task){
                    this.editingTask = task
                },
                endEditing(task) {
                    this.editingTask = null

                    axios.patch(`api/v1/user/task/${task.id}`, {name: task.name}).then(response => {
                        // You can do anything you wan't here.
                    })
                },
                deleteTask(id, test, task){
                    axios.post(`api/v1/user/delete/${task.id}`, {taskid: task.id}).then(response => {
                        // You can do anything you wan't here.
                        console.log(this.categories[id].tasks.splice(test, 1))
                    //console.log(this.categories[id].tasks[test])
                    //console.log(this.categories[id].tasks.splice())
                    })
                }
        },
        mounted() {

            axios.get('api/v1/user/category').then(response => {
                response.data.forEach((data) => {
                    this.categories.push({
                        id : data.id,
                        name : data.name,
                        tasks : []
                    })
                })
                this.loadTasks()
            })
    },
            computed: {
                dragOptions () {
                  return  {
                    animation: 0,
                    group: 'description',
                    ghostClass: 'ghost'
                  };
                },
                dragOptions2 () {
                  return  {
                    animation: 1,
                    group: 'task',
                    ghostClass: 'ghost'
                  };
                },
            },
    }
</script>

<style scoped>
    .card {
        border:0;
        border-radius: 0.5rem;
    }
    .transit-1 {
        transition: all 1s;
    }
    .small-card {
        padding: 1rem;
        background: #f5f8fa;
        margin-bottom: 5px;
        border-radius: .25rem;
    }
    .card-body-dark{
        background-color: #ccc;
    }
    textarea {
        overflow: visible;
        outline: 1px dashed black;
        border: 0;
        padding: 6px 0 2px 8px;
        width: 100%;
        height: 100%;
        resize: none;
    }
</style>