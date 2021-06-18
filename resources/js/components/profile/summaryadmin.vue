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
import ProfileItem from "./admin-profile-item.vue"
export default {
    components: {
        ProfileItem,
    },
    props: ['currentUser'],
    data() {
        return {
            profile: [],
            user: [],
        }
    },
    mounted: function(){
        
    },
    created(){
        this.onChange();
        this.user = this.currentUser;
    },
    methods: {
        onChange() {
            axios.get('http://192.168.126.150/api/profile/'+this.currentUser.id)
            .then( response => {
                this.profile = response.data
                console.log(response.data)
            })
        },
    },
}
</script>
