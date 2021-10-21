<template>
    <app-image :url="image" :alt="campaign.name" v-bind="$attrs" />
</template>

<script>
import { defineComponent } from 'vue';
import AppImage from '@/App/Image.vue';

export default defineComponent({
    name: "CampaignAvatar",
    components: {
        AppImage
    },
    props: {
        campaign: Object
    },
    computed: {
        image() {
            if(!this.campaign) return null;
            if(!this.campaign.creatives || !this.campaign.creatives.length) return null;

            return this.campaign.creatives[0];
        }
    }
})
</script>
