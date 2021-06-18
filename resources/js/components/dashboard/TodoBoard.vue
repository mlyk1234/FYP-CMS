<template>
  <div>
    <v-card class="pa-2">
      <progresser :itemset="itemset"></progresser>
    </v-card>
  </div>
</template>

<script>
import Progresser from "./Progress"
  export default {
    components: {
      Progresser,
    },
    data () {
      return {
        valueDeterminate: '',
        totalactive: '',
        itemset: [],
      }
    },
    computed: {
      test() {

      },
      result() {
        return parseInt(this.counter)/parseInt(this.itemset.category_id)*100;
      }
    },
    created() {
      axios.get('api/v1/user/items-admin/total')
        .then( response => {
            const responseData = response.data;
            this.itemset = response.data;
            
            /*this.itemset = {
                label: responseData.map(item => item.category_id),
                counter: responseData.map(item => item.counts),
            }*/
            //this.totalactive = response.data;
            //console.log( this.totalactive );
            //console.log( this.itemset[0] );
        })
        .catch(error => {
            console.log( error )
        });
      //this.valueDeterminate = (this.count/this.totalactive)*100;
    },
    methods: {

    },
  }
</script>