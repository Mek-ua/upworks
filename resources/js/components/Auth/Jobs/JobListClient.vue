<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6">My Job Posts</h2>

    <!-- Success Message for Feedback -->
    <p v-if="successMessage" class="text-green-500 mb-4">{{ successMessage }}</p>

    <!-- Job Listings -->
    <div v-if="jobs.length > 0" class="space-y-4">
      <div
        v-for="job in jobs"
        :key="job.id"
        class="p-4 border rounded shadow-md flex justify-between items-center"
      >
        <div>
          <h3 class="text-xl font-semibold">{{ job.title }}</h3>
          <p class="text-gray-600">{{ job.description }}</p>
          <p class="text-sm text-gray-500">Budget: {{ job.budget }}</p>
        </div>
        <div class="flex space-x-4">
          <button
            @click="editJob(job.id)"
            class="bg-indigo-600 text-white py-1 px-4 rounded hover:bg-indigo-700"
          >
            Edit
          </button>
          <button
            @click="deleteJob(job.id)"
            class="bg-red-500 text-white py-1 px-4 rounded hover:bg-red-600"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
    
    <!-- No Jobs Message and Create New Job Button -->
    <div v-else>
      <p class="text-gray-500 mb-4">No job posts found. Create a new job post to get started!</p>
      <button
        @click="createNewJob"
        class="bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700"
      >
        Create New Job
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

const jobs = ref([]);
const successMessage = ref('');
const router = useRouter();
const route = useRoute();

const fetchJobs = async () => {
  try {
    const response = await this.$axios.get('/client/job-posts');
    jobs.value = response.data;

    // Display success message if redirected from edit or create
    if (route.query.success) {
      successMessage.value = route.query.success;
    }
  } catch (error) {
    console.error("Failed to load job posts:", error);
  }
};

const editJob = (jobId) => {
  router.push(`/edit-job/${jobId}`);
};

const deleteJob = async (jobId) => {
  if (confirm("Are you sure you want to delete this job post?")) {
    try {
      await this.$axios.delete(`/job-posts/${jobId}`);
      jobs.value = jobs.value.filter(job => job.id !== jobId);
      successMessage.value = "Job post deleted successfully.";
    } catch (error) {
      console.error("Failed to delete job post:", error);
      alert("Failed to delete job post. Please try again.");
    }
  }
};

const createNewJob = () => {
  router.push('/create-job');
};

onMounted(fetchJobs);
</script>

<style scoped>
/* Additional styling if needed */
</style>
