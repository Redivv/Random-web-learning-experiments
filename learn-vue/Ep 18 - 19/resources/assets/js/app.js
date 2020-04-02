// new Vue({
//   el:"#root",

//   data:{
//     skills: [],
//   },


//   mounted() {
//     axios.get('/skills').then(response => this.skills = response.data);
//   },
// });

import Form from "./core/Form";
import Vue from 'vue';
import axios from 'axios';

window.Form = Form;

window.axios = axios;

new Vue({
    el:"#app",
  
    data:{
  
      form: new Form({
        name: '',
        desc: '',
      }),
  
    },
  
    methods: {
      fuckYeah(){
        this.form.submit('post','/projects')
          .then(data => console.log(data))
          .catch(error => console.log(error));
      },
    },
  
  });