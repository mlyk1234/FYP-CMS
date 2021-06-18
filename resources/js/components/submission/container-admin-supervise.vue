<template>
    <div>
        <v-expansion-panels>
            <v-expansion-panel @click="onChange(items.id)" class="mb-3">
                <v-expansion-panel-header>
                <v-card class="pa-2">
                <div class="mb-2">Student: {{ items.name }}</div>
                <div class="mb-2" style="font-weight:bold">Matric No: {{ items.uniqueid }}</div>
                <div>Project Title: {{ items.project_title }}</div>
                </v-card>                
                <template v-slot:actions>
                    <v-icon color="primary">
                    $expand
                    </v-icon>
                </template>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                
                    <div class="ma-2" v-for="list in chapter">
                        <div v-if="list.userid !== null">
                            {{ list.chapter }}
                            <div v-if="list.chapter!==null">
                            <a class="ml-3" v-bind:href="'../storage/uploads/'+list.userid+'/'+list.chapter+'/'+list.submission_title" download="">
                                <v-btn outlined rounded text>Download</v-btn>
                            </a>
                            <checker :list="list" v-on:itemchanged="onChange(items.id)"></checker>
                            </div>
                        </div>
                        <div v-else>
                            <h4>No submission</h4>
                        </div>
                        <v-divider></v-divider>
                    </div>
                </v-expansion-panel-content>
            </v-expansion-panel>
            </v-expansion-panels>
        </div>
</template>

<script> 
import Checker from "./container-admin-supervise-item.vue";
export default {
    components: {
        Checker,
    },
    props: ['items'],
    data () {
      return {
        feedback: '',
        dialog: false,
        chapter: null,
        downloadShow: false,
        approve: '',
        doneApprove: '',
      }
    },
    methods: {
        onChange : function(userid)
        {
            axios.get('api/v1/user/listdownload/' + userid)
            .then( response => {
                this.chapter = response.data;
                this.downloadShow = true;
                console.log(response.data);
            })
        },
    },
}
</script>