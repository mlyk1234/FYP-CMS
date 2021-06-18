import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//import Dashboard from "../components/dashboard/container"
import Profile from "../components/profile/summary.vue"
import ProfileAdmin from "../components/profile/summaryadmin.vue"
import DashboardSuperUser from "../components/Admin/mainboard.vue"
import DashboardAdmin from "../components/dashboard/mainboard.vue"
import DashboardStudent from "../components/dashboard-student/mainboard.vue"

// Evaluation
import EvaluationAdmin from "../components/Admin/Evaluate/categorised.vue"
// End of Evaluation

import ProjectData from "../components/SelectSupervisor.vue"
import UpdateProjectdata from "../components/UpdateProjectdata.vue"

import ManageTask from "../components/task/ManageTask.vue"
import ManageTaskAdmin from "../components/task/ManageTaskAdmin.vue"
import KanbanBoard from "../components/task/kanbanboard.vue"

import Supervised from "../components/Admin/Supervised.vue"
import Examine from "../components/Admin/Examine.vue"
import Directory from "../components/Admin/Directory.vue"

// Superuser
import Student from "../components/Admin/Users/Studentlisting.vue"
import Lecturer from "../components/Admin/Users/Lecturerlisting.vue"
import EvaluateList from "../components/Admin/Evaluate/All/Evaluate.vue"
// End of Superuser

import Task from "../components/task/container"
import Submission from "../components/submission/container-student"
import SubmissionList from "../components/submission/container-admin"
import Review from "../components/review/container"
import Simple from "../components/simpleform"
// Tools
import Gantt from "../components/tools/gantt2"
import Kanban from "../components/tools/kanban"

const routes = [
    {
        component: EvaluateList,
        name: "evaluatelist",
        path: "/evaluatelist",
    },
    {
        component: EvaluationAdmin,
        name: "evaluation",
        path: "/evaluation",
    },
    {
        component: Profile,
        name: "profile-student",
        path: "/profile-student",
    },
    {
        component: ProfileAdmin,
        name: "profile-admin",
        path: "/profile-admin",
        props: true,
    },
    {
        component: DashboardSuperUser,
        name: "superuser",
        path: "/superuser",
    },
    {
        component: DashboardAdmin,
        name: "admin-dashboard",
        path: "/admin-dashboard",
    },
    {
        component: DashboardStudent,
        name: "student-dashboard",
        path: "/student-dashboard",
    },
    {
        component: KanbanBoard,
        name: "kanban-board",
        path: "/kanban-board",
    },    
    {
        component: ProjectData,
        name: "project-data",
        path: "/project-data",
    },
    {
        component: UpdateProjectdata,
        name: "update-data",
        path: "/update-data",
    },
    {
        component: Supervised,
        name: "supervised",
        path: "/supervised",
    },
    {
        component: Examine,
        name: "examine",
        path: "/examine",
    },
    {
        component: Directory,
        name: "directory",
        path: "/directory",
    },
// Superuser
    {
        component: Student,
        name: "student",
        path: "/student"
    },
    {
        component: Lecturer,
        name: "lecturer",
        path: "/lecturer"
    },
// End of Superuser
    {
        component: Review,
        name: "review",
        path: "/review"
    },
    {
        component: Task,
        name: "task",
        path: "/task"
    },
    {
        component: Submission,
        name: "submission",
        path: "/submission"
    },
    {
        component: SubmissionList,
        name: "submission-list",
        path: "/submission-list"
    },
    {
        component: ManageTask,
        name: "todo",
        path: "/todo"
    },
    {
        component: ManageTaskAdmin,
        name: "todo-admin",
        path: "/todo-admin"
    },
    {
        component: Gantt,
        name: "gantt2",
        path: "/gantt",
        props: true,
    },
    {
        component: Kanban,
        name: "kanban",
        path: "/kanban"
    },
];

export default new VueRouter({
    routes //short for `routes: routes`
});
