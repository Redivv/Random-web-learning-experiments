window.Event = new Vue();

Vue.component('modal',{
    template: `
    <div>
        <div class="modal" :class="{'is-active': visibleModal}">
            <div class="modal-background"></div>
            <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    <slot name="header"></slot>
                </p>
                <button @click="visibleModal = false" class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <slot name="mainContent"></slot>
            </section>
            <footer class="modal-card-foot">
                <slot name="footer">
                    <button class="button is-success">Yas Bitch</button>
                </slot>
            </footer>
            </div>
        </div>

        <button @click="visibleModal = true"> Open Modal </button>
    </div>
    `,

    data(){
        return {
            visibleModal: false,
        };
    }
});

let app = new Vue({
    el: "#root",
});