<template>
  <div>
    <v-card class="pa-5">
      <v-responsive :aspect-ratio="16/9">
        <v-card-text>
        <h3>Data Saved for Review</h3>
          <div v-for="preset in presets">
<!-- -------------------------------------------------------------------------- -->
                <v-text-field 
                v-model="editForm.project_title"
                label="Project Title"
                placeholder="project_title"
                required 
                v-if="edit"
                ></v-text-field>

                <v-text-field
                v-model="preset.project_title"
                label="Project Title"
                readonly
                v-else
                ></v-text-field>
<!-- -------------------------------------------------------------------------- -->
                <v-text-field 
                v-model="editForm.basic_skill"
                label="Basic Skill"
                placeholder="Basic Skill"
                required 
                v-if="edit"
                ></v-text-field>

                <v-textarea
                :value="preset.basic_skill"
                label="Basic Skill"
                readonly
                rows="1"
                row-height="15"
                v-else
                ></v-textarea>
<!-- -------------------------------------------------------------------------- -->
                <v-textarea
                v-model="editForm.problem_statement"
                label="Problem Statement"
                placeholder="Problem Statement"
                required
                rows="1"
                v-if="edit"
                ></v-textarea>                
                
                <v-textarea
                :value="preset.problem_statement"
                label="Problem Statement"
                readonly
                rows="1"
                row-height="15"
                v-else
                ></v-textarea>
<!-- -------------------------------------------------------------------------- -->
                <v-textarea
                v-model="editForm.objective"
                label="Objective"
                placeholder="Objective"
                required
                rows="1"
                v-if="edit"
                ></v-textarea> 

                <v-textarea
                :value="preset.objective"
                label="Objective"
                readonly
                rows="1"
                row-height="15"
                v-else
                ></v-textarea>
<!-- -------------------------------------------------------------------------- -->
                <v-textarea
                v-model="editForm.project_outcome"
                label="Project Outcome"
                placeholder="Project Outcome"
                required
                rows="1"
                v-if="edit"
                ></v-textarea> 

                <v-textarea
                :value="preset.project_outcome"
                label="Project Outcome"
                readonly
                rows="1"
                row-height="15"
                v-else
                ></v-textarea>
<!-- -------------------------------------------------------------------------- -->
                <v-textarea
                v-model="editForm.project_description"
                label="Project Description"
                placeholder="Project Description"
                required
                v-if="edit"
                ></v-textarea> 

                <v-textarea
                :value="preset.project_description"
                label="Project Description"
                readonly
                rows="1"
                row-height="15"
                v-else
                ></v-textarea>
<!-- -------------------------------------------------------------------------- -->
                <v-select
                v-model="editForm.supervisor"
                :items="supervisors"
                item-text="name"
                item-value="id"
                :rules="[v => !!v || 'Item is required']"
                label="Supervisor"
                required
                v-if="edit"
                ></v-select>

                <v-select
                :value="preset.supervisorname"
                :items="preset.supervisorname"
                :rules="[v => !!v || 'Item is required']"
                label="Supervisor"
                readonly
                v-else
                ></v-select>
<!-- -------------------------------------------------------------------------- -->
                </div>

                <v-btn
                color="success"
                class="mr-4"
                @click="editData"
                >
                Edit
                </v-btn>

                <v-btn
                color="success"
                class="mr-4"
                @click="save"
                v-if="edit"
                >
                Save
                </v-btn>
        </v-card-text>
      </v-responsive>
    </v-card>
  </div>
</template>

<script>
export default {
    props:['student'],  
    data() {
        return {
            edit: false,
            presets: [],
            editForm: {            
                project_title: '',
                basic_skill: '',
                problem_statement: '',
                objective: '',
                project_outcome: '',
                project_description: '',
                supervisor: '',
            },
            supervisors: [],
        }
    },
    created() {
        axios.get('/api/v1/user/project-data')
        .then( response => ( this.presets = response.data ) );

        axios.get('/api/v1/user/fillsupervisor')
        .then( response => ( this.supervisors = response.data ) );
    },
    computed: {
      nameString() {
        return this.presets.project_title
      }
    },
    methods: {
        editData() {
            this.edit = true;
            this.editForm.project_title = this.presets[0].project_title;
            this.editForm.basic_skill = this.presets[0].basic_skill;
            this.editForm.problem_statement = this.presets[0].problem_statement;
            this.editForm.objective = this.presets[0].objective;
            this.editForm.project_outcome = this.presets[0].project_outcome;
            this.editForm.project_description = this.presets[0].project_description;
            this.editForm.supervisor = this.presets[0].supervisor;
        },
        cancelEdit() {
            this.edit = false;
            this.editForm.project_title = '';
            this.editForm.basic_skill = '';
            this.editForm.problem_statement = '';
            this.editForm.objective = '';
            this.editForm.project_outcome = '';
            this.editForm.project_description = '';
            this.editForm.supervisor = '';
        },
        save() {
            axios.post('/api/v1/user/project-data',{
                project_title: this.editForm.project_title,
                basic_skill: this.editForm.basic_skill,
                problem_statement: this.editForm.problem_statement,
                objective: this.editForm.objective,
                project_outcome: this.editForm.project_outcome,
                project_description: this.editForm.project_description,
                supervisor: this.editForm.supervisor,
            }).then(response => {
                this.cancelEdit();
                this.response = JSON.stringify(response, null, 2);
                
                //this.presets = this.data;
                window.location.reload();
            }).catch(error => {
                this.response = 'Error: ' + error.response.status
            })
        }
    },
}
</script>

