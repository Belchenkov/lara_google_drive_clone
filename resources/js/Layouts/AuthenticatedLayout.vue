<template>
    <div class="h-screen bg-gray-50 flex w-full gap-4">
        <Navigation />
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
// Imports
import Navigation from "@/Components/app/Navigation.vue";

const showingNavigationDropdown = ref(false);
</script>


