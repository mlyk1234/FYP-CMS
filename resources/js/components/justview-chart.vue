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
              max: 10,
              stepSize: 2,
              beginAtZero: true
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
          axios.get('api/v1/dashboard')
          .then( response => {
              const responseData = response.data
              this.chartData = {
                  labels: responseData.map(item => item.uniqueid),
                  datasets: [{
                      label: 'Students',
                      backgroundColor: '#F87979',
                      data : responseData.map(item => item.supervisor)
                  }]
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
