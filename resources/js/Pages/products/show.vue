<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3"

const props = defineProps({
    product: Object,
});

const form = useForm({
    referencia: props.product.referencia,
    nombre: props.product.nombre,
    // cantidad: props.product.cantidad,
    s: props.product.s,
    m: props.product.m,
    l: props.product.l,
    xl: props.product.xl,
    xxl: props.product.xxl,
    stock: props.product.stock,
});

function submit() {
    // Utiliza el método 'put' para actualizar la entrada y pasa el ID de la entrada
    form.put(`/products/${props.product.id}`);
}
</script>


<template>
    <AppLayout title="Editar product">
        <form action="" @submit.prevent="submit()">
            <div class="container text-center p-5 text-dark">
                <div class="row md-6 d-flex justify-center g-4">
                    <div class="col-10 d-flex flex-column">
                        <label for="referencia">referencia</label>
                        <input disabled id="referencia" type="text" v-model="form.referencia" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="nombre">nombre</label>
                        <input id="nombre" type="text" v-model="form.nombre" class="w-100 bg-gray-400">
                    </div>
                    <!-- <div class="col-10 d-flex flex-column">
                        <label for="Cantidad">Cantidad</label>
                        <input id="Cantidad" type="number" v-model="form.cantidad" class="w-100 bg-gray-400">
                    </div> -->
                    <div class="col-10 d-flex flex-column">
                        <label for="s">s</label>
                        <input id="s" type="number" v-model="form.s" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="m">m</label>
                        <input id="m" type="number" v-model="form.m" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="l">l</label>
                        <input id="l" type="number" v-model="form.l" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="xl">xl</label>
                        <input id="xl" type="number" v-model="form.xl" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="xxl">xxl</label>
                        <input id="xxl" type="number" v-model="form.xxl" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="stock">stock</label>
                        <input id="stock" type="text" v-model="form.stock" class="w-100 bg-gray-400">
                    </div>
                    
                    <button class="btn bg-dark text-white col-3" type="submit">Actualizar</button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
