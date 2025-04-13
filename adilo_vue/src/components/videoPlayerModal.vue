<template>
    <div>

        <button type="button" ref="modalOpen" class="d-none" data-bs-toggle="modal" data-bs-target="#videoPlayerModal">
            Launch
        </button>


        <div class="modal fade" id="videoPlayerModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centere modal-dialog-scrollable" role="document">
                <div class="modal-content" style="height: 70vh;">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modalTitleId">
                            {{ videoStore.clickedVideo?.title }}
                        </h6>
                        <button ref="modalClose" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-5" v-if="videoStore.videoToShow.isLoading">
                            <ComponentLoading />
                        </div>
                        <video v-if="videoStore.videoToShow.details.url" class="w-100 h-100" controls autoplay>
                            <source :src="videoStore.videoToShow.details.url" type="video/mp4">
                            <source :src="videoStore.videoToShow.details.url" type="video/ogg">
                            <source :src="videoStore.videoToShow.details.url" type="video/webm">
                            <source :src="videoStore.videoToShow.details.url" type="video/mkv">
                            <source :src="videoStore.videoToShow.details.url" type="video/avi">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <!-- <div class="modal-footer">
                        <input ref="fileBrowserBtn" type="file" class="d-none"
                            accept="video/mp4, video/webm, video/ogg" />
                        <button @click="openFolder" class="btn btn-theme btn-sm">
                            <i class="bi bi-folder-fill"></i>
                        </button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useVideosStore } from '@/stores/useVideosStore';
import { ref, watch } from 'vue';
import { onBeforeRouteLeave } from 'vue-router';
import ComponentLoading from './componentLoading.vue';

const modalOpen = ref<any>(null)
const modalClose = ref<any>(null)
const videoStore = useVideosStore()

watch(() => videoStore.mediaPlayerModal, () => {
    modalOpen.value.click()
})

onBeforeRouteLeave(() => {
    modalClose.value.click()
})

</script>