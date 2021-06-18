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
          indexAxis: 'y',
          // Elements options apply to all of the options unless overridden in a dataset
          // In this case, we are setting the border of each horizontal bar to be 2px wide
          elements: {
            bar: {
              borderWidth: 2,
            }
          },
          responsive: true,
          plugins: {
            legend: {
              position: 'right',
            },
            title: {
              display: true,
              text: 'Chart.js Horizontal Bar Chart'
            }
          }
        },
    }
  },
  mounted () {
    // this.chartData is created in the mixin.
    // If you want to pass options please create a local options object
    this.renderChart(this.chartData, this.options)
  },
  created() {
    
          axios.get('api/v1/user/submitted')
          .then( response => {
              const responseData = response.data
              this.chartData = {
                  labels: ['FYP 1 Approved Brief Proposal for Review','Chapter 1', 'Chapter 2', 'Chapter 3', 'Chapter 4', 'Chapter 5', 'Chapter 6'],
                  datasets: [{
                      label: 'Submitted',
                      backgroundColor: (responseData.map(item => item.count) !== '1') ? '#FFD700' : '#ffbf00',
                      data : responseData.map(item => item.count)
                  },],
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
