<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3"

defineProps({
    products: Array,
});

const form = useForm({
    referencia: '',
    nombre: '',
    cantidad: '',
    stock: '',
});

function submit() {
    form.post('/products');
}

</script>

<template>
    <AppLayout title="products">

        <form action="" @submit.prevent="submit()">
            <div class="container text-center p-5 text-gray-900">
                <div class="row md-6 d-flex justify-center g-4">
                    <div class="col-10 d-flex flex-column">
                        <label for="referencia">referencia</label>
                        <input id="referencia" type="text" v-model="form.referencia" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="nombre">nombre</label>
                        <input id="nombre" type="text" v-model="form.nombre" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="cantidad">cantidad</label>
                        <input id="cantidad" type="number" v-model="form.cantidad" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="stock">stock</label>
                        <input id="stock" type="text" v-model="form.stock" class="w-100 bg-gray-400">
                    </div>
                    
                    
                    <button class="btn bg-dark text-white col-3" type="submit">Crear</button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
