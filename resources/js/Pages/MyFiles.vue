<template>
    <AuthenticatedLayout>
        <table class="min-w-full">
            <thead class="bg-gray-100 border-b">
            <tr>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Name
                </th>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Path
                </th>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Owner
                </th>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Last Modified
                </th>
                <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Size
                </th>
            </tr>
            </thead>
            <tbody v-if="allFiles.data">
                <tr
                    v-for="file of allFiles.data"
                    :key="file.id"
                    @dblclick.prevent="openFolder(file)"
                    class="border-b transition duration-300 ease-in-out hover:bg-blue-100 cursor-pointer"
                >
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex items-center">
                        {{ file.name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ file.path }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ file.owner }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ file.updated_at }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ file.size }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="!allFiles.data.length" class="py-8 text-center text-sm text-gray-400">
            There is no data in this folder
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
// Imports
import { computed, onMounted, onUpdated, ref } from "vue";
import {router, useForm, usePage} from "@inertiajs/vue3";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    files: Object,
});

const allFiles = ref({
    data: props.files.data,
});

function openFolder(file) {
    console.log(file.is_folder, 'file');
    if (!file.is_folder) {
        return;
    }

    router.visit(route('myFiles', {
        folder: file.path
    }));
}

</script>

<style scoped>

</style>
