<template>
  <div>
    <metric-board></metric-board>
    <v-card class="d-flex align-start mb-6">
      <v-card class="pa-2">
        <div>
          <doughnut-chart></doughnut-chart> 
        </div>
      </v-card>
      <v-card class="ml-2 pa-2">
        <div>
          <supervise-chart></supervise-chart> 
        </div>
      </v-card>
      <v-card class="ml-2 pa-2">
        <div>
          <line-chart></line-chart> 
        </div>
      </v-card>
    </v-card>
    <v-card class="ml-2 pa-2">
        <div>
          <todo-board></todo-board> 
        </div>
    </v-card>
  </div>
</template>

<script>
  import MetricBoard from './ChartApex.vue';
  import LineChart from './planet-data.vue';
  import SuperviseChart from './supervisedata.vue';
  import DoughnutChart from './doughnut-chart.vue';
  import TodoBoard from "./TodoBoard"
  export default {
    components: {
      MetricBoard,
      SuperviseChart,
      LineChart,
      DoughnutChart,
      TodoBoard,
    },
    data () {
      return {
      }
    },
  }
</script>

<style>
  .small {
    max-width: 60px;
  }
</style>