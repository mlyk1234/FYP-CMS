<template> 
<v-card width="1080">
<v-card-text>
    Update Evaluation Form (Optional)
</v-card-text>
<v-card-text>
    <div v-for="item in items">
        {{item.title}} 
        <list-criteria :item="item" :editedItem="editedItem"></list-criteria>
        <v-divider></v-divider>
    </div>
</v-card-text>
</v-card>
</template>

<script>
import ListCriteria from "./criteria.vue"
export default {
    props: ['editedItem'],
    components: {
        ListCriteria,
    },
    data: function() {
        return {
            items: [],
        }
    },
    methods: {
        initialize(){
            console.log('loaded1')
            axios.get('api/v1/evaluation')
            .then(response => {
            this.items = response.data;
            this.$emit('click');
            });
        }
    },
    created() {
        this.initialize();
    }

}
</script>