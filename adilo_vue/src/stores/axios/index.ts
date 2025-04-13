
import { $instance, $instanceForm } from './instances'

export default {

    categories() {
        return $instance.get(`/categories`)
    },

    getVideos(page = 1, category_id = 1) {
        return $instance.get(`/videos?page=${page}&category_id=${category_id}`)
    },

    getVideoDetails(id: string) {
        return $instance.get(`/videos/${id}`)
    },

    postVideo(form: FormData) {
        return $instanceForm.post(`/videos`, JSON.stringify(form))
    },

    updateVideo(id: string, form: FormData) {
        return $instanceForm.post(`/videos/update/${id}`, JSON.stringify(form))
    },
}