<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-4">Job Categories</h2>
      
      <ul>
        <li v-for="category in categories" :key="category.id" class="border-b py-4">
          <div class="flex justify-between items-center">
            <span>{{ category.name }}</span>
            <!-- Button to view jobs in the selected category -->
            <button @click="goToCategoryJobs(category.id)" class="text-indigo-600 hover:underline">
              View Jobs
            </button>
          </div>
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  
  const categories = ref([]);
  const router = useRouter();
  
  // Fetch categories from the backend
  const fetchCategories = async () => {
    try {
      const response = await this.$axios.get('/categories');
      categories.value = response.data;
    } catch (error) {
      console.error("Failed to load categories:", error);
    }
  };
  
  // Function to navigate to jobs list with category filter
  const goToCategoryJobs = (categoryId) => {
    router.push({ name: 'JobList', query: { category_id: categoryId } });
  };
  
  onMounted(fetchCategories);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  