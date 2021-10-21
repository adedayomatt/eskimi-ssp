<template>        
    <div 
    :style="`background-image: url(${creative})`"
    class="bg-center bg-cover bg-no-repeat"
    v-bind="$attrs"
    @click="$emit('zoom', creative)"
    >
        <div v-if="$slots.actions" class="flex justify-end overflow-x-auto" style="background-color: rgba(0,0,0,.3)">
            <slot name="actions" />
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name: "CampaignCreative",

    props: {
        creative: String
    },

    data(){
        return {
            zoom: false
        }
    }
})
</script>
