Vue.component('progress-view',{
    data(){
        return {
            completionRate: 0,
        };
    }
});

let app = new Vue({
    el: "#root",
});