Vue.component('tabs',{
    template: `
        <div>
            <div class="tabs">
                <ul>
                    <li v-for="tab in tabs" :class="{'is-active' : tab.isActive}">
                        <a :href="tab.href" @click="selectTab(tab)">
                            {{tab.name}}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tabs-details"
                <slot></slot>
            </div>
        </div>
    `,

    data(){
        return { tabs: [],};
    },

    // mounted(){
    //     console.log(this.$children);
    // }

    methods:{
        selectTab(){
            alert('peeeeeeeeeeeeeeenis');
        }
    },

    created(){
        this.tabs = this.$children;
    },

    methods:{
        selectTab(selectedTab){
            this.tabs.forEach(tab => {
                tab.isActive = (tab.name == selectedTab.name);
            });
        }
    },
});

Vue.component('tab',{
    props:{
        name: {required: true},
        selected: {default: false}
    },

    data(){
        return {
            isActive: false,
        };
    },


    computed: {
        href(){
            return "#" + this.name.toLowerCase().replace(/ /g,'-');
        }
    },

    mounted(){
        this.isActive = this.selected
    },

    template: `
        <div v-show="isActive">
            <slot></slot>
        </div>
    `,
})

let kek = new Vue({
    el: "#root",
});