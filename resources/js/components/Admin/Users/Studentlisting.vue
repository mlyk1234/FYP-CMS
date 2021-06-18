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
            <v-row>
              <v-text-field label="Project Title" v-model="ViewData.project_title" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Basic Skill" v-model="ViewData.basic_skill" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Problem Statement" v-model="ViewData.problem_statement" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Objective" v-model="ViewData.objective" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Project Outcome" v-model="ViewData.project_outcome" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Project Description" value="HI" v-model="ViewData.project_description" readonly></v-text-field>
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
    <v-btn style="width:110px;" v-if="item.project_title != null" color="primary" small dark @click.stop="editItem(item)">View Project</v-btn>
    <v-btn style="width:110px;" v-if="item.project_title == null" color="error" small dark>Not Available</v-btn>
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
        { text: 'Email', value: 'email' },
        { text: 'Major', value: 'major' },
        { text: 'Supervisor', value: 'supervisor' },
        { text: 'Examiner', value: 'examiner' },
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
      axios.get('http://192.168.126.150/api/student')
      .then(response => {
          this.students = response.data;
      });
    },

    methods: {
    // REPLACED
      editItem (item) {
        this.ViewData = Object.assign({}, item)
        console.log(item)
        this.dialog = true
      },

      close () {
        this.dialog = false
      },
    },
  }
</script>