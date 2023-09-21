<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3"

const props = defineProps({
    entrada: Object,
    productos: Array, 
});

const form = useForm({
    fecha: props.entrada.fecha,
    hora: props.entrada.hora,
    cantidad: props.entrada.cantidad,
    product_id: props.entrada.product_id,
});

function submit() {
    // Utiliza el método 'put' para actualizar la entrada y pasa el ID de la entrada
    form.put(`/entradas/${props.entrada.id}`);
}
</script>


<template>
    <AppLayout title="Editar entrada">
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
                        <input id="cantidad" type="number" v-model="form.cantidad" class="w-100 bg-gray-400" min="1" disabled>
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
