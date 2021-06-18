<script>
import { Bar, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins

export default {
  extends: Bar,
  mixins: [mixins.reactiveData],
  data() {
    return {
      chartData: '',
      options: {
        scales: {
          yAxes: [{
            ticks: {
              min: 0,
              max: 6,
              stepSize: 1,
              beginAtZero: true,
           callback: function(label, index, labels) {
             switch (label) {
               case 0:
                 return '';
               case 1:
                 return 'Chapter 1';
               case 2:
                 return 'Chapter 2';
               case 3:
                 return 'Chapter 3';
               case 4:
                 return 'Chapter 4';
               case 5:
                 return 'Chapter 5';
               case 6:
                 return 'Chapter 6';
             }
           }
            }
          }]
        }
      }
    }
  },
  mounted () {
    // this.chartData is created in the mixin.
    // If you want to pass options please create a local options object
    this.renderChart(this.chartData, this.options)
  },
  created() {
          axios.get('api/v1/user/examine')
          .then( response => {
              const responseData = response.data
              this.chartData = {
                  labels: responseData.map(item => item.uniqueid),
                  datasets: [{
                      label: 'Report Submission (Examine)',
                      backgroundColor: '#1E90FF',
                      data : responseData.map(item => item.counter)
                  } ]
              }
          })
    },
  methods: {
    getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
    }
  }

}
</script>
