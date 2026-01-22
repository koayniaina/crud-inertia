<template>
  <div class="container">
    <h2>All Products</h2>

    <!-- Bouton Create -->
    <div class="mb-4">
      <Link
        :href="route('products.create')"
        class="btn btn-primary"
      >
        Create Product
      </Link>
    </div>

    <!-- Table des produits -->
    <table class="table-auto border-collapse border border-gray-300 w-full m-10">
      <thead>
        <tr class="bg-gray-200">
          <th class="border px-4 py-2">Id</th>
          <th class="border px-4 py-2">Title</th>
          <th class="border px-4 py-2">Description</th>
          <th class="border px-4 py-2">Price</th>
          <th class="border px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in products"
          :key="item.id"
          class="hover:bg-gray-100"
        >
          <td class="border px-4 py-2">{{ item.id }}</td>
          <td class="border px-4 py-2">{{ item.title }}</td>
          <td class="border px-4 py-2">{{ item.description }}</td>
          <td class="border px-4 py-2">{{ item.price }}</td>
          <td class="border px-4 py-2 flex gap-2">
            <!-- Edit -->
            <Link
              :href="route('products.edit', item.id)"
              class="btn btn-sm btn-warning"
            >
              Edit
            </Link>

            <!-- Delete -->
            <button
              @click="deleteProduct(item.id)"
              class="btn btn-sm btn-danger"
            >
              Delete
            </button>
          </td>
        </tr>
        <tr v-if="products.length === 0">
          <td colspan="5" class="text-center py-4">No products found.</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { ref } from 'vue'

// Props passées depuis le controller
defineProps({
  products: Array
})

// Fonction de suppression
const deleteProduct = (id) => {
  if (confirm('Are you sure you want to delete this product?')) {
    router.delete(route('products.destroy', id), {
      onSuccess: () => {
        console.log(`Product ${id} deleted`)
      },
      onError: (errors) => {
        console.error(errors)
      }
    })
  }
}
</script>

<style>
.btn {
  padding: 0.4rem 0.8rem;
  border-radius: 0.25rem;
  cursor: pointer;
  text-decoration: none;
  color: white;
}

.btn-primary { background-color: #2563eb; }
.btn-warning { background-color: #f59e0b; }
.btn-danger { background-color: #dc2626; }

.btn-sm { font-size: 0.8rem; padding: 0.2rem 0.5rem; }
</style>
