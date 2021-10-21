<template>
    <img v-if="url" :src="url" v-bind="$attrs">
    <img v-else src="../../assets/images/placeholder.jpg" v-bind="$attrs">
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name: "AppImage",
    props: {
        url: String
    },
})
</script>
