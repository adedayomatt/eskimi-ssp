<template>
    <div>
        <h4 class="text-gray-500 text-sm">{{ label }}</h4>
        <p class="">{{ value }}</p>
    </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    name: "AppFieldDisplay",
    props: {
            label: String,
            value: String
        },
})
</script>
