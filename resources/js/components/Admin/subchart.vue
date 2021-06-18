<template>
  <div>
    <v-card shaped class="pa-2 mr-2" width="500">
        <apexchart type="radialBar" height="480" :options="chartOptions" :series="series"></apexchart>
        <apexchart type="radialBar" height="480" :options="chartOptions2" :series="series2"></apexchart>
    </v-card>
  </div>
</template>

<script> 

export default {
  data: function() {
    return {
          series: [76, 67, 61, 90],
          series2: [76, 67, 61, 90],
          chartOptions: {
            chart: {
              height: 390,
              type: 'radialBar',
            },
            plotOptions: {
              radialBar: {
                offsetY: 0,
                startAngle: 0,
                endAngle: 270,
                hollow: {
                  margin: 5,
                  size: '20%',
                  background: 'transparent',
                  image: undefined,
                },
                dataLabels: {
                  name: {
                    show: false,
                  },
                  value: {
                    show: false,
                  }
                }
              }
            },
            colors: ['#1ab7ea', '#0084ff', '#39539E', '#0077B5'],
            labels: ['Registered Student', 'Supervised', 'Has Examiner', 'Not Monitored'],
            legend: {
              show: true,
              floating: true,
              fontSize: '16px',
              position: 'left',
              offsetX: 10,
              offsetY: 45,
              labels: {
                useSeriesColors: true,
              },
              markers: {
                size: 0
              },
              formatter: function(seriesName, opts) {
                return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
              },
              itemMargin: {
                vertical: 3
              }
            },
            responsive: [{
              breakpoint: 480,
              options: {
                legend: {
                    show: false
                }
              }
            }]
          },
          chartOptions2: {
            chart: {
              height: 390,
              type: 'radialBar',
            },
            plotOptions: {
              radialBar: {
                offsetY: 0,
                startAngle: 0,
                endAngle: 270,
                hollow: {
                  margin: 5,
                  size: '20%',
                  background: 'transparent',
                  image: undefined,
                },
                dataLabels: {
                  name: {
                    show: false,
                  },
                  value: {
                    show: false,
                  }
                }
              }
            },
            colors: ['#1ab7ea', '#0084ff', '#39539E', '#0077B5'],
            labels: ['Registered Lecturer', 'Supervising', 'Examining'],
            legend: {
              show: true,
              floating: true,
              fontSize: '16px',
              position: 'left',
              offsetX: 10,
              offsetY: 45,
              labels: {
                useSeriesColors: true,
              },
              markers: {
                size: 0
              },
              formatter: function(seriesName, opts) {
                return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
              },
              itemMargin: {
                vertical: 3
              }
            },
            responsive: [{
              breakpoint: 480,
              options: {
                legend: {
                    show: false
                }
              }
            }]
          },          
    }
  },
  created() {
    axios.get('http://192.168.126.150/api/radial')
    .then( response => {
        console.log(response.data);
          this.series= response.data;
          console.log(this.series);
    });

    axios.get('http://192.168.126.150/api/radial2')
    .then( response => {
        console.log(response.data);
          this.series2= response.data;
          console.log(this.series2);
    });
  }
}
</script>