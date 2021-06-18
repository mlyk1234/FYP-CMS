<template>
  <v-data-table
    :headers="headers"
    :items="students"
    sort-by="id"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Student</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">

          <v-card>
            <v-card-title>
              <span class="headline">Project Data</span>
            </v-card-title>

            <v-card-text>
          <v-container>
              <div><span>By doing this, you will approve the final marking</span></div>
          </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Close</v-btn>
              <v-btn color="blue darken-1" text v-on:click="confirm(ViewData.id)">Approve</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
    <v-btn style="width:110px;" v-if="item.mark1 != null && item.mark2 != null && item.approved != 1" color="primary" small dark @click.stop="approve(item)">Approve</v-btn>
    <v-btn style="width:110px;" v-if="item.approved == 1" color="primary" small dark>Disapproved</v-btn>
    <v-btn style="width:110px;" v-if="item.mark1 == null || item.mark2 == null" color="error" small dark>Not Available</v-btn>
    </template>
  </v-data-table>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      headers: [
        {
          text: 'Name',
          align: 'start',
          sortable: false,
          value: 'name',
        },
        { text: 'Matric No*', value: 'uniqueid' },
        { text: 'Mark (%) (Supervisor)*', value: 'mark1' },
        { text: 'Mark (%) (Examiner)*', value: 'mark2' },
        { text: 'Total (%)', value: 'total' },
        { text: 'Actions', value: 'actions' },
      ],
      test: [],
      editedIndex: -1,
      ViewData: [{
        name: '',
        email: 0,
        role: 0,
      }],
      defaultItem: {
        name: '',
        email: 0,
        role: 0,
      },
      students: [],
    }),

    created () {
      axios.get('http://192.168.126.150/api/evaluation')
      .then(response => {
          this.students = response.data;
      });
    },

    methods: {
    // REPLACED
      approve (item) {
        this.ViewData = Object.assign({}, item)
        console.log(item)
        this.dialog = true
      },
      confirm(e) {
        axios.post('http://192.168.126.150/api/approve/'+e)
        .then(response => {
            console.log(response.data);
            this.$router.go();
        });
      },

      close () {
        this.dialog = false
      },
    },
  }
</script>