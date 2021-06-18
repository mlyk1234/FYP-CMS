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
          axios.get('api/v1/user/supervise')
          .then( response => {
              const responseData = response.data
              this.chartData = {
                  labels: responseData.map(item => item.uniqueid),
                  datasets: [{
                      label: 'Report Submission (Supervise)',
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
