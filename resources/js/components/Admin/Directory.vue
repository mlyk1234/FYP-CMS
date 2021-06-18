<template>
  <v-data-table
    :headers="headers"
    :items="test"
    sort-by="id"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Student List</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">

          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                  </v-col>
                  <v-col cols="14" sm="6" md="6">
                    <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                  </v-col>
                </v-row>
                <v-row cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.project_title" label="Project Title"></v-text-field>
                </v-row>
                <v-row cols="12" sm="6" md="4">
                    <v-textarea auto-grow rows="1" loading v-model="editedItem.project_description" label="Project Title"></v-textarea>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Proceed</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-btn v-if="item.examiner == null"
        small
        class="mr-2"
        @click="editItem(item)"
      >
        Examine
      </v-btn>
      <v-btn v-else
        small
        disabled
        class="mr-2"
        @click="editItem(item)"
      >
        Not Available
      </v-btn>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize">Reset</v-btn>
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
        { text: 'Email', value: 'email' },
        { text: 'Matric No.', value: 'uniqueid' },
        { text: 'Major', value: 'major' },
        { text: 'Project Title', value: 'project_title' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      test: [],
      editedIndex: 0,
      editedItem: [{
        name: '',
        email: 0,
        role: 0,
      }],
      defaultItem: {
        name: '',
        email: 0,
        role: 0,
      },
    }),

    computed: {
      formTitle () {
        return 'Examine this student'
      },
      currentUser: {
        get() {
          return this.$store.state.currentUser.user;
        }
      }
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
    // REPLACED
    initialize() {
        axios.get("/api/v1/liststudent")
        .then(response => ( this.test = response.data ) )
    },
 

      editItem (item) {
        this.editedIndex = this.test.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.test.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.test.splice(index, 1)
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
          axios.post('api/v1/user/examine/'+ this.editedItem.studentid
          ).then(response => {
                this.response = JSON.stringify(response, null, 2);
          })

        if (this.editedIndex > -1) {
          Object.assign(this.test[this.editedIndex], this.editedItem)

        } else {
          this.test.push(this.editedItem)

        }
        this.close()
      },
    },
  }
</script>