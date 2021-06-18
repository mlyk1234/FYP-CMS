<template>
  <v-data-table
    :headers="headers"
    :items="lecturer"
    sort-by="id"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Lecturer</v-toolbar-title>
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
            <v-row>
              <v-text-field label="Supervised" v-model="ViewData.list_s" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Examine" v-model="ViewData.list_e" readonly></v-text-field>
            </v-row>
          </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Close</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-btn v-if="item.supervise != 0 || item.examine != 0" style="width:110px;" color="primary" small dark @click.stop="editItem(item)">Detailed</v-btn>
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
        { text: 'Staff ID*', value: 'uniqueid' },
        { text: 'Email', value: 'email' },
        { text: 'Supervise', value: 'supervise' },
        { text: 'Examine', value: 'examine' },
        { text: 'View', value: 'actions'}
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
      lecturer: [],
    }),

    created () {
      axios.get('http://192.168.126.150/api/lecturer')
      .then(response => {
          this.lecturer = response.data;
      });
    },

    methods: {
    // REPLACED
      editItem (item) {
        this.ViewData = Object.assign({}, item)
        var s = Object.assign({}, item.list_s)
        console.log(s)
        this.dialog = true
      },

      close () {
        this.dialog = false
      },
    },
  }
</script>