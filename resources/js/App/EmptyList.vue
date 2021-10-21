<template>
    <div class="text-center p-5">
        <div class="empty-list-container" :style="`background-size: ${size}`">
        </div>
        <div class="text-gray-500 text-lg mt-2">
            {{ message }}
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name: "AppEmptyList",
    
    props: {
        message: {
            type: String,
            default: () => 'Nothing is here'
        },
        size: {
            type: String,
            default: () => '400px 200px'
        }
    },
    
})
</script>

<style>
    .empty-list-container{
        background-image: url('../../assets/images/empty-list-bg.png');
        background-repeat: no-repeat;
        background-position: center center;
        height: 200px;
    }
</style>