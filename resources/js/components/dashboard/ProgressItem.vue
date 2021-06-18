<template>
    <div>
        <h4 class="ml-10 mt-5">{{ this.category[item.category_id] }}</h4>
        <v-card class="d-flex justify-center mb-6" style="margin-top:5px">
        <span style="margin:10px">0%</span>
        <v-card style="margin:10px" width="95%">
        <v-progress-linear
        v-model="changedata"
        color="amber"
        height="25"
        striped
        >
        <template :v-slot="{ changedata }">
            <strong>{{ Math.ceil(changedata) }}%</strong>
        </template>
        </v-progress-linear>
        </v-card>
        <span style="margin:10px">100%</span>
        <br>
        </v-card>
    </div>
</template>

<script>
    export default {
        props: ['item'],
        data: function () {
            return {
                set: '',
                category: ['Low-Priority', 'Important', 'High-Priority', 'Needs Attention'],
            }
        },
        created() {
            console.log(this.item.counts);
        },
        computed: {
            changedata(){
                return (this.item.totalCompleted/this.item.counts)*100;
            }
        },
    }
</script>