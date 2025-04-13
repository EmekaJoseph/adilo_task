<template>
    <span class="password-field">
        <input :type="isPasswordVisible ? 'text' : 'password'" class="form-control w-100" :class="className"
            :value="modelValue" @input="emitValue" :placeholder="placeholder" :aria-label="placeholder" />

        <span @click="isPasswordVisible = !isPasswordVisible" class="icon"
            :title="isPasswordVisible ? 'Hide password' : 'Show password'">
            <i v-if="!isPasswordVisible" class="bi bi-eye-slash"></i>
            <i v-else class="bi bi-eye"></i>
        </span>
    </span>
</template>

<script setup lang="ts">
import { ref } from 'vue';

defineProps({
    modelValue: String,
    className: { type: String, default: '' },
    placeholder: { type: String, default: 'enter password' },
});

const emit = defineEmits(['update:modelValue'])

function emitValue(event: Event) {
    const target = event.target as HTMLInputElement;
    emit('update:modelValue', target.value);
}

const isPasswordVisible = ref<boolean>(false)

</script>

<style scoped>
.password-field {
    position: relative;
    display: flex;
    align-items: center;
}



.icon {
    position: absolute;
    right: 0.75rem;
    cursor: pointer;
    color: #6c757d;
}
</style>