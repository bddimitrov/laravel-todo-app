<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="jumbotron">
                    <h1>Register</h1>
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
                        <ul>
                            <li>one number</li>
                            <li>one uppercase letter</li>
                            <li>minimum 6 characters</li>
                        </ul>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm password</label>
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm password" v-model="password_confirmation" required>
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
                password_confirmation: '',
                errors: [],
            }
        },
        methods: {
            login () {
                if (!this.email || !this.password) {
                    return;
                }
                this.$store
                    .dispatch('register', {
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                    })
                    .then(() => {
                        this.$router.push({ name: 'Dashboard' })
                    })
                    .catch(result => {
                        var errors = result.response.data.errors;
                        let keys = Object.keys(errors);
                        this.errors = [];

                        keys.forEach(key => {
                            let item = errors[key];
                            item.forEach(error => {
                                this.errors.push(error);
                            })
                        })
                    });
            }
        }
    }
</script>
