<template>
    <div>
        <v-container>
           <v-card>
               <v-divider></v-divider>
               <v-card-text>
                   <h3>Profile Summary</h3>
                   <div v-for="items in profile">
                       <profile-item :items="items" v-on:itemchanged="onChange()"></profile-item>
                   </div>
               </v-card-text>
           </v-card> 
        </v-container>
    </div>
</template>

<script>
import ProfileItem from "./student-profile-item.vue"
export default {
    components: {
        ProfileItem,
    },
    data() {
        return {
            profile: [],
        }
    },
    created(){
        this.onChange()
    },
    methods: {
        onChange() {
            axios.get('api/v1/user/getProfile')
            .then( response => {
                this.profile = response.data
                console.log(response.data)
            })
        },
    },
}
</script>
