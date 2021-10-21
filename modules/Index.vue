<template>
    <app-layout title="Home">
        <div class="flex items-center justify-center mt-20">
            <div class="w-full sm:w2/3 md:w-1/3 p-10">
                <app-logo class="w-full" />
                <h1 class="text-right font-bold text-2xl">SSP</h1>
            </div>
        </div>
    </app-layout>
</template>


<script>
    import { defineComponent } from 'vue';
    import AppLayout from '@/Layouts/AppLayout.vue'
    import AppLogo from '@/App/Logo.vue';

    export default defineComponent({
        components: {
            AppLogo,
            AppLayout
        }
    })
</script>
