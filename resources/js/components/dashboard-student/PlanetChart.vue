<template>
  <div>
    <v-card class="pa-5 d-flex align-start mb-6">
      <v-card shaped class="pa-2">
        <div>
          <doughnut-chart></doughnut-chart> 
        </div>
      </v-card>
      <v-card shaped class="pa-2 ml-5">
        <div>
          <span>FYP 1</span>
          <line-chart width="850px"></line-chart> 
        </div>
      </v-card> 
    </v-card>
  </div>
</template>

<script>
  import LineChart from './planet-data.vue';
  import DoughnutChart from './doughnut-chart.vue';
  export default {
    components: {
      LineChart,
      DoughnutChart,
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