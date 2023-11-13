<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3"

defineProps({
    products: Array,
    error: String,
    errores: String,
});

const form = useForm({
    referencia: '',
    nombre: '',
    // cantidad: '',
    s: 0,
    m: 0,
    l: 0,
    xl: 0,
    xxl: 0,
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
                    <p class="text-danger">{{ errores }}</p>
                    <div class="col-10 d-flex flex-column">
                        <label for="referencia">Referencia</label>
                        <input min="0" id="referencia" type="text" v-model="form.referencia" class="w-100 bg-gray-400">
                        <p class="text-danger">{{ error }}</p>
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="nombre">Nombre</label>
                        <input min="0" id="nombre" type="text" v-model="form.nombre" class="w-100 bg-gray-400">
                    </div>
                    <!-- <div class="col-10 d-flex flex-column">
                        <label for="cantidad">cantidad</label>
                        <input min="0" id="cantidad" type="number" v-model="form.cantidad" class="w-100 bg-gray-400" >
                    </div> -->
                    <div class="col-10 d-flex flex-column">
                        <label for="s">S</label>
                        <input min="0" id="s" type="number" v-model="form.s" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="m">M</label>
                        <input min="0" id="m" type="number" v-model="form.m" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="l">L</label>
                        <input min="0" id="l" type="number" v-model="form.l" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="xl">XL</label>
                        <input min="0" id="xl" type="number" v-model="form.xl" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="xxl">XXL</label>
                        <input min="0" id="xxl" type="number" v-model="form.xxl" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="stock">Stock</label>
                        <!-- <input id="stock" type="text" v-model="form.stock" class="w-100 bg-gray-400"> -->
                        <select name="stock" id="stock" v-model="form.stock" class="bg-gray-400">
                            <option value="Stock 1">Stock 1</option>
                            <option value="Stock 2">Stock 2</option>
                            <option value="Stock 3">Stock 3</option>
                            <option value="Stock 4">Stock 4</option>
                            <option value="Stock 5">Stock 5</option>
                            <option value="Stock 6">Stock 6</option>
                            <option value="Stock 7">Stock 7</option>
                            <option value="Stock 8">Stock 8</option>
                            <option value="Stock 9">Stock 9</option>
                            <option value="Stock 10">Stock 10</option>
                        </select>
                    </div>
                    
                    
                    <button class="btn bg-dark text-white col-3" type="submit">Crear</button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
