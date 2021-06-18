<template>
  <div>
    <v-card>
      <v-responsive :aspect-ratio="16/9">
        <v-card-text>
          Please fill in the form

                <v-text-field
                v-model="project_title"
                label="Project Title"
                required
                ></v-text-field>

                <v-textarea
                rows="1"
                v-model="basic_skill"
                label="Basic Skill"
                required
                ></v-textarea>

                <v-textarea
                rows="3"
                v-model="problem_statement"
                label="Problem Statement"
                required
                ></v-textarea>

                <v-textarea
                rows="3"
                v-model="objective"
                label="Objective"
                required
                ></v-textarea>

                <v-textarea
                rows="3"
                v-model="project_outcome"
                label="Project Outcome"
                required
                ></v-textarea>

                <v-textarea
                rows="3"
                v-model="project_description"
                label="Project Description"
                required
                ></v-textarea>

                <v-select
                v-model="supervisor"
                :items="supervisors"
                item-text="name"
                item-value="id"
                :rules="[v => !!v || 'Item is required']"
                label="Supervisor"
                required
                ></v-select>

                <v-btn 
                color="success"
                class="mr-4"
                @click="save"
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
    data() {
        return {
            project_title: '',
            basic_skill: '',
            problem_statement: '',
            objective: '',
            project_outcome: '',
            project_description: '',
            supervisor: '',
            supervisors: [],
        }
    },
    created() {
        axios.get('/api/v1/user/fillsupervisor')
        .then( response => ( this.supervisors = response.data ) );
    },
    methods: {
        save() {
            axios.post('/api/v1/user/project-data',{
                project_title: this.project_title,
                basic_skill: this.basic_skill,
                problem_statement: this.problem_statement,
                objective: this.objective,
                project_outcome: this.project_outcome,
                project_description: this.project_description,
                supervisor: this.supervisor,
            }).then(response => {
                this.response = JSON.stringify(response, null, 2);
                window.location.replace("http://192.168.1.5:8000/fyp#/update-data");
            }).catch(error => {
                this.response = 'Error: ' + error.response.status
            })
        }
    },
}
</script>

