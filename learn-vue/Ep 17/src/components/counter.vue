<template>
    <div>
        <h2>Count is: {{ count }}</h2>

        <button @click="count += 1">Go up</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            count: 0
        };
    },
}
</script>