<template>
    <div>
        <v-container>
           <v-card class="d-flex flex-wrap mb-6">
               <v-card width="300" class="pa-5 mr-1">
               <v-card-text>
                   <h4>Name</h4>{{items.name}}
               </v-card-text>
                <v-card-text>
                   <h4>Staff ID.</h4>
                       {{items.uniqueid}}
               </v-card-text>
                <v-card-text>
                   <h4>Email</h4>
                       {{items.email}}
               </v-card-text>
               </v-card>
               <v-card elevation="0" width="auto" class="pa-5">
               </v-card>
               <v-card width="100%" class="align-center pa-3">
                <edit-profile :items="items"></edit-profile>
               </v-card>
           </v-card> 
        </v-container>
    </div>
</template>

<script>
import EditProfile from './admin-profile-edit.vue'
export default {
    components: {
        EditProfile
    },
    props: ['items'],
    data() {
        return {
            dialog: false,
            profile: [],
        }
    },
}
</script>
