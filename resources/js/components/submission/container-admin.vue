<template>
  <div>
    <v-card>
      <v-responsive :aspect-ratio="16/9">
        <v-card-text>
          <h3>Report Submission</h3>
          <v-divider></v-divider>
          <div>
            <h3>Supervise</h3>
            <div v-for="items in itemset">
                <container-supervise :items="items"></container-supervise>
            </div>
            <v-divider></v-divider>
            <h3>Examine</h3>
            <div v-for="items2 in itemset2">
                <container-examine :items2="items2"></container-examine>
            </div>
        </div>
        </v-card-text>
      </v-responsive>
    </v-card>
  </div>
</template>

<script> 
import ContainerSupervise from "./container-admin-supervise.vue";
import ContainerExamine from "./container-admin-examine.vue";
export default {
    components: {
        ContainerSupervise,
        ContainerExamine
    },
    data () {
      return {
        dialog: false,
        itemset: [],
        itemset2: [],
      }
    },
    created() {
        this.initialize();
        this.initialize2();
    },
    methods: {
    // REPLACED
      initialize() {
          axios.get('api/v1/user/list')
          .then(response => (
               this.itemset = response.data ))
          .catch(error => {
              console.log(error);
          })
      },
    initialize2() {
          axios.get('api/v1/user/list2')
          .then(response => (
               this.itemset2 = response.data ))
          .catch(error => {
              console.log(error);
          })
      },
    }
}
</script>