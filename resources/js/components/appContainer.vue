<template>
<div id="app">
  <v-app id="inspire">
    <v-app id="inspire">
      <v-navigation-drawer
        v-model="drawer"
        app
      >
      <v-subheader style="padding-top:95px;padding-bottom:95px;padding-left:30px"><v-img :src="'/images/fyp-icon.png'"/></v-img></v-subheader>
      <v-divider></v-divider>
      <div></div>
      
        <v-list dense>
        <div v-if="currentUser.role == 3">
          <v-list-item to="/superuser" link>
            <v-list-item-action>
              <v-icon>mdi-chart-arc</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>
        <div v-if="currentUser.role == 1">
          <v-list-item to="/profile-student" link>
            <v-list-item-action>
              <v-icon>mdi-chart-arc</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Profile</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>

        <div v-if="currentUser.role == 2">
          <v-list-item :to="{ name: 'profile-admin', params: {currentUser}}" link>
            <v-list-item-action>
              <v-icon>mdi-chart-arc</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Profile</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>

        <div v-if="currentUser.role == 1">
          <v-list-item to="/student-dashboard" link>
            <v-list-item-action>
              <v-icon>mdi-chart-arc</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>

        <div v-if="currentUser.role == 2">
          <v-list-item to="/admin-dashboard" link>
            <v-list-item-action>
              <v-icon>mdi-chart-arc</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>
      <!-- STUDENT Project Submitter -->
        <v-divider></v-divider>
        <div v-if="currentUser.role == 1">
          <div v-if="savedget == 0">
          <v-list-item to="/project-data" link>
            <v-list-item-action>
              <v-icon>mdi-chart-arc</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Project Data</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          </div>
          
          <div v-else-if="savedget == 1">
          <v-list-item to="/update-data" link>
            <v-list-item-action>
              <v-icon>mdi-chart-arc</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Project Review</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          </div>
        
        </div>
      <!-- END OF STUDENT Project Submitter -->
    
      <!-- Lecturer Section -->
        <div v-if="currentUser.role == 2">
        <v-divider></v-divider>
        
          <v-list-item disabled>
            <v-list-item-action>
              <v-icon>mdi-toolbox-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Student (For lecturer)</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item to="/supervised" link>
            <v-list-item-action>
              <v-icon>mdi-account</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>My Supervision</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item to="/examine" link>
            <v-list-item-action>
              <v-icon>mdi-account</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Examine</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item to="/directory" link>
            <v-list-item-action>
              <v-icon>mdi-account</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Directory</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>

        <v-divider></v-divider>
        <div v-if="currentUser.role == 3">
          <v-list-item to="/student" link>
            <v-list-item-action>
              <v-icon>mdi-account</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Student</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item to="/lecturer" link>
            <v-list-item-action>
              <v-icon>mdi-account</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Lecturer</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>

        <div v-if="currentUser.role == 1">
          <v-list-item to="/submission" link>
            <v-list-item-action>
              <v-icon>mdi-cloud-upload-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Submission</v-list-item-title>
            </v-list-item-content>
          </v-list-item> 
        </div>

        <div v-if="currentUser.role == 2">
          <v-list-item to="/submission-list" link>
            <v-list-item-action>
              <v-icon>mdi-cloud-upload-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Submission</v-list-item-title>
            </v-list-item-content>
          </v-list-item> 
        </div>

        <v-divider></v-divider>
      <!-- Superuser Evaluation -->
        <div v-if="currentUser.role == 3 || currentUser.role == 2">
          <v-list-item to="/evaluatelist" link>
            <v-list-item-action>
              <v-icon>mdi-ticket-percent-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Evaluation Form FYP1</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>
      <!-- END OF Superuser Evaluation -->
      <v-divider></v-divider>
          <v-list-item disabled>
            <v-list-item-action>
              <v-icon>mdi-toolbox-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Tools</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

        <div v-if="currentUser.role == 1">
          <v-list-item to="/todo" link>
            <v-list-item-action>
              <v-icon>mdi-chart-gantt</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>To Do</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>

        <div v-if="currentUser.role == 2">
          <v-list-item to="/todo-admin" link>
            <v-list-item-action>
              <v-icon>mdi-chart-gantt</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>To Do</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>

        <!-- Gantt Chart for READONLY -->
        <div v-if="currentUser.role == 1 || currentUser.role == 2">
          <v-list-item to="/gantt" link>
            <v-list-item-action>
              <v-icon>mdi-chart-gantt</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Gantt</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>
        <!-- Gantt Chart for READONLY -->
        <!-- Gantt Chart for Superuser -->
        <div v-if="currentUser.role == 3">
          <v-list-item :to="{ name: 'gantt2', params: {currentUser}}">
            <v-list-item-action>
              <v-icon>mdi-chart-gantt</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Gantt</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>
        <!-- Gantt Chart for Superuser -->

          <v-list-item to="/kanban-board">
            <v-list-item-action>
              <v-icon>mdi-bulletin-board</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Kanban</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

            <v-divider></v-divider>

          <v-list-item link @click="logout">
            <v-list-item-action>
              <v-icon>mdi-keyboard-esc</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Log Out {{ currentUser.email }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
  
      <v-app-bar
        app
        color="indigo"
        dark
      >
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>Application {{ loggedIn }}</v-toolbar-title>
      </v-app-bar>
  
      <v-main>
        <v-container>

        <!--<v-container
          class="fill-height"
          fluid
        >-->
            <router-view></router-view>

        </v-container>
                      <v-container style="position:relative">
              <v-img width="100%" src="/images/DmfB7DQXsAAOAVs.jpg"></v-img>
              <v-img style="position:absolute;top:15%;left:25%;width:50%" src="/images/fyp-icon.png"></v-img>
            </v-container>
      </v-main>
      <v-footer
        color="indigo"
        app
      >
        <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
      </v-footer>
    </v-app>
  </v-app>
</div>
</template>

<script>
const id = '';
    export default {
    props: {
        source: String,
    },
    data: () => ({
        drawer: null,
        show: false,
        resultad: 'yo',
        flags: "",
        saved: '',
        
    }),
    computed: {
        savedget : function () {
            return this.saved;
        },

        loggedIn: {
            get() {
                return this.$store.state.currentUser.loggedIn;
            }
        },
        currentUser: {
            get() {
                return this.$store.state.currentUser.user;
            }
        }
    },
    methods:  {

        logout() {
            this.$store.dispatch('currentUser/logoutUser');
        },

    },
    created() {
        if( localStorage.hasOwnProperty("fyp_token") ){
        axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("fyp_token");
        this.$store.dispatch('currentUser/getUser');

        axios.get('api/v1/user/project-flagger')
        .then( response => ( this.saved = response.data ) );

        } else if (localStorage.getItem("fyp_token") !== "undefined"){
            window.location.replace("/login"); // not working - issue on wrong login still
        } 
        else {
            window.location.replace("/login");
        }
    }
}
</script>
