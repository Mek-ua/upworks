<template>
    <div class="p-6 max-w-4xl mx-auto">
      <h2 class="text-2xl font-semibold mb-6">Browse Jobs</h2>
  
      <!-- Filters -->
      <div class="flex mb-6 space-x-4">
        <select v-model="filters.category_id" @change="fetchJobs" class="px-4 py-2 border rounded">
          <option value="">All Categories</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
        <select v-model="filters.skill_id" @change="fetchJobs" class="px-4 py-2 border rounded">
          <option value="">All Skills</option>
          <option v-for="skill in skills" :key="skill.id" :value="skill.id">
            {{ skill.name }}
          </option>
        </select>
        <input
          v-model.number="filters.budget"
          type="number"
          placeholder="Max Budget"
          @input="fetchJobs"
          class="px-4 py-2 border rounded"
        />
      </div>
  
      <!-- Job Listings -->
      <ul>
        <li v-for="job in jobs" :key="job.id" class="border-b py-2">
          <router-link :to="`/jobs/${job.id}`" class="text-indigo-600">
            {{ job.title }}
          </router-link>
          <p class="text-gray-600">{{ job.description }}</p>
          <p class="text-gray-500">Budget: {{ job.budget }}</p>
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const jobs = ref([]);
  const categories = ref([]);
  const skills = ref([]);
  const filters = ref({
    category_id: '',
    skill_id: '',
    budget: ''
  });
  
  const fetchJobs = async () => {
    try {
      const response = await this.$axios.get('/job-posts', { params: filters.value });
      jobs.value = response.data;
    } catch (error) {
      console.error("Failed to load jobs:", error);
    }
  };
  
  const fetchCategoriesAndSkills = async () => {
    try {
      const categoryResponse = await this.$axios.get('/categories');
      const skillResponse = await this.$axios.get('/skills');
      categories.value = categoryResponse.data;
      skills.value = skillResponse.data;
    } catch (error) {
      console.error("Failed to load categories or skills:", error);
    }
  };
  
  onMounted(() => {
    fetchCategoriesAndSkills();
    fetchJobs();
  });
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  