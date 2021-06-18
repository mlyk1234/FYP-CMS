<template>
    <div>
    <div v-for="(item,index) in itemset" :key="index">
        <progress-item :item="item"></progress-item>
    </div>
    </div>
</template>

<script>
    import ProgressItem from "./ProgressItem.vue"

    export default {
        components: {
            ProgressItem,
        },
        props: ['itemset'],
        data: function () {
            return {
                set: '',
            }
        },
        created() {
        }
    }
</script>