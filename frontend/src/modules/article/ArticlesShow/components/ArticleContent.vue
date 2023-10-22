<script setup lang="ts">
type Props = {
    content: string;
};
defineProps<Props>();
</script>

<template>
    <div class="card"  v-html="content"></div>
</template>
