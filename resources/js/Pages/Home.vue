<template>
    <app-layout>
        <div class="max-w-2xl mx-auto p-6">
            <form @submit.prevent="store" class="mb-4">
                <textarea v-model="form.message" placeholder="¿Qué estás pensando?" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Chirp</button>
            </form>

            <div v-for="chirp in chirps" :key="chirp.id" class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-bold">{{ chirp.user.name }}</h2>
                        <p class="mt-4">{{ chirp.message }}</p>
                    </div>
                    <button @click="destroy(chirp.id)" class="text-sm text-gray-400 hover:text-red-500">Delete</button>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Components/AuthenticatedLayout.vue'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        AppLayout,
    },
    props: {
        chirps: {
            type: Array,
            required: true
        }
    },
    setup() {
        const form = useForm({
            message: ''
        })

        function store() {
            form.post(route('chirps.store'))
            form.message = ''
        }

        function destroy(id) {
            if (confirm('¿Estás seguro de que quieres eliminar este chirp?')) {
                form.delete(route('chirps.destroy', id))
            }
        }

        return { form, store, destroy }
    }
}
</script>
