class Errors{
  constructor(){
    this.errors = {};
  }

  has(field){
    return this.errors.hasOwnProperty(field);
  }

  any(){
    return Object.keys(this.errors).length > 0;
  }

  get(field){
    if (this.errors[field]) {
      return this.errors[field][0];
    }
  }

  record(errors){
    this.errors = errors.errors;
  }

  clear(field){
    if(field) {
      delete this.errors[field];
    }else{
      this.errors = {};
    }
  }
}

class Form{
  constructor(data) {
    this.originalData = data;

    for (let field in data) {
      this[field] = data[field];
    }

    this.errors = new Errors();
  };

  reset(){

    for (let field in this.originalData) {
      this[field] = '';
    }

    this.errors.clear();
  };
  
  data(){
    let data = Object.assign({},this);

    delete data.errors;
    delete data.originalData;

    return data;
  }

  submit(method,endpoint){
    return new Promise( (resolve, reject) => {

      axios[method](endpoint,this.data())
        .then(response => {
          this.onSuccess(response.data);

          resolve(response.data);
        })
        .catch(error => {
          this.onFail(error.response.data);

          reject(error.response.data);
        });

    });
  }

  onSuccess(responseData){
    alert(responseData.message);

    this.reset();
  }

  onFail(errorData){
    this.errors.record(errorData);
  }
}

// new Vue({
//   el:"#root",

//   data:{
//     skills: [],
//   },


//   mounted() {
//     axios.get('/skills').then(response => this.skills = response.data);
//   },
// });

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