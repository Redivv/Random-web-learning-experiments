import Vue from "vue";

Vue.component('coupon',{
    props: ['code'],
    template: `
        <input type="text" :value="code" @input="updateCode($event.target.value)" ref="input">
    `,

    data(){
        return {
            invalids: ['ALLFREE','KEKPENIS']
        };
    },

    methods: {
        updateCode(code){
            if (this.invalids.includes(code)) {
                alert("frajer");

                this.$refs.input.value = code = '';
            }

            this.$emit('input',code);
        }
    },
});


new Vue({
    el: "#app",


    data: {
        code: "FREE"
    }
});

let userData = {
    user:{
        name: "kek",
    }
};

new Vue({
   el: "#one",
   
   data: userData
});

new Vue ({
    el: "#two",

    data: userData
});