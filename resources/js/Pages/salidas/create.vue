<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { DateTime } from "luxon";

defineProps({
    productos: Array,
    error: String,
    errorS: String,
    errorm: String,
    errorl: String,
    errorxl: String,
    errorxxl: String,
});

const form = useForm({
    fecha: new Date().toISOString().substr(0, 10),
    hora: obtenerHoraColombia(), // Utiliza la función obtenerHoraColombia para obtener la hora en Colombia
    cantidad: '',
    s: 0,
    m: 0,
    l: 0,
    xl: 0,
    xxl: 0,
    cliente: '',
    product_id: '',
});

// Función para obtener la hora actual en Colombia utilizando Luxon
function obtenerHoraColombia() {
    return DateTime.now().setZone('America/Bogota').toFormat('HH:mm');
}

function submit() {
    form.post('/salidas');
}

document.addEventListener("keyup", e => {
    if (e.target.matches(".search")) {
        if (e.key === "Escape") e.target.value = "";
        document.querySelectorAll(".salida").forEach(salida => {
            salida.textContent.toLowerCase().includes(e.target.value.toLowerCase())
                ? salida.classList.remove("filtro")
                : salida.classList.add("filtro");
        });
    }
});
</script>


<template>
    <AppLayout title="salidas">

        <form action="" @submit.prevent="submit()">
            <div class="container text-center p-5 text-gray-900">
                <div class="row md-6 d-flex justify-center g-4">
                    <div class="col-10 d-flex flex-column">
                        <label for="fecha">Fecha</label>
                        <input disabled id="fecha" type="date" v-model="form.fecha" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="hora">Hora</label>
                        <input disabled id="hora" type="time" v-model="form.hora" class="w-100 bg-gray-400">
                    </div>
                    <!-- <div class="col-10 d-flex flex-column">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" type="number" v-model="form.cantidad" class="w-100 bg-gray-400">
                        <p class="text-danger">{{ error }}</p>
                    </div> -->
                    <div class="col-10 d-flex flex-column">
                        <label for="s">S</label>
                        <input id="s" type="number" v-model="form.s" class="w-100 bg-gray-400" min="0" max="100000">
                        <p class="text-danger">{{ errorS }}</p>
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="m">M</label>
                        <input id="m" type="number" v-model="form.m" class="w-100 bg-gray-400" min="0" max="100000">
                        <p class="text-danger">{{ errorm }}</p>
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="l">L</label>
                        <input id="l" type="number" v-model="form.l" class="w-100 bg-gray-400" min="0" max="100000">
                        <p class="text-danger">{{ errorl }}</p>
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="xl">XL</label>
                        <input id="xl" type="number" v-model="form.xl" class="w-100 bg-gray-400" min="0" max="100000">
                        <p class="text-danger">{{ errorxl }}</p>
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="xxl">XXL</label>
                        <input id="xxl" type="number" v-model="form.xxl" class="w-100 bg-gray-400" min="0" max="100000">
                        <p class="text-danger">{{ errorxxl }}</p>
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="cliente">Cliente</label>
                        <select name="cliente" id="cliente" v-model="form.cliente" class="bg-gray-400">
                            <option value="Pagina">Pagina</option>
                            <option value="Local">Local</option>
                            <option value="Mayorista">Mayorista</option>
                        </select>
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="product_id">Producto</label>
                        <input id="search" type="search" class="search w-100 mb-3" placeholder="Filtrar Productos">
                        <select name="product_id" id="product_id" v-model="form.product_id" class="bg-gray-400">
                            <option class="salida" v-for="producto in productos" :key="producto.id" :value="producto.id">{{ producto.referencia }}</option>
                        </select>
                    </div>
                    
                    <button class="btn bg-dark text-white col-3" type="submit">Crear</button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
<style>
.filtro{
    display: none;
}
</style>