<template>
    <div>
        <file-input :value="imageUrl" @change="imageChanged" accept="image/*">
            <div class="text-center text-xl uppercase mb-5">
                <i class="fe fe-camera"></i>
            </div>
        </file-input>

        <div v-if="uploading" class="text-gray-500">uploading file...</div>
        <div v-else-if="uploadError" class="text-red-500">Something went wrong while uploading file</div>
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import FileInput from '@/App/FileInput';

export default defineComponent({
    name: "AppImageInput",
    components: {
        FileInput
    },
    props: {
        value: String
    },
    data(){
        return {
            uploading: false,
            uploadError: null,
            imageUrl: null,
        }
    },
    methods: {
        imageChanged(file) {
            this.$emit('input', this.imageUrl);
        },

    },

    watch: {
        value: {
            immediate: true,
            handler(url){
                this.imageUrl = url;
            }
        }
    }
})
</script>