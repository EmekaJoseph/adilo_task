<template>
  <div class=" bg-warning-subtle d-flex justify-content-center align-items-center min-vh-50 text-center">
    <div class="text-cente">
      <h1 class="text-uppercase fw-bold">Adilo Video Listing</h1>
      <span class="small">Browse vidoes by category</span>
    </div>
  </div>


  <div v-if="videoStore.isLoadingAtFirst" class="container mt-5">
    <ComponentLoading />
  </div>

  <div v-else class="container mt-5">
    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
      <li v-for="(category, index) in videoStore.categories" :key="index" class="nav-item m-2" role="presentation">
        <button class="nav-link " @click="selectedCategory = category.id"
          :class="{ 'active': selectedCategory == category.id }" id="home-tab" data-bs-toggle="tab"
          data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
          {{ category.name }}
          <span class="badge rounded-pill text-bg-secondary">{{ category.videos_count }}</span>

        </button>
      </li>

    </ul>

    <!-- Tab panes -->
    <div class="tab-content py-3 min-vh-100">
      <div v-if="isLoadingVideos" class="pt-5">
        <ComponentLoading />
      </div>
      <div v-else class="row justify-content-center g-3">
        <div class="col-md-4 col-lg-3" v-for="(item, index) in videoStore.videos" :key="index">
          <div @click="playVideo(item)" class="card overflow-hidden hover-tiltY cursor-pointer">
            <video muted class="bg-light">
              <source :src="item.url" type="video/mp4">
              Your browser does not support the video tag.
            </video>
            <div class="card-body">
              <h5 class="card-title">{{ item.title }}</h5>
              <p class="card-text">{{ item.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


  <!-- pagination -->
  <div v-if="!videoStore.isLoadingAtFirst">
    <CustomPagination :currentPage="pagination.currentPage" :perPage="pagination.perPage"
      :totalRecords="pagination.totalRecords" @moveToNext="paginateToNext" />
  </div>


  <!-- modal - Player -->
  <videoPlayerModal />

</template>
<script setup lang="ts">
import { onMounted, reactive, ref, watch } from 'vue';
import api from '@/stores/axios'
import CustomPagination from '@/components/customPagination.vue';
import ComponentLoading from '@/components/componentLoading.vue';
import { useVideosStore } from '@/stores/useVideosStore';
import videoPlayerModal from '@/components/videoPlayerModal.vue';
import type { videoInterface } from '@/stores/interfaces';

const videoStore = useVideosStore()

const isLoadingVideos = ref<boolean>(true)
const selectedCategory = ref<number>(1)

onMounted(async () => {
  await videoStore.getCategories()
  getVidoes()
})



async function getVidoes(page = 1) {
  try {
    isLoadingVideos.value = true

    const { data } = await api.getVideos(page, selectedCategory.value)
    pagination.currentPage = data.data.current_page
    pagination.totalPages = data.data.last_page
    pagination.perPage = data.data.per_page
    pagination.totalRecords = data.data.total

    videoStore.videos = data.data.data

  } catch (error) {

  }
  finally {
    isLoadingVideos.value = false
  }

}
watch(() => selectedCategory.value, () => {
  getVidoes(pagination.currentPage)
})

function playVideo(video: videoInterface) {
  videoStore.clickedVideo = video
  videoStore.mediaPlayerModal = !videoStore.mediaPlayerModal
  videoStore.getVideoDetails()
}


// pagination
const pagination = reactive({
  currentPage: 1,
  totalPages: 0,
  perPage: 0,
  totalRecords: 0
})

function paginateToNext(page: any) {
  window.scrollTo(0, 0)
  getVidoes(page)
}
</script>

<style scoped>
.min-vh-50 {
  min-height: 50vh;
}


/* nav tabs ############################################### */
.nav-link {
  border: none !important;
  font-size: 14px;
}


.nav-link,
.nav-link:hover {
  color: #7C8493;
  border-radius: 15px;
}

.nav-tabs .nav-item.show .nav-link,
.nav-tabs {
  font-weight: bolder;
  border: none !important;
  border-bottom: 2px solid var(--theme-color) !important;
  color: var(--theme-color) !important;
}

.nav-link.active {
  background-color: var(--bs-warning);
  color: #fff !important;
}

.nav {
  border: none !important;
}
</style>