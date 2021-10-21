<template>
    <dialog-modal :show="modal" :closeable="true"  @close="close">
        <template #title>
            {{ campaign ? 'Update' : 'Create'}} Campaign
        </template>

        <template #content>

           
            <form @submit.prevent class="space-y-5">
                <app-form-input
                    label="Name"
                    type="text"
                    v-model="form.name"
                    :error="form.errors['name']"
                />

                <div class="flex flex-wrap">
                    <div class="w-full sm:w-1/2">
                        <div class="mr-0 sm:mr-1">
                            <app-form-input
                                label="From"
                                type="date"
                                v-model="form.from"
                                :error="form.errors['from']"
                            />
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2">
                        <div class="ml-0 sm:ml-1">
                            <app-form-input
                                label="To"
                                type="date"
                                v-model="form.to"
                                :error="form.errors['to']"
                            />
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap">
                    <div class="w-full sm:w-1/2">
                        <div class="mr-0 sm:mr-1">
                            <app-form-input
                                label="Daily Budget (USD)"
                                type="number"
                                v-model="form.daily_budget"
                                :error="form.errors['daily_budget']"
                            />
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2">
                        <div class="ml-0 sm:ml-1">
                            <app-form-input
                                label="Total Budget (USD)"
                                type="number"
                                v-model="form.total_budget"
                                :error="form.errors['total_budget']"
                            />
                        </div>
                    </div>
                </div>

                <app-file-input
                label="Creatives"
                :multiple="true"
                :error="form.errors['new_creative_images']"
                accept="image/*"
                @input="files => form.new_creative_images = files">

                    <template #before-input>

                        <div class="flex flex-wrap overflow-auto mb-3 gap-2">
                            <campaign-creative v-for="(creative, i) in form.creatives" :key="i"
                            :creative="creative"
                            class="h-32 w-32"
                            >
                                <template #actions>
                                    <button 
                                    class="text-white focus:outline-none p-1 shadow-lg bg-red-500" 
                                    title="Remove"
                                    @click="form.creatives.splice(i, 1)" 
                                    >
                                        <i class="fe fe-x text-white"></i>
                                    </button>
                                </template>

                            </campaign-creative>
                            
                        </div>
                    </template>

                    <div class="text-center text-xl uppercase mb-2">
                        <i class="fe fe-upload-cloud"></i> Add Creatives
                    </div>
                </app-file-input>

            </form>
        </template>
        <template #footer>
            <div class="flex justify-between items-center">
                <jet-button @click="close">
                    Cancel
                </jet-button>
                <div class="flex items-center">
                    <jet-action-message :on="form.processing" class="mr-3">
                        Saving...
                    </jet-action-message>

                    <jet-button @click="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        {{ campaign ? 'Update' : 'Create' }} Campaign
                    </jet-button>
                </div>
            </div>
            
        </template>
    </dialog-modal>
</template>

<script>
import { defineComponent } from 'vue';

import DialogModal from "@/Jetstream/DialogModal.vue";
import JetButton from '@/Jetstream/Button.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import AppFormInput from '@/App/FormInput.vue';
import AppFileInput from '@/App/FileInput.vue';
import CampaignCreative from './Creative.vue';

export default defineComponent({
    name: "CampaignForm",
    components: {
        JetButton,
        JetActionMessage,
        DialogModal,
        AppFormInput,
        AppFileInput,
        CampaignCreative
    },
    data() {
        return {
            modal: false,
            form: null,
        };
    },
    props: {
        show:{
            default: false
        },
        campaign: Object
    },
   
    methods: {
        async submit() {

            if(this.campaign) {
                 await this.form.post(this.route('campaign.update', {campaign: this.campaign.id}), {
                    onSuccess: () => this.close()
                });
            }else{
                await this.form.post(this.route('campaign.store'), {
                    onSuccess: () => {
                        this.form.reset()
                        this.close()
                    }
                });
            }

        },

        close(){
            this.$emit('close');
        },

    },
    
    watch: {
        show: {
            immediate: true,
            handler(value){
                this.modal = value;
            }
        },
        campaign: {
            immediate: true,
            handler(campaign){
                if(campaign){
                     this.form = this.$inertia.form({
                        _method: 'PUT',
                        name: campaign.name,
                        from: campaign.from,
                        to: campaign.to,
                        daily_budget: campaign.daily_budget,
                        total_budget: campaign.total_budget,
                        creatives: campaign.creatives,
                        new_creative_images: [],
                     })
                } else {
                    this.form = this.$inertia.form({
                        name: null,
                        from: null,
                        to: null,
                        daily_budget: 0,
                        total_budget: 0,
                        creatives: [],
                        new_creative_images: [],
                    })
                }
            }
        }
    }
})
</script>
