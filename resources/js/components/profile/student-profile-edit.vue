<template>
  <div>
    <v-dialog v-model="dialog" persistent max-width="600px">

      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="primary"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Edit Profile
        </v-btn>
        <v-btn class="ml-1" color="primary" dark to="/update-data" link>
          Edit Project
        </v-btn>
      </template>

      <v-card>
        <v-card-title>
          <span class="headline">Edit Profile</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field v-model="items.name" label="Name" required></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field v-model="items.uniqueid" label="Matric No*" required></v-text-field>
              </v-col>
              <v-col cols="12">
                  <v-select
                    :items="majorlist"
                    label="Major"
                    v-model="items.major"
                  ></v-select>
              </v-col>
              <v-col cols="12">
                <v-text-field v-model="items.email" label="Email*" required></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" text @click="edit">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar
        v-model="snackbar"
        >
        Action Saved

        <template v-slot:action="{ attrs }">
            <v-btn
            color="pink"
            text
            v-bind="attrs"
            @click="snackbar = false"
            >
            Close
            </v-btn>
        </template>
        </v-snackbar>
  </div>
</template>

<script>
  export default {
    
    props: ['items'],
    data: () => ({
      dialog: false,
      snackbar: false,
      majorlist: ['Software Engineering', 'Network Computing', 'Multimedia Computing', 'Information System', 'Computere System'],
    }),
    methods: {
        edit() {
            axios.post('api/v1/user/editProfile', {
                name : this.items.name,
                email : this.items.email,
                major : this.items.major,
                uniqueid : this.items.uniqueid
            }).then(response => {
                
                this.$emit('itemchanged');
                this.dialog = false;
                this.snackbar = true;
                this.response = JSON.stringify(response, null, 2);
                
                //this.presets = this.data;
            }).catch(error => {
                this.response = 'Error: ' + error.response.status
            })
        }
    }
  }
</script>