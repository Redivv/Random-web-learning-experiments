<template>
    <div class="container">

        <div class="columns">

            <div class="column">

                <div class="message" v-for="status in statuses">

                    <div class="message-header">
                        <p>
                            {{status.user.name}} pedział...
                        </p>

                        <p>
                            {{status.created_at | ago | uppercase}}
                        </p>
                    </div>

                    <div class="message-body" v-text="status.body"></div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    data() {
        return {
            statuses: [],
        };
    },

    filters:{
        ago(timestamp){
            return moment(timestamp).fromNow();
        },

        uppercase(string){
            return string.toUpperCase();
        }
    },

    created(){
        axios.get('/statuses')
            .then(response => this.statuses = response.data);
    },
}
</script>