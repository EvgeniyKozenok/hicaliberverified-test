<template>
    <div>{{ hello }}</div>
</template>

<script>
export default {
    name: "DeveloperTest",
    data() {
        return {
            hello: 'Hello from Vue',
        }
    },
    beforeMount() {
        console.log(this.hello);
    }
}
</script>

<style scoped>

</style>
