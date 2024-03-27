
<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h4>
         Update Student
          <RouterLink to="/students" class="btn btn-primary float-end">Show All Student</RouterLink>
        </h4>
      </div>

      <div class="card-body">
        <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
          <li class="mb-0 ms-3" v-for="(error,index) in this.errorList" :key="index">
            {{ error[0] }}
          </li>
        </ul>
      <div class="mb-3">
        <label for="">Name</label>
        <input type="text" v-model="model.student.name" class="form-control">
      </div>
        <div class="mb-3">
          <label for="">Email</label>
          <input type="text" v-model="model.student.email" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">Phone</label>
          <input type="text" v-model="model.student.phone" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">Address</label>
          <input type="text" v-model="model.student.address" class="form-control">
        </div>
        <div class="mb-3">
          <label for="">Course</label>
          <input type="text" v-model="model.student.course_id" class="form-control">
        </div>
        <div class="mb-3">
          <button type="button" @click="updateStudent" class="btn btn-primary" >Update</button>
        </div>
      </div>
    </div>
  </div>

</template>
<script>
import axios from "axios";
export default {
  name:"studentUpdate",
  data(){
    return{
      studentId:'',
      errorList : '',
      model:{
        student:{
          name:"",
          phone:"",
          address:"",
          email:"",
          course_id:""
        }
      }
    }
  },
  mounted() {
    // console.log(this.$route.params.id);
    this.studentId = this.$route.params.id;
    this.getStudentsData(this.$route.params.id);
  },
  methods:{
    getStudentsData(studentId){
      axios.get(`http://localhost:8000/api/student/${studentId}/show`).then(res => {
          console.log(res.data.students);

          // this.model.student.name = res.data.students.name
        this.model.student = res.data.students
      })
          .catch(function (error){
            if (error.response) {

              if (error.response.status === 404){
                // mythis.errorList = error.response.data.errors
                alert( error.response.data.message)
              }
            }
          })
    },
    updateStudent(){
      var mythis = this;
      axios.put(`http://localhost:8000/api/student/${ this.studentId}/update`, this.model.student).then(res => {

        console.log(res.data)
        alert(res.data.msg)

        this.errorList = ''

      })
          .catch(function (error){
            if (error.response) {

              if (error.response.status === 422){
                mythis.errorList = error.response.data.errors
              }
              if (error.response.status === 404){
                // mythis.errorList = error.response.data.errors
                alert( error.response.data.message)
              }
              // console.log(error.response.data);
              // console.log(error.response.status);
              // console.log(error.response.headers);
            } else if (error.request) {
              // The request was made but no response was received
              // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
              // http.ClientRequest in node.js
              console.log(error.request);
            } else {
              // Something happened in setting up the request that triggered an Error
              console.log('Error', error.message);
            }
          })
    }

  }
}
</script>