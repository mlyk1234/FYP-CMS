<template>
  <div>
    <canvas id="planet-chart"></canvas>
  </div>
</template>

<script>
import planetChartData from './planet-chart'

export default {
  name: 'PlanetChart',
    data() {
    return {
      planetChartData: planetChartData
    }
  },
  mounted() {
    const ctx = document.getElementById('planet-chart');
    new Chart(ctx, this.planetChartData);
  }
}
</script>