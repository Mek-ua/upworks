<template>
    <div class="p-6 max-w-7xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Manage Categories</h2>
  
      <!-- Add New Category Form -->
      <form @submit.prevent="addCategory" class="mb-4">
        <input
          v-model="newCategory.name"
          type="text"
          placeholder="New Category Name"
          class="mr-2 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
          required
        />
        <button
          type="submit"
          :disabled="isLoading"
          class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition-colors disabled:bg-gray-400"
        >
          <span v-if="isLoading">Adding...</span>
          <span v-else>Add Category</span>
        </button>
      </form>
  
      <!-- Success/Error Messages -->
      <p v-if="successMessage" class="text-green-500 mb-4">{{ successMessage }}</p>
      <p v-if="errorMessage" class="text-red-500 mb-4">{{ errorMessage }}</p>
  
      <!-- Categories Table -->
      <table class="w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border p-4 text-left">ID</th>
            <th class="border p-4 text-left">Category Name</th>
            <th class="border p-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <td class="border p-4">{{ category.id }}</td>
            <td class="border p-4">
              <input
                v-if="editingId === category.id"
                v-model="category.name"
                type="text"
                class="px-2 py-1 border rounded"
              />
              <span v-else>{{ category.name }}</span>
            </td>
            <td class="border p-4">
              <button v-if="editingId === category.id" @click="updateCategory(category)" class="text-blue-600 mr-2">Save</button>
              <button v-else @click="startEditing(category)" class="text-blue-600 mr-2">Edit</button>
              <button @click="deleteCategory(category.id)" class="text-red-600">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const categories = ref([]);
  const newCategory = ref({ name: '' });
  const editingId = ref(null);
  const isLoading = ref(false);
  const successMessage = ref('');
  const errorMessage = ref('');
  
  const fetchCategories = async () => {
    try {
      const response = await axios.get('/api/admin/categories');
      categories.value = response.data;
    } catch (error) {
      console.error("Failed to load categories:", error);
    }
  };
  
  const addCategory = async () => {
    isLoading.value = true;
    errorMessage.value = '';
    successMessage.value = '';
  
    try {
      const response = await axios.post('/api/admin/categories', newCategory.value);
      categories.value.push(response.data);
      successMessage.value = "Category added successfully!";
      newCategory.value.name = '';
    } catch (error) {
      console.error("Failed to add category:", error);
      errorMessage.value = 'Failed to add category. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  
  const startEditing = (category) => {
    editingId.value = category.id;
  };
  
  const updateCategory = async (category) => {
    isLoading.value = true;
    errorMessage.value = '';
    successMessage.value = '';
  
    try {
      await axios.put(`/api/admin/categories/${category.id}`, { name: category.name });
      successMessage.value = "Category updated successfully!";
      editingId.value = null;
    } catch (error) {
      console.error("Failed to update category:", error);
      errorMessage.value = 'Failed to update category. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  
  const deleteCategory = async (categoryId) => {
    isLoading.value = true;
    errorMessage.value = '';
    successMessage.value = '';
  
    try {
      await axios.delete(`/api/admin/categories/${categoryId}`);
      categories.value = categories.value.filter((category) => category.id !== categoryId);
      successMessage.value = "Category deleted successfully!";
    } catch (error) {
      console.error("Failed to delete category:", error);
      errorMessage.value = 'Failed to delete category. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  
  onMounted(fetchCategories);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  