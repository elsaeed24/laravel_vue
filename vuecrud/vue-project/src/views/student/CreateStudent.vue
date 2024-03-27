
<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h4>
         Add Students
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
          <button type="button" @click="saveStudent" class="btn btn-primary" >Save</button>
        </div>
      </div>
    </div>
  </div>

</template>
<script>
import axios from "axios";
export default {
  name:"studentCreate",
  data(){
    return{
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
  // mounted() {
  //   // console.log('i am here')
  //   this.getStudents();
  // },
  methods:{
    saveStudent(){
      var mythis = this;
      axios.post('http://localhost:8000/api/store_student', this.model.student).then(res => {

        console.log(res.data)
        alert(res.data.msg)

        this.model.student = {
          name:"",
          phone:"",
          address:"",
          email:"",
          course_id:""
        }
        this.errorList = ''

      })
          .catch(function (error){
            if (error.response) {

              if (error.response.status === 422){
                mythis.errorList = error.response.data.errors
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