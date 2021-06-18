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
        <v-btn color="primary" dark v-on:click="editItem(item)">Evaluate</v-btn>
    </template>
  </v-data-table>
  </v-card>

  <v-row justify="center">
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-card id="restart">
        <v-toolbar dark color="primary">
          <v-btn icon dark @click="dialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>Close</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark text @click="save">Save</v-btn>
          </v-toolbar-items>
        </v-toolbar>
            <v-btn
            fab
            dark
            fixed
            bottom
            right
            color="primary"
            @click="toTop"
          >
            <v-icon>keyboard_arrow_up</v-icon>
          </v-btn>
        <v-list>
          <v-subheader ><h3>Student ID: {{editedItem.name}}</h3><h3 class="ml-4">Matric No.: {{editedItem.uniqueid}}</h3></v-subheader>
          <v-list-item>
              <v-card width="100%" class="d-flex justify-center mb-6">
                  
              <!-- Evaluate -->
              <evaluationform :editedItem="editedItem"></evaluationform>
              
              <!-- Evaluate -->
              <v-card height="210" width="200"> 
                  <v-card-text>
                    Total marks allotted: 
                    <v-card-text class="pa-1"><h4>{{marks}}/100 (%)</h4></v-card-text>
                    <v-card-text class="pa-1"><v-btn color="primary" elevation="2" @click="submit(editedItem.id,marks)">Submit</v-btn></v-card-text>
                    <small>Please confirm that all the marks given are correct. Click "Confirm" to submit the final markings</small>
                  </v-card-text>
              </v-card>
              </v-card>
          </v-list-item>

        </v-list>
        <v-divider></v-divider>
      </v-card>
    </v-dialog>
  </v-row>
</div>
</template>

<script>
import evaluationform from './evaluationform.vue'
  export default {
  components: { evaluationform },
    data () {
      return {
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
        dialog: false,
        notifications: false,
        sound: true,
        widgets: false,
                students: [],
        editedIndex: -1,
        editedItem: [{
          name: 'Sleep',
          email: '',
          role: '',
          supervisor: 'sa'
        }],
        marks: 0,
      }
    },
    created() {
        this.initialize();
    },
    methods: {
    // REPLACED
      initialize() {
          axios.get('api/v1/user/supervised')
          .then(response => { 
              this.students = response.data
           } )
      },
      editItem (item) {
        this.editedIndex = this.students.indexOf(item);
        console.log('passed');
        this.editedItem = Object.assign({}, item);
        axios.get('api/v1/supervisor/total/'+item.studentid)
        .then( res => {
            this.marks = res.data;
        })
        this.dialog = true;
      },
      submit(id,m){
        confirm('Are you sure you want to delete this item?')
        axios.post('api/v1/user/submitbysupervisor/'+id+'/'+m)
        .then(response => {
            console.log(response.data);
        })
      },
      save(){
          this.$router.go();
          this.dialog = false;
      },

      toTop () {
            document
            .getElementById("restart")
            .scrollIntoView({ behavior: "smooth" });
      }
    }
  }
</script>