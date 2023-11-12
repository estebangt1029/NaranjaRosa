<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3"
import { DateTime } from "luxon";

defineProps({
    productos: Array, // Define la propiedad para los productos
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
    product_id: '',
});

// Función para obtener la hora actual en Colombia utilizando Luxon
function obtenerHoraColombia() {
    return DateTime.now().setZone('America/Bogota').toFormat('HH:mm');
}

function submit() {
    form.post('/entradas');
}

document.addEventListener("keyup", e=>{
    if (e.target.matches(".search")){
        if (e.key ==="Escape")e.target.value = ""
            document.querySelectorAll(".entrada").forEach(entrada=>{
                entrada.textContent.toLowerCase().includes(e.target.value.toLowerCase())
                ?entrada.classList.remove("filtro")
                :entrada.classList.add("filtro")
            })
        }
    })

</script>

<template>
    <AppLayout title="Create Entrada">

        <form action="" @submit.prevent="submit()">
            <div class="container text-center p-5 text-gray-900">
                <div class="row md-6 d-flex justify-center g-4">
                    <div class="col-10 d-flex flex-column">
                        <label for="fecha">Fecha</label>
                        <input id="fecha" type="date" v-model="form.fecha" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="hora">Hora</label>
                        <input id="hora" type="time" v-model="form.hora" class="w-100 bg-gray-400">
                    </div>
                    <!-- <div class="col-10 d-flex flex-column">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" type="number" v-model="form.cantidad" class="w-100 bg-gray-400" min="1" max="100000">
                    </div> -->
                    <div class="col-10 d-flex flex-column">
                        <label for="s">S</label>
                        <input id="s" type="number" v-model="form.s" class="w-100 bg-gray-400" max="100000">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="m">M</label>
                        <input id="m" type="number" v-model="form.m" class="w-100 bg-gray-400" max="100000">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="l">L</label>
                        <input id="l" type="number" v-model="form.l" class="w-100 bg-gray-400" max="100000">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="xl">XL</label>
                        <input id="xl" type="number" v-model="form.xl" class="w-100 bg-gray-400" max="100000">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="xxl">XXL</label>
                        <input id="xxl" type="number" v-model="form.xxl" class="w-100 bg-gray-400" max="100000">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="product_id">Producto</label>
                        <input id="search" type="search" class="search w-100 mb-3" placeholder="Filtrar Productos">
                        <select name="product_id" id="product_id" v-model="form.product_id" class="bg-gray-400">
                            <option class="entrada" v-for="producto in productos" :key="producto.id" :value="producto.id">{{ producto.nombre }}</option>
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