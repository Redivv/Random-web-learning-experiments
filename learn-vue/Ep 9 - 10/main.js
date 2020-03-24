Vue.component('message',{
    props: ['title','body'],

    data(){
        return {
            messageIsVisible: true,
        };
    },

    template: `
        <article class="message" v-show="messageIsVisible">
            <div class="message-header">
                <p>
                    {{ title }}
                </p>
                <button class="delete" @click="hideMessage" aria-label="delete"></button>
            </div>
            <div class="message-body">
                {{ body }}
            </div>
        </article>
    `,

    methods: {
        hideMessage(){
            this.messageIsVisible = !this.messageIsVisible;
        }
    }
});

Vue.component('modal',{
    template: `
        <div class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <p>
                        <slot></slot>
                    </p>
                </div>
            </div>
            <button @click="$emit('close')" class="modal-close is-large" aria-label="close"></button>
        </div>
    `,
});



let app = new Vue({
    el: "#root",

    data:{
        showModal: false,
    }
});