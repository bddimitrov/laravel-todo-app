<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Laravel Todo App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'Dashboard' }" v-show="isLogged">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'Login' }" v-show="!isLogged">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'Register' }" v-show="!isLogged">Register</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="logout" v-show="isLogged">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import { mapGetters } from 'vuex'

    export default {
        methods: {
            logout () {
                this.$store.dispatch('logout')
            }
        },
        computed: {
            ...mapGetters({
                isLogged: 'isLogged',
            }),
        }
    }
</script>
