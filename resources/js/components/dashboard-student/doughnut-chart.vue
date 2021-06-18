<script>
import { Doughnut, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins

export default {
  extends: Doughnut,
  mixins: [mixins.reactiveData],
  data() {
    return {
      chartData: '',
    }
  },
  mounted () {
    // this.chartData is created in the mixin.
    // If you want to pass options please create a local options object
    this.renderChart(this.chartData)
  },
  created() {
          axios.get('api/v1/user/items/totalpiechart')
          .then( response => {
              const responseData = response.data
              this.chartData = {
                  labels: ['Ongoing', 'Completed'],
                  datasets: [{
                      label: 'Task Status',
                      backgroundColor: ["#E46651","#41B883" ],
                      data : responseData.map(item => item.counts)
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
