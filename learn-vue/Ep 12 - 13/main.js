window.Event = new Vue();

Vue.component('coupon',{
    template: `<input placeholder="FUCK YOU" @blur="applyCoupon">`,

    methods:{
        applyCoupon(){
            // this.$emit('applied');
            Event.$emit('applied');
        }
    }
});

let app = new Vue({
    el: "#root",

    data:{
        couponApplied: false
    },

    methods:{
        appliedCoupon(){
            this.couponApplied = true;
        }
    },

    created(){
        Event.$on('applied',() => alert('pierdol się'));
    }
});