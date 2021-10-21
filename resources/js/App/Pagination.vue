<template>
    <div class="flex justify-between">
        <div class="text-gray-400">
            <p v-if="!resource.total">Nothing to show</p>
            <p v-else>
                showing {{ resource.from }} to {{ resource.to }} of {{ resource.total }}
            </p>
        </div>
        <div class="flex flex-wrap" v-if="resource.total" >
            <Link class="mx-2" :href="resource.current_page === 1 || !resource.first_page_url ? '#' : paginationLink(1)" v-if="resource.first_page_url"
                            :class="{'disabled': resource.current_page === 1 || !resource.first_page_url}">First</Link>

            <Link class="mx-2" :href="!resource.prev_page_url ?'#' : paginationLink(resource.current_page-1)" 
                            :class="{ 'disabled': !resource.prev_page_url }">Previous</Link>

            <Link class="mx-2" :href="!resource.next_page_url ? '#' : paginationLink(resource.current_page+1)" 
                            :class="{ 'disabled': !resource.next_page_url }">Next</Link>

            <Link class="mx-2" :href="resource.current_page === resource.last_page || !resource.last_page_url ? '#' : paginationLink(resource.last_page)"
                    :class="{ 'disabled': resource.current_page === resource.last_page || !resource.last_page_url }"
            >Last</Link>
        </div>
    </div>
    

</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        name: "AppPagination",
        components: {
            Link
        },
        props: {
            resource: { type: Object, required: true },
            size: String,
        },
        data(){
            return {
                
            }
        },
        methods: {
            paginationLink(page){
                let queryString = '';
                const urlParams = new URLSearchParams(window.location.search);
                for (const key of urlParams.keys()) {
                    queryString += key != 'page' ? `${key}=${urlParams.get(key)}&` : '';
                }
                return `${this.resource.path}?${queryString}page=${page}`
            }
        },

    });
</script>

<style scoped>
    .disabled{
        opacity: .2;
    }
</style>
