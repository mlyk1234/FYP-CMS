<template>
  <div class="small">
    <line-chart></line-chart>
    <button @click="fillData()">Randomize</button>
  </div>
</template>

<script>
  import LineChart from './justview-chart.vue'
    
  export default {
    components: {
      LineChart
    },
    data () {
      return {
        preset: '',
      }
    },
  }
</script>

<style>
  .small {
    max-width: 600px;
    margin:  150px auto;
  }
</style>