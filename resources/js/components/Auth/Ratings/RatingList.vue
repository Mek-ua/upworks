<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">My Ratings</h2>
  
      <div v-if="ratings.length">
        <ul>
          <li v-for="rating in ratings" :key="rating.id" class="border-b py-4">
            <p class="font-semibold">Rating: {{ rating.rating }} / 5</p>
            <p class="text-gray-600 mb-2">Feedback: {{ rating.feedback }}</p>
            <p class="text-gray-500">Date: {{ rating.created_at }}</p>
          </li>
        </ul>
      </div>
      <div v-else>
        <p class="text-gray-600">No ratings available.</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  
  const ratings = ref([]);
  const router = useRouter();
  
  const fetchRatings = async () => {
    try {
      const response = await this.$axios.get(`/users/${localStorage.getItem('userId')}/ratings`);
      ratings.value = response.data;
    } catch (error) {
      console.error("Failed to load ratings:", error);
      router.push('/login');
    }
  };
  
  onMounted(fetchRatings);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  