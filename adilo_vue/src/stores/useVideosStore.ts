import { ref, computed, reactive } from 'vue'
import { defineStore } from 'pinia'
import api from '@/stores/axios'
import type { videoInterface } from './interfaces'

export const useVideosStore = defineStore('videosStore', () => {

  const isLoadingAtFirst = ref<boolean>(true)

  const categories = ref<any[]>([])
  const videos = ref<videoInterface[]>([])
  const videoIdToQuery = ref<any[]>([])
  const mediaPlayerModal = ref<boolean>(false)

  const clickedVideo = ref<any>()



  const videoToShow = reactive<{ details: videoInterface, isLoading: boolean }>({
    details: { id: '', title: '', url: '', description: '', category: '' }, isLoading: false
  })


  async function getCategories() {
    try {
      const { data } = await api.categories()
      categories.value = data
    } catch (error) {

    }
    finally {
      isLoadingAtFirst.value = false
    }
  }

  async function getVideoDetails() {
    videoToShow.isLoading = true
    const { data } = await api.getVideoDetails(clickedVideo.value.id)
    videoToShow.isLoading = false
  }

  // 

  return {
    categories,
    videos,
    getCategories,
    isLoadingAtFirst,
    videoIdToQuery,
    videoToShow,
    mediaPlayerModal,
    getVideoDetails,
    clickedVideo
  }
})
