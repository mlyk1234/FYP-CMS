<template> 
<v-card>
<div v-for="list in criteria">
    <v-divider></v-divider>
    <div class="pa-2">
        {{list.description}}
        <marking :list="list" :studentid="editedItem.studentid"></marking>
    </div>
</div>
    <v-divider></v-divider>
</v-card>

</template>

<script>
import Marking from "./marking.vue";
export default {
    components: {
        Marking,
    },
    props: ['item','editedItem'],
    data: function() {
        return {
            criteria: [],
            savedmarking: '',
        }
    },
    mounted: function(){
        //console.log(this.editedItem.studentid);
    },
    methods: {
        initialize(){
            console.log('loaded');
            axios.get('api/v1/criteria/'+this.item.id)
            .then(response => {
            this.criteria = response.data;
        });
        }
    },
    created() {
        
        this.initialize();


    }

}
</script>