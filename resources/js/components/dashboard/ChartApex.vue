<template>
  <div>
    <v-card class="pa-5 d-flex flex-wrap mb-6">
        <div>
          <div id="container"></div>
            <student-supervise></student-supervise>
        </div>
        <div>
          <div id="container"></div>
            <student-examine></student-examine>
        </div>
    </v-card>
  </div>
</template>

<script> 
import StudentSupervise from './studentsupervise.vue';
import StudentExamine from './studentexamine.vue';
export default {
  components:{
    StudentSupervise,
    StudentExamine
  },
  data: function() {
    return {
          loop: [],
          data: [],
          setup: [],
          series: [{
                name: "",
                data: []
              }],
          chartOptions: {
          },
    }
  },
  created() {

      axios.get('api/v1/submissiontype')
      .then( response => {
        const responseData = response.data;
        this.setup = responseData.map(item => item.name);
        console.log(this.setup);
        this.chartOptions = {
            chart: {
              height: 550,
              type: 'heatmap',
            },
            dataLabels: {
              enabled: false
            },
            xaxis: {
              type: 'category',
              categories: this.setup,
            },
            title: {
              text: 'HeatMap Chart (Different color shades for each series)'
            },
            grid: {
              padding: {
                right: 20
              }
            }
          }
      })

      var yo = [
        []
      ];
      axios.get('api/v1/user/who')
      .then( response => {
        console.log(response.data)
      });
        this.series = [
            {
              data: [{
                x: 'W1',
                y: 22
              }, {
                x: 'W2',
                y: 29
              }, {
                x: 'W3',
                y: 13
              }, {
                x: 'W4',
                y: 32
              }]
            },
            {
              name: "Series 2",
              data: [{
                x: 'W1',
                y: 43
              }, {
                x: 'W2',
                y: 43
              }, {
                x: 'W3',
                y: 43
              }, {
                x: 'W4',
                y: 43
              }]
            }
          ]
      
  },
}
</script>