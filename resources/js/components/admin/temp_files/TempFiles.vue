<template>
    <div>
        <h1>Временные файлы</h1>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Имя файла</th>
                    <th>Папка</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file in temp_files" :key="'temp_file_' + file.id">
                    <td>
                        {{ file.filename }}
                    </td>
                    <td>
                        {{ file.folder }}
                    </td>
                    <td style="text-align: right;">
                        <button @click="deleteTempFile(file.id)" class="btn btn-sm btn-danger">Удалить</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                temp_files: [],
            }
        },
        created() {
            axios
                .get('/api/temp_files')
                .then(response => (
                    this.temp_files = response.data
                ));
        },
        methods: {
            deleteTempFile(id) {
                axios
                .get(`/api/temp_files/${id}/delete`)
                .then(response => {
                    axios
                    .get('/api/temp_files')
                    .then(response => (
                        this.temp_files = response.data
                    ));
                });
            }
        },
        components: {
        }
    }
</script>