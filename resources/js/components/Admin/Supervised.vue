<template>
<div>
  <v-card>
  <v-data-table
    :headers="headers"
    :items="students"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Supervised</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
      </v-toolbar>
    </template>

    <template v-slot:item.actions="{ item }">
    <v-btn color="primary" dark @click.stop="editItem(item)">View</v-btn>
    </template>
  </v-data-table>
  </v-card>

  <!-- -------------------------------------------------------------------------------------------------------- -->


    <v-dialog v-model="dialog" max-width="600px">
    <v-card>
        <v-card-title>
          <span class="headline">User Profile</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="editedItem.name" readonly></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="editedItem.uniqueid" readonly></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-text-field label="Project Title" v-model="editedItem.project_title" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Basic Skill" v-model="editedItem.basic_skill" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Problem Statement" v-model="editedItem.problem_statement" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Objective" v-model="editedItem.objective" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Project Outcome" v-model="editedItem.project_outcome" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field label="Project Description" value="HI" v-model="editedItem.project_description" readonly></v-text-field>
            </v-row>
            <v-row>
              <v-text-field v-if="editedItem.examiner == null" label="Examiner" value="Not assigned to any examiner" readonly></v-text-field>
              <v-text-field v-else label="Examiner" v-model="editedItem.examinername" readonly></v-text-field>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
        </v-card-actions>
    </v-card>
    </v-dialog>
    <!-- -------------------------------------------------------------------------------------------------------- -->
</div>


</template>

<script>
  export default {
    data () {
      return {
        dialog: false,
        search: '',
        headers: [
          {
            text: 'Student',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'Matric No', value: 'uniqueid' },
          { text: 'Major', value: 'major' },
          { text: 'Project Title', value: 'project_title' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        students: [],
        editedIndex: -1,
        editedItem: [{
          name: 'Sleep',
          email: '',
          role: '',
          supervisor: 'sa'
        }],
      }
    },
    created() {
        this.initialize()
    },
    methods: {
    // REPLACED
      initialize() {
          axios.get('api/v1/user/supervised')
          .then(response => ( this.students = response.data ) )
      },
      editItem (item) {
        this.editedIndex = this.students.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },
    }
  }
</script>