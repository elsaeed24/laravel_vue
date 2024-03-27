
<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>
          Students
          <RouterLink to="/students/create" class="btn btn-primary float-end">Add Student</RouterLink>
        </h4>
      </div>

      <div class="card-body">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
          </thead>

          <tbody v-if="this.students.length > 0">
          <tr v-for="(student,index) in  this.students" :key="index">

            <td>{{ student.id }}</td>
            <td>{{ student.name }}</td>
            <td>{{ student.course_id }}</td>
            <td>{{ student.email }}</td>
            <td>{{ student.phone }}</td>
            <td>{{ student.created_at }}</td>
            <td>
              <RouterLink :to="{ path:'/students/'+ student.id + '/edit'}" class="btn btn-success">Edit</RouterLink>
              <button type="button" @click="deleteStudent(student.id)" class="btn btn-danger" style="margin-left: 10px;">Delete</button>
            </td>
          </tr>
          </tbody>
          <tbody v-else>
          <tr>
            <td colspan="7">Loading....</td>
          </tr>

          </tbody>

        </table>



      </div>
    </div>
<!--    <Bootstrap5Pagination-->
<!--        :data="this.students"-->
<!--        @pagination-change-page="getStudents"-->
<!--    />-->
    <Bootstrap5Pagination
        :data="students"
         @pagination-change-page="getStudents"
    />
  </div>


</template>
<script>
import axios from "axios";
import { Bootstrap5Pagination } from 'laravel-vue-pagination';

export default {
  name:"students",
  components: {
    Bootstrap5Pagination
  },
  data(){
    return{
      students: [],// Initialize with empty data and default pagination values


    }
  },
  mounted() {
    // console.log('i am here')
    this.getStudents();
  },
  methods:{
    // getStudents(){
    //   axios.get('http://localhost:8000/api/fetch_student').then(res => {
    //     console.log(res.data); // Log the response to inspect its structure
    //     this.students = res.data.students;
    //     // console.log(this.students);
    //   });
    // },

    getStudents(page = 1) {
      axios.get(`http://localhost:8000/api/fetch_student?page=${page}`).then(res => {
        console.log(res.data);
        this.students = res.data.students;
      });
    },

    deleteStudent(studentId){
      if (confirm('Are You Sure , You Want To Delete This Data?')){
        // console.log(studentId)
        axios.delete(`http://localhost:8000/api/student/${studentId}/delete`).then(res => {
          // this.students = res.data.students
          // console.log(this.students)
          alert(res.data.msg)
          this.getStudents();

        });
      }

    }

  }
}

</script>