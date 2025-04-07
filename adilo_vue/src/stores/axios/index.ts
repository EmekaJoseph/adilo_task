
import { $instance, $instanceForm } from './instances'

export default {
    allVidoes() {
        return $instance.get(`/videos`)
    },

    getVideo(id: string) {
        return $instance.get(`/videos/${id}`)
    },

    postVideo(form: FormData) {
        return $instanceForm.post(`/videos`, JSON.stringify(form))
    },

    updateVideo(id: string, form: FormData) {
        return $instanceForm.post(`/videos/update/${id}`, JSON.stringify(form))
    },
}