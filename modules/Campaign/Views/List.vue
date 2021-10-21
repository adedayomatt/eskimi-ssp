<template>
    <app-layout title="Campaigns">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Campaigns
                </h2>
                <jet-button @click="showCampaignForm = true">Create New</jet-button>
            </div>
            
        </template>

        <div class="py-10">
    
            <app-empty-list v-if="!campaigns.total" message="No campaign" />
            <div v-else class="shadow overflow-auto border-b border-gray-200 sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th class="p-2 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            From
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            To
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Daily Budget ({{ defaultCurrency }})
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Total Budget ({{ defaultCurrency }})
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Created
                        </th>
                        <th class="p-2 py-3 bg-gray-50"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="campaign in campaigns.data" :key="campaign.id">
                            <td class="p-2 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <campaign-avatar :campaign="campaign" class="w-10 h-10" />
                                    </div>
                                    <div class="ml-2">
                                        <h4 class="leading-5 font-medium">{{ campaign.name }}</h4>
                                    </div>
                                </div>
                            </td>

                            <td class="p-2 whitespace-no-wrap text-center">
                                {{ campaign.from }}
                            </td>

                            <td class="p-2 whitespace-no-wrap text-center">
                                {{ campaign.to }}
                            </td>

                            <td  class="p-2 whitespace-no-wrap text-center">
                                {{ formatAmount(campaign.daily_budget) }}
                            </td>

                            <td  class="p-2 whitespace-no-wrap text-center">
                                {{ formatAmount(campaign.total_budget) }}
                            </td>

                            <td  class="p-2 whitespace-no-wrap text-center">
                                {{ createMoment(campaign.created_at).format('YYYY-MM-DD hh:mm a') }}
                            </td>

                            <td class="p-2 whitespace-no-wrap text-right text-sm leading-5 font-medium space-x-2 space-y-2">
                                <jet-button type="button" @click="viewCampaign(campaign)"><i class="fe fe-eye"></i></jet-button>
                                <jet-button type="button" @click="editCampaign(campaign)"><i class="fe fe-edit"></i></jet-button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <app-pagination :resource="campaigns" class="py-5 px-3" />
                
            </div>
            <campaign-form :campaign="campaign" :show="showCampaignForm" 
            @close="() => {
                showCampaignForm = false;
                campaign = null
            }"/>

            <campaign-single :campaign="campaign" :show="showCampaignSingle" 
            @edit="() => {
                showCampaignSingle = false;
                showCampaignForm = true;
            }"
            @close="() => {
                showCampaignSingle = false;
                campaign = null
            }"/>
        </div>

    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import AppEmptyList from '@/App/EmptyList.vue';
    import AppPagination from '@/App/Pagination.vue';
    import JetButton from '@/Jetstream/Button.vue';

    import CampaignForm from '../Components/Form.vue';
    import CampaignSingle from '../Components/Single.vue';
    import CampaignAvatar from '../Components/Avatar.vue';

    import utility from '@/Mixins/utility';

    export default defineComponent({

        mixins: [utility],

        components: {
            AppLayout, AppEmptyList, AppPagination, JetButton,
            CampaignForm, CampaignSingle, CampaignAvatar
        },

        props: {
            campaigns: Object
        },

        data() {
            return {
                showCampaignForm: false,
                showCampaignSingle: false,
                campaign: null
            };
        },
        methods: {
            viewCampaign(campaign) {
                this.campaign = campaign;
                this.showCampaignSingle = true;
            },

            editCampaign(campaign) {
                this.campaign = campaign;
                this.showCampaignForm = true;
            },

            dateMoment(date) {

            }
        },

    })
</script>
