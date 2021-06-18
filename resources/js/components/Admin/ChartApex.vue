<template>
  <div>
    <v-card class="pa-5 d-flex flex-wrap mb-6">
        <div>
          <div id="container"></div>
          <v-card shaped class="pa-2 mr-4" width="1000">
          <apexchart type="treemap" height="550" :options="chartOptions" :series="series"></apexchart>
          </v-card>
        </div>
        <div>
        <div id="container"></div>
          <subchart></subchart>
        </div>
    </v-card>
  </div>
</template>

<script> 
import Subchart from './subchart.vue';
export default {
  components: {
    Subchart,
  },
  data: function() {
    return {
          series: [
            {
              data: [
                {
                  x: '',
                  y: ''
                },
              ]
            }
          ],
          chartOptions: {
            legend: {
              show: false
            },
            chart: {
              height: 450,
              type: 'treemap'
            },
            title: {
              text: 'Student Heatmap'
            },
            dataLabels: {
              enabled: true,
              style: {
                fontSize: '12px',
              },
              formatter: function(text, op) {
                return [text, op.value]
              },
              offsetY: -4
            },
                        colors: [
              '#3B93A5',
              '#F7B844',
              '#EC3C65',
              '#D43F97',
              '#1E5D8C',
              '#421243',
              '#7F94B0',
              '#EF6537',
              '#C0ADDB'
            ],
            plotOptions: {
              treemap: {
                distributed: true,
                enableShades: false
              }
            }
          },
    }
  },
  created() {
    axios.get('http://192.168.126.150/api/treemap')
    .then( response => {
        console.log(response.data);
          this.series= [
            {
              data: response.data
            }
          ];
          console.log(this.series);
    });
  }
}
</script>