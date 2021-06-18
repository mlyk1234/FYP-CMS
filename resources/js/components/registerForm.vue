<template>
    <form-wrapper :validator="$v.user">

    <v-app>
            <small v-if="emailcheck==1" class="alert alert-warning form-text text-muted">{{user.email}} is taken!</small>
        <small v-if="emailcheck==2" class="alert alert-warning form-text text-muted">{{user.email}} is available!</small>

    <div class="form-group">
        <label for="exampleFormControlInput1">Name</label>
        <input type="text" v-model="user.name" class="form-control" id="exampleFormControlInput1" placeholder="Full name">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Unique ID</label>
        <input type="text" v-model="user.uniqueid" class="form-control" id="exampleFormControlInput1" placeholder="Matric No./Staff ID.">
    </div>
    <form-group name="email" label="Email">
        <label for="exampleFormControlInput1">Email address</label>
        <input type="email" @input="$v.user.email.$touch()" @keyup="check()" v-model="user.email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com">
        <small v-if="run==2" id="emailHelp" class="form-text text-muted">{{emailprompt}}</small>

    </form-group>
    <div class="form-group">
        <label for="exampleFormControlInput1">One time password</label>
        <input type="password" v-model="user.password" class="form-control" id="exampleFormControlInput3">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Register as</label>
        <select v-model="user.role" class="form-control" id="exampleFormControlSelect1">
            <option value="1">Student</option>
            <option value="2">Lecturer</option>
        </select>
    </div>
    <!--
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Project Title</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div> -->
    <div>
        <v-btn color="primary" :disabled="$v.$anyError || is_disabled" @click="register" class="btn btn-primary">Submit</v-btn>
    </div>
    </v-app>
</form-wrapper>
</template>

<script>
import { required, email } from "vuelidate/lib/validators";
    export default {
    //name: "signup",
    data: () => ({
        emailprompt: 'as',
        run: '',
        valid: true,
        user: {
                //userExists: false,
                name: "",
                uniqueid: "",
                email: "",
                password: "",
                role: "1",
            },
        emailcheck: '',
        reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
        emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid e.g Lorem@ipsum.com',
        ],
        is_disabled: true,
    }),
    validations: {
        user: {
            email: { required, email }
        },
        
    },
    methods: {
        check:function(){

            if(this.user.email !== null){
                axios.post("/api/v1/user/check", {
                    email: this.user.email,
                }).then( response => {
                    if(response.data == 1)
                    {
                        this.emailcheck = 1;
                        console.log(response.data);
                        this.is_disabled = true;
                    }else{
                        console.log(response.data);
                        this.emailcheck = 2;
                        this.is_disabled = false;
                    }
                })
            }
        },
        register() {

            axios
            .post("/api/v1/user/register", {
                name: this.user.name, 
                uniqueid: this.user.uniqueid,
                email: this.user.email, 
                password: this.user.password,
                role: this.user.role
            })
            .catch(error => {
                reject(error);
            })
            .then( response => {
                window.location.replace('/login');
                console.log( response.data );
            })
        }
    }
}

</script>