<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3"

const props = defineProps({
    salida: Object,
    productos: Array, 
});

const form = useForm({
    fecha: props.salida.fecha,
    hora: props.salida.hora,
    cantidad: props.salida.cantidad,
    cliente: props.salida.cliente,
    product_id: props.salida.product_id,
});

function submit() {
    // Utiliza el método 'put' para actualizar la salida y pasa el ID de la salida
    form.put(`/salidas/${props.salida.id}`);
}
</script>


<template>
    <AppLayout title="Editar salida">
        <form action="" @submit.prevent="submit()">
            <div class="container text-center p-5 text-dark">
                <div class="row md-6 d-flex justify-center g-4">
                    <div class="col-10 d-flex flex-column">
                        <label for="fecha">Fecha</label>
                        <input id="fecha" type="date" v-model="form.fecha" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="hora">Hora</label>
                        <input id="hora" type="time" v-model="form.hora" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" type="number" v-model="form.cantidad" class="w-100 bg-gray-400">
                    </div>
                    <div class="col-10 d-flex flex-column">
                        <label for="cliente">Cliente</label>
                        <select name="Cliente" id="cliente" v-model="form.cliente" class="bg-gray-400">
                            <option value="pagina">Pagina</option>
                            <option value="local">Local</option>
                            <option value="mayorista">Mayorista</option>
                        </select>
                    </div>
                    <div class="col-10 d-flex flex-column">

                        <label for="product_id">Producto</label>
                        <select name="product_id" id="product_id" v-model="form.product_id" class="bg-gray-400">
                            <option v-for="producto in productos" :key="producto.id" :value="producto.id">{{ producto.nombre }}</option>
                        </select>
                    </div>
                    <button class="btn bg-dark text-white col-3" type="submit">Actualizar</button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
