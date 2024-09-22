<template>
    <div class="w-[600px] h-[80px] flex items-center">
        <TextInput type="text"
                   class="block w-full mr-2"
                   v-model="search"
                   autocomplete
                   @keyup.enter.prevent="onSearch"
                   placeholder="Search for files and folders"/>
    </div>
</template>

<script setup>
import { ref }   from "vue";

import TextInput from "@/Components/TextInput.vue";

let params = '';
const search = ref('');

function onSearch() {
    params.set('search', search.value);
    // router.get(window.location.pathname + '?' + params.toString())
    //
    // emitter.emit(ON_SEARCH, search.value)
}
</script>
