<template>
    <dialog-modal :show="modal" :closeable="true"  @close="close">
        <template #title>
           Campaign:  {{ campaign.name }}
        </template>

        <template #content>
            <div class="space-y-5">
                
                <div class="flex flex-wrap gap-2 items-center justify-center">
                    <campaign-creative
                    v-for="(creative, i) in campaign.creatives" :key="i"
                    :creative="creative"
                    :class="{'border-black border-2 h-32 w-32' : preview === creative, 'h-20 w-20': preview !== creative}"
                    @zoom="(c) => preview = c"
                    />
                </div>

                <div class="relative">
                    <button
                    v-if="previousIndex >= 0"
                    class="absolute left-0 text-white bg-black focus:outline-none shadow-lg p-1" 
                    title="Prevoius"
                    @click="preview = campaign.creatives[previousIndex]" 
                    >
                        <i class="fe fe-arrow-left text-white text-2xl"></i>
                    </button>
                    <button 
                    v-if="nextIndex >= 0"
                    class="absolute right-0 text-white bg-black focus:outline-none shadow-lg p-1" 
                    title="Next"
                    @click="preview = campaign.creatives[nextIndex]" 
                    >
                        <i class="fe fe-arrow-right text-white text-2xl"></i>
                    </button>
                    <div class="flex justify-center">
                        <app-image
                        :url="preview"
                        class="w-full"
                        />
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2">
                            <div class="mr-0 sm:mr-1">
                                <app-field-display
                                    label="From"
                                    :value="campaign.to"
                                />
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2">
                            <div class="ml-0 sm:ml-1">
                                <app-field-display
                                    label="To"
                                    :value="campaign.to"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2">
                            <div class="mr-0 sm:mr-1">
                                <app-field-display
                                    label="Daily Budget"
                                    :value="formatAmount(campaign.daily_budget)"
                                />
                            </div>
                        </div>
                        <div class="w-full sm:w-1/2">
                            <div class="ml-0 sm:ml-1">
                                <app-field-display
                                    label="Total Budget"
                                    :value="formatAmount(campaign.total_budget)"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2">
                            <div class="mr-0 sm:mr-1">
                                <app-field-display
                                    label="Created"
                                    :value="createMoment(campaign.created_at).format('LLL')"
                                />
                            </div>
                        </div>
                        <div v-if="campaign.updated_at" class="w-full sm:w-1/2">
                            <div class="ml-0 sm:ml-1">
                                <app-field-display
                                    label="Updated"
                                    :value="createMoment(campaign.updated_at).format('LLL')"
                                />
                                <p class="text-sm">{{ createMoment(campaign.updated_at).fromNow() }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </template>

        <template #footer>
            <div class="flex justify-end items-center space-x-2">
                <jet-button type="button" @click="$emit('edit')">
                    Edit
                </jet-button>
                <jet-button type="button" @click="$emit('close')">
                    Close
                </jet-button>
            </div>
        </template>
    </dialog-modal>
</template>

<script>
import { defineComponent } from 'vue';
import DialogModal from "@/Jetstream/DialogModal.vue";
import JetButton from '@/Jetstream/Button.vue';
import AppFieldDisplay from '@/App/FieldDisplay.vue';
import CampaignCreative from './Creative.vue';
import AppImage from '@/App/Image.vue';

import utility from '@/Mixins/utility';

export default defineComponent({
    name: "SingleCampaign",
    mixins: [utility],
    components: {
        DialogModal, JetButton, AppFieldDisplay, CampaignCreative, AppImage
    },
    props: {
        campaign: {
            required: true
        }
    },
    data() {
        return {
            preview: null
        }
    },

    computed: {

        creatives() {
            return this.campaign && this.campaign.creatives ? this.campaign.creatives : [];
        },

        currentIndex() {
            if(!this.creatives.length || !this.preview) return -1;

            return this.creatives.findIndex(c => c === this.preview);
        },

        previousIndex() {
            if(this.currentIndex < 0) return this.currentIndex;
            return this.currentIndex === 0 ? this.creatives.length - 1 : (this.currentIndex - 1);
        },

        nextIndex() {
            if(this.currentIndex < 0) return this.currentIndex;
            return this.currentIndex === (this.creatives.length - 1) ? 0 : (this.currentIndex + 1);
        }
    },

    methods: {
       
    },

    watch: {
        campaign: {
            immediate: true,
            handler(campaign) {
                if(campaign && campaign.creatives && campaign.creatives.length) this.preview = campaign.creatives[0];
                else this.preview = null;
            }
        }
    }
})
</script>
