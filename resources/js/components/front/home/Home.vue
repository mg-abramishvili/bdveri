<template>
    <div>
        <file-pond
            name="avatar"
            ref="avatar"
            label-idle="Загрузите аватарку..."
            allow-multiple="true"
            allow-reorder="true"
            accepted-file-types="image/jpeg, image/png"
            server="/api/upload"
            v-bind:files="myFiles"
            v-on:init="handleFilePondInit"
        />
        <button @click="submit()">Submit</button>
    </div>
</template>

<script>
import vueFilePond from "vue-filepond";

import "filepond/dist/filepond.min.css";

import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

export default {
    data: function () {
        return {
            myFiles: [],
        };
    },
    methods: {
        handleFilePondInit: function () {
            //console.log("FilePond has initialized");
        },
        submit() {
            var values = [];
            var fields = document.getElementsByName("avatar");
            for(var i = 0; i < fields.length; i++) {
                values.push(fields[i].value);
            }
            console.log(values)
        },
    },
    components: {
        FilePond,
    },
};
</script>