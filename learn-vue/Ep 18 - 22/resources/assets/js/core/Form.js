import Errors from "./Errors";

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

export default Form;