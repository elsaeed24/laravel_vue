import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import StudentView from '../views/student/View.vue'
import CreateStudent from '../views/student/CreateStudent.vue';
import UpdateStudent from "../views/student/UpdateStudent.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/students',
      name: 'students',
      component: StudentView
    },

    {
      path: '/students/create',
      name: 'createStudents',
      component: CreateStudent
    },
    {
      path: '/students/:id/edit',
      name: 'updateStudents',
      component: UpdateStudent
    },
  ]
})

export default router
