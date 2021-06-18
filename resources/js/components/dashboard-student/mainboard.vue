<template> 
    <div>
        <metric-board></metric-board>
        
        <main-board></main-board>
    </div>
</template>

<script>
import MainBoard from "./Studentboard"
import MetricBoard from "./ChartApex.vue"
export default {
    components: {
        MainBoard,
        MetricBoard
    }
}
</script>