Vue.component('tasks-list',{
    template: `
        <ul>
            <task v-for="task in tasks">
                {{task.desc}}
            </task>
        </ul>
    `,

    data(){
        return {
            tasks: [
                {desc: "kek", completed: true},
                {desc: "das", completed: true},
                {desc: "czx", completed: false},
                {desc: "keczxczk", completed: true},
                {desc: "kqwfqek", completed: false},
            ]
        };
    }
});

Vue.component('task',{
    template: `
        <li>
            <slot>

            </slot>
        </li>
    `,
});

new Vue({
    el: "#root"
});

