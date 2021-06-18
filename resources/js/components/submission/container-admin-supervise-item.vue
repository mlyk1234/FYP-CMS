<template>
        <v-btn v-if="list.remarks1 !== 'true'" color="warning" v-on:click="approvedata(list.userid,list.chapter)" outlined rounded text alert success>Approve</v-btn>
        <v-btn v-else-if="list.remarks1 !== null" style="color:green;" color="success"  outlined rounded text alert success>Approved</v-btn>                  
    
</template>

<script>

export default {
    props: ['list'],

    methods: {
        approvedata: function(userid, chaptername) {
            
            this.approve = 1;
            this.doneApprove = true;
            axios.post('api/v1/approved/'+userid+'/'+chaptername)
            .then( response => {
                this.$emit('itemchanged');
                console.log(response.data);
            })
        }
    },
}
</script>