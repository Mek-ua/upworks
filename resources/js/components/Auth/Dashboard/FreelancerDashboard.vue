<template>
  <div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Freelancer Dashboard</h2>
    <div class="mb-6">
      <h3 class="text-lg font-semibold mb-2">Available Jobs</h3>
      <ul>
        <li v-for="job in availableJobs" :key="job.id" class="border-b py-2">
          <router-link :to="`/jobs/${job.id}`" class="text-indigo-600">
            {{ job.title }}
          </router-link>
          <p class="text-gray-600">{{ job.description }}</p>
        </li>
      </ul>
    </div>
    <div>
      <h3 class="text-lg font-semibold mb-2">Your Applications</h3>
      <ul>
        <li v-for="application in applications" :key="application.id" class="border-b py-2">
          <p>Job Title: {{ application.job_title }}</p>
          <p>Status: {{ application.status }}</p>
          <router-link :to="`/applications/${application.id}`" class="text-indigo-600">View Details</router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';

const availableJobs = ref([]);
const applications = ref([]);
const router = useRouter();

onMounted(async () => {
  try {
    // Fetch available jobs for the freelancer based on skills or other criteria
    const jobResponse = await this.axios.get('/freelancer/jobs');
    availableJobs.value = jobResponse.data;

    // Fetch freelancer's own applications
    const applicationResponse = await this.axios.get('/freelancer/applications');
    applications.value = applicationResponse.data;
  } catch (error) {
    console.error("Failed to load freelancer dashboard data:", error);
    
    // Redirect to login if there's an error (e.g., due to unauthorized access)
    alert("Session expired. Please log in again.");
    router.push('/login');
  }
});
</script>

<style scoped>
/* Custom styling if needed */
</style>
