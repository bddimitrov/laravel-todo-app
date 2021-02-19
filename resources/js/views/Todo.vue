<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="jumbotron">
                    <div class="d-flex">
                        <input class="form-control mr-1" placeholder="Enter task title" v-model="title" :class="{ 'is-invalid': !isValid }">
                        <button class="btn btn-success" @click="addTodo()">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" :style="{ width: completedPercentage + '%' }" :aria-valuenow="completedTodos" aria-valuemin="0" :aria-valuemax="todos.length"></div>
                </div>
                <div class="jumbotron">
                    <div class="list-group">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="todo in todos" :key="todo.id" :class="{ 'list-group-item-success': todo.completed }">
                                <input type="checkbox" class="align-middle" :checked="todo.completed" v-model="todo.completed" @change="markCompleted(todo)">
                                <span class="align-middle">{{ todo.title }}</span>
                                <button type="button" class="btn btn-outline-danger float-right btn-sm" @click="deleteTodo(todo)">Remove</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        data: function () {
            return {
                title: '',
                isValid: true,
            }
        },
        mounted() {
            this.$store.dispatch('loadTodos');
        },
        computed: {
            ...mapGetters({
                todos: 'todos',
            }),
            completedTodos: function () {
                if (this.todos.length) {
                    return this.todos.filter((el) => el.completed === 1).length
                }

                return 0;
            },
            completedPercentage: function () {
                return (this.completedTodos / this.todos.length) * 100;
            }
        },
        methods:  {
            addTodo: function () {
                if ( this.title === '') {
                    this.isValid = false;
                    return;
                }

                this.$store
                    .dispatch('storeTodo', {
                        title: this.title,
                    })
                    .then(() => {
                        this.$store.dispatch('loadTodos');
                    });

                this.title = '';
                this.isValid = true;
            },
            markCompleted: function (item) {
                this.$store
                    .dispatch('toggleStatusTodo', item.id)
                    .then(() => {
                        this.$store
                            .dispatch('loadTodos')
                            .then(() => {
                                this.todos.sort(function (a,b) {
                                    return a.completed - b.completed;
                                });
                            });
                    });
            },
            deleteTodo: function (item) {
                this.$store
                    .dispatch('destroyTodo', item.id)
                    .then(() => {
                        this.$store.dispatch('loadTodos');
                    });
            }
        }
    }
</script>
