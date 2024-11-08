<template>
    <div class="p-6 max-w-7xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Manage Jobs</h2>
  
      <table class="w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border p-4 text-left">Title</th>
            <th class="border p-4 text-left">Category</th>
            <th class="border p-4 text-left">Budget</th>
            <th class="border p-4 text-left">Status</th>
            <th class="border p-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="job in jobs" :key="job.id">
            <td class="border p-4">{{ job.title }}</td>
            <td class="border p-4">{{ job.category_name }}</td>
            <td class="border p-4">{{ job.budget }}</td>
            <td class="border p-4">
              <span :class="statusClasses(job.status)">{{ job.status }}</span>
            </td>
            <td class="border p-4">
              <button @click="approveJob(job)" class="bg-green-500 text-white px-4 py-1 rounded mr-2" v-if="job.status === 'pending'">Approve</button>
              <button @click="deleteJob(job.id)" class="bg-red-500 text-white px-4 py-1 rounded">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
      <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const jobs = ref([]);
  const successMessage = ref('');
  const errorMessage = ref('');
  
  const fetchJobs = async () => {
    try {
      const response = await axios.get('/api/admin/jobs');
      jobs.value = response.data;
    } catch (error) {
      console.error("Failed to load jobs:", error);
    }
  };
  
  const approveJob = async (job) => {
    try {
      await axios.patch(`/api/admin/jobs/${job.id}/approve`);
      job.status = 'approved';
      successMessage.value = 'Job approved successfully!';
    } catch (error) {
      console.error("Failed to approve job:", error);
      errorMessage.value = 'Failed to approve job. Please try again.';
    }
  };
  
  const deleteJob = async (jobId) => {
    try {
      await axios.delete(`/api/admin/jobs/${jobId}`);
      jobs.value = jobs.value.filter(job => job.id !== jobId);
      successMessage.value = 'Job deleted successfully!';
    } catch (error) {
      console.error("Failed to delete job:", error);
      errorMessage.value = 'Failed to delete job. Please try again.';
    }
  };
  
  const statusClasses = (status) => {
    return status === 'approved' ? 'text-green-600 font-semibold' : 'text-yellow-600 font-semibold';
  };
  
  onMounted(fetchJobs);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  