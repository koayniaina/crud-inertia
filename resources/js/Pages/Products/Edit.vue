<template>
    <h2>Edit Product</h2>

    <form @submit.prevent="updateProduct">
        <div>
            <input type="text" v-model="form.title" placeholder="Title">
            <div v-if="form.errors.title" class="error">{{ form.errors.title }}</div>
        </div>

        <div>
            <textarea v-model="form.description" placeholder="Description"></textarea>
            <div v-if="form.errors.description" class="error">{{ form.errors.description }}</div>
        </div>

        <div>
            <input type="number" v-model="form.price" placeholder="Price">
            <div v-if="form.errors.price" class="error">{{ form.errors.price }}</div>
        </div>

        <button type="submit" :disabled="form.processing">
           Update
        </button>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'


const props = defineProps({
    product: Object,
    errors: Object
})


const form = useForm({
    title: props.product.title,
    description: props.product.description,
    price: props.product.price
})


const updateProduct = () => {
    form.put(route('products.update', props.product.id), {
        onError: (errors) => {
            console.log('Validation errors:', errors)
        }
    })
}
</script>

<style>
.error {
    color: red;
    font-size: 0.9rem;
}
</style>
