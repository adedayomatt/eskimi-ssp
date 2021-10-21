<template>
    <div>
        <jet-label :for="$attrs.id" :value="label" />
        <jet-input class="mt-1 block w-full" v-bind="$attrs" />
        <jet-input-error :message="error" class="mt-2" />
    </div>
</template>

<script>
    import { defineComponent } from 'vue';

    import JetLabel from '@/Jetstream/Label.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'

    export default defineComponent({
        name: "AppFormInput",
        inheritAttrs: false,
        components: {
            JetLabel, JetInput, JetInputError
        },
        props: {
            label: String,
            error: String
        },
        data(){
            return {
                
            }
        },
    });
</script>