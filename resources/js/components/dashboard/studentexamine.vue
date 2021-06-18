<template>
  <div>
      <v-card shaped class="pa-2 mr-2" width="780">
            <apexchart type="bar" height="650" :options="chartOptions" :series="series"></apexchart>
      </v-card>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
          setup: [],
          loop:"",
          cat: "",
          series: [{
              }],
          chartOptions: {
            chart: {
              type: 'bar',
              height: 650,
            },
            plotOptions: {
              bar: {
                horizontal: true,
                dataLabels: {
                  position: 'top',
                },
              }
            },
            dataLabels: {
              enabled: true,
              offsetX: -6,
              style: {
                fontSize: '12px',
                colors: ['#fff']
              }
            },
            stroke: {
              show: true,
              width: 1,
              colors: ['#fff']
            },yaxis: [{
              min: 0,
              max: 16,
            },
            ],
            title: {
              text: 'Student Progression'
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return val + "K"
                }
              }
            },
            fill: {
              opacity: 1
            
            },
            legend: {
              position: 'top',
              horizontalAlign: 'left',
              offsetX: 40
            }
          },
    }
  },
  created() {
    axios.get('api/v1/user/loopexamine')
    .then(response => {
      var parser = response.data.map(item=>item.uniqueid)
      this.loop = response.data;
      this.cat = JSON.parse(JSON.stringify(parser));
      console.log(this.cat);
      this.chartOptions = {
        xaxis: {
          categories: this.cat,
        },
      };
    });

    axios.get('api/v1/user/examineprogress')
    .then(response => {
      const responseData = response.data;
      console.log(response.data);
      this.series = [{
              name: "Submission of Reports (Examine)",
              data: responseData.map(item=>item.count)
            },{}];
      console.log(this.series);
    });    

            
  },
}
</script>