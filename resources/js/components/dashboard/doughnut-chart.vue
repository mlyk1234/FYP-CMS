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
          axios.get('api/v1/user/studentcategory')
          .then( response => {
              const responseData = response.data
              console.log(response.data);
              this.chartData = {
                  labels: ['Supervised', 'Examine'],
                  datasets: [{
                      label: 'Student under Examination',
                      backgroundColor: ["#41B883", "#E46651", "#00D8FF"],
                      data : response.data,
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
