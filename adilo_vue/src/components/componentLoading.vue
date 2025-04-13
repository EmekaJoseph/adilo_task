<template>
    <div class="d-flex justify-content-center align-items-center">
        <div>
            <div style="width: 4rem; height: 4rem;" class="spinner-border text-muted spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
defineProps(['text'])
</script>