<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="jumbotron">
                    <h1>Login</h1>
                    <div class="alert alert-danger" role="alert" v-show="errors.length">
                        <ul class="mb-0">
                            <li v-for="error in errors" :key="error">{{ error }}</li>
                        </ul>
                    </div>
                    <form @submit.prevent="login">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" v-model="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                email: '',
                password: '',
                errors: [],
            }
        },
        methods: {
            login () {
                if (!this.email || !this.password) {
                    return;
                }
                this.$store
                    .dispatch('login', {
                        email: this.email,
                        password: this.password
                    })
                    .then(() => {
                        this.$router.push({ name: 'Dashboard' })
                    })
                    .catch(result => {
                        this.errors = result.response.data.message;
                    });
            }
        }
    }
</script>
