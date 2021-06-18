<template>
<div>
    
<v-card class="m-5">
<v-layout align-center justify-center column fill-height>
        <div style="margin:auto;padding-top:10px">
            <v-img max-width="550" src="/images/fyp-icon.png"/></v-img>
        </div>
    <div>
    <v-app>
    <v-card class="pl-2 pr-2 m-3">
    <v-card-text>
        <h3>Log in</h3>
    <div class="form-group">
        {{flag}}
        <div v-if="error" class="alert alert-danger" role="alert">
            {{valid1}}
        </div>
        <div v-if="success" class="alert alert-success" role="alert">
            {{valid2}}
        </div>
        <v-text-field
        v-model="user.email"
        :rules="emailRules"
        label="E-mail"
        required
        ></v-text-field>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
          <v-text-field
            v-model="user.password"
            :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.required, rules.min]"
            :type="show2 ? 'text' : 'password'"
            name="input-10-2"
            label="Password"
            hint="At least 8 characters"
            class="input-group--focused"
            @click:append="show2 = !show2"
          ></v-text-field>
    </div>
    <v-btn color="primary" @click="login">
      Log in
    </v-btn>
    <small id="emailHelp" class="form-text text-muted">This login will be Tokenized. Access Privileged</small>
    </v-card-text>
    </v-card>
    </v-app>
    </div>
</v-layout>
</v-card>
</div>
</template>

<script>
export default {
    data: () => ({
        valid1: 'Invalid Credentials',
        valid2: 'Logging',
        success: false,
        show2: false,
        rules: {
          required: value => !!value || 'Required.',
          min: v => v.length >= 8 || 'Min 8 characters',
          emailMatch: () => (`The email and password you entered don't match`),
        },
        flag: '',
        user: {
            email: "",
            password: "",
        },
        emailRules: [
            v => !!v || 'Email is required',
            v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
        error: false,
    }),
    methods: {
        validate () {
            
        },
        async login() {
            axios
            .post("/api/v1/user/login", {
                email: this.user.email,
                password: this.user.password
            })
            .then( response => {
                    //save token
                    if(response.data!==1)
                    {
                        localStorage.setItem('fyp_token', response.data.accessToken);
                        this.error = false;
                        window.location.replace('/fyp');
                        this.success = true;
                    }else if (response.data==1)
                    {
                        this.error = true;
                    }

                console.log( response.data );
            })
            .catch (error => {
                console.log(error);
            })
            
        },
    }
}
</script>
