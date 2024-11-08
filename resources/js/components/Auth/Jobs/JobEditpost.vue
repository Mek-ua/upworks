<template>
    <div class="p-6 max-w-lg mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Edit Job Post</h2>
      <form @submit.prevent="updateJob">
        <input
          v-model="jobData.title"
          type="text"
          placeholder="Job Title"
          class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
          required
        />
        <textarea
          v-model="jobData.description"
          placeholder="Job Description"
          class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
          rows="4"
          required
        ></textarea>
        <input
          v-model="jobData.budget"
          type="number"
          placeholder="Budget"
          class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
          required
        />
        <select
          v-model="jobData.category_id"
          class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
          required
        >
          <option value="">Select Category</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
        <div class="mb-4">
          <label>Select Skills:</label>
          <div class="grid grid-cols-2 gap-2">
            <div v-for="skill in skills" :key="skill.id" class="flex items-center">
              <input
                type="checkbox"
                :value="skill.id"
                v-model="selectedSkills"
                class="mr-2"
              />
              <label>{{ skill.name }}</label>
            </div>
          </div>
        </div>
        <button
          type="submit"
          :disabled="isLoading"
          class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed"
        >
          <span v-if="isLoading">Updating...</span>
          <span v-else>Save Changes</span>
        </button>
        <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter, useRoute } from 'vue-router';
  
  const jobData = ref({
    title: '',
    description: '',
    budget: '',
    category_id: ''
  });
  const selectedSkills = ref([]);
  const categories = ref([]);
  const skills = ref([]);
  const isLoading = ref(false);
  const errorMessage = ref('');
  const router = useRouter();
  const route = useRoute();
  
  const fetchJobDetails = async () => {
    try {
      const response = await this.$axios.get(`/job-posts/${route.params.id}`);
      Object.assign(jobData.value, response.data);
      selectedSkills.value = response.data.skills.map(skill => skill.id);
    } catch (error) {
      console.error("Failed to load job details:", error);
      router.replace('/client-dashboard');
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
  
  const updateJob = async () => {
    isLoading.value = true;
    errorMessage.value = '';
  
    try {
      await this.$axios.put(`/job-posts/${route.params.id}`, {
        ...jobData.value,
        skills: selectedSkills.value
      });
      router.push({
        path: '/client-dashboard',
        query: { success: 'Job updated successfully!' }
      });
    } catch (error) {
      console.error("Failed to update job post:", error);
      errorMessage.value = error.response?.data?.message || 'Failed to update job post. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  
  onMounted(() => {
    fetchJobDetails();
    fetchCategoriesAndSkills();
  });
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  