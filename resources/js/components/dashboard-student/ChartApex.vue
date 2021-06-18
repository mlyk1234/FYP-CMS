<template>
  <div>
    <v-card class="pa-5 d-flex flex-wrap mb-6">
      <v-card shaped class="pa-2 mr-2" width="900">
        <div>
          <apexchart type="bar" :options="chartOptionsBar" :series="seriesBar"></apexchart>
        </div>
      </v-card>
      <v-card shaped class="pa-2" height="auto">
        <div>
          <v-card-text>
          <h4>To-do task</h4>
          </v-card-text>
          <apexchart type="pie" :options="chartOptionsPie" :series="seriesPie"></apexchart>
          <v-card-text class="ml-8">
            <v-btn to="/todo" link>Manage To-do Task</v-btn>
          </v-card-text>
        </div>
      </v-card> 
    </v-card>
  </div>
</template>

<script> 

export default {
  data: function() {
    return {
          seriesBar: [{
            data: []
          }],
          chartOptionsBar: {
          },
          seriesPie: [1,1],
          chartOptionsPie: {
          },
          setup: [],
    }
  },
  created() {
    // Horizontal Bar
    axios.get('api/v1/user/submittednew')
    .then( response => {
      const responseData = response.data;
      this.chartOptionsBar = {
          chart: {
            type: 'bar',
            height: 550,
            zoom: {
                enabled: true,
                type: 'x',
                resetIcon: {
                    offsetX: -10,
                    offsetY: 0,
                    fillColor: '#fff',
                    strokeColor: '#37474F'
                },
                selection: {
                    background: '#90CAF9',
                    border: '#0D47A1'
                }    
            }
          },
          plotOptions: {
              bar: {
                borderRadius: 4,
                horizontal: true,
              }
          },
          dataLabels: {
            enabled: false
          },
          xaxis: {
            categories: responseData.map(item => item.name)
          }
      };
      this.seriesBar = [
        {
            data: responseData.map(item => item.count)
        }
      ];
    });

    // Pie Chart
    axios.get('api/v1/user/items/totalpiechart')
    .then( response => {
      const responseData = response.data;
      this.seriesPie = responseData.map(item => item.counts),
      this.chartOptionsPie= {
            chart: {
              type: 'pie',
              width: 600,
              height: 500,
            },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 300
            },
            legend: {
              position: 'bottom'
            }
          }
        }],
            labels: ['Ongoing', 'Completed'],
          }
          
    });
  }
}
</script>