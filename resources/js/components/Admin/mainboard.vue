<template>
  <div>
        <div>
          <tree-map></tree-map>
        </div>
    <v-card class="ml-2 pa-2">
        <div>
          <!--<todo-board></todo-board>--> 
        </div>
    </v-card>
  </div>
</template>

<script>
import TreeMap from "./ChartApex.vue";
  export default {
    components: {
      TreeMap,
    },
    data () {
      return {
      }
    },
  }
</script>

<style>
  .small {
    max-width: 60px;
  }
</style>