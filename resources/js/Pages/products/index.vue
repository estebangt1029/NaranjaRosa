<script setup>
    import AppLayout from "@/Layouts/AppLayout.vue";

 
    defineProps({
        products: Array,
    });
  
    document.addEventListener("keyup", e=>{
    if (e.target.matches(".search")){
        if (e.key ==="Escape")e.target.value = ""
            document.querySelectorAll(".producto").forEach(producto=>{
                producto.textContent.toLowerCase().includes(e.target.value.toLowerCase())
                ?producto.classList.remove("filtro")
                :producto.classList.add("filtro")
            })
        }
    })

</script>

<template>
    <AppLayout title="Products">
        <div class="container-fluid text-center mt-4">
            <div class="d-flex align-items-center justify-content-between p-3">
                <div class="d-flex align-items-center gap-1 w-75">
                    <input id="search" type="search" class="search w-75 rounded" placeholder="Filtrar Productos">
                    <a href="./products/create" class="btn btn-dark bg-gray-200 text-white hover:bg-gray-400">Crear Producto</a>
                </div>
                <div class="d-flex align-items-center gap-1">
                    <a :href="'/generar-pdf-productos'" class="btn btn-primary">PDF</a>
                    <a :href="'/generar-excel-productos'" class="btn btn-primary">EXCEL</a>
                </div>
            </div>
            <table class="table table-white table-hover bg-gray-900">
                <thead class="bg-gray-200 text-dark">
                    <tr>
                        <th>#</th>
                        <th>Referencia</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>S</th>
                        <th>M</th>
                        <th>L</th>
                        <th>XL</th>
                        <th>XXL</th>
                        <th>Stock</th>
                        <th>Acciones</th>

                    </tr>
                </thead>    
                <tbody class="bg-gray-400">
                    <tr v-for="product,i in products" class="producto">
                        <td>{{ i+1 }}</td>
                        <td>{{ product.referencia }}</td>
                        <td>{{ product.nombre }}</td>
                        <td>{{ product.cantidad }}</td>
                        <td>{{ product.s }}</td>
                        <td>{{ product.m }}</td>
                        <td>{{ product.l }}</td>
                        <td>{{ product.xl }}</td>
                        <td>{{ product.xxl }}</td>
                        <td>{{ product.stock }}</td>
                        <td class="d-flex justify-center">
                            <a :href="'/products/'+product.id+'/edit'" class="btn btn-warning w-50 p-1 d-flex justify-center" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                            <a :href="'/products/'+product.id+'/delete'" class="btn btn-danger w-50 p-1 d-flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </AppLayout>
</template>
<style>
    .filtro{
        display: none;
    }
</style>