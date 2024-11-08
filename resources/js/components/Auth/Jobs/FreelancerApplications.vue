<template>
    <div class="p-6">
      <h2 class="text-2xl font-semibold mb-4">My Job Applications</h2>
      <ul>
        <li v-for="application in applications" :key="application.id" class="border-b py-4">
          <p><strong>Job Title:</strong> {{ application.jobPost.title }}</p>
          <p><strong>Cover Letter:</strong> {{ application.cover_letter }}</p>
          <p><strong>Proposed Rate:</strong> {{ application.proposed_rate }}</p>
          <p><strong>Status:</strong> {{ application.status }}</p>
          <button
            v-if="application.status === 'pending'"
            @click="withdrawApplication(application.id)"
            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 mt-2"
          >
            Withdraw Application
          </button>
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const applications = ref([]);
  
  const fetchApplications = async () => {
    try {
      const response = await this.$axios.get('/freelancer/applications');
      applications.value = response.data;
    } catch (error) {
      console.error("Failed to load applications:", error);
    }
  };
  
  const withdrawApplication = async (applicationId) => {
    try {
      await this.$axios.delete(`/applications/${applicationId}/withdraw`);
      applications.value = applications.value.filter(app => app.id !== applicationId); // Remove withdrawn application from list
      alert("Application withdrawn successfully.");
    } catch (error) {
      console.error("Failed to withdraw application:", error);
    }
  };
  
  onMounted(fetchApplications);
  </script>
  