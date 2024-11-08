<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">{{ isEditing ? 'Edit' : 'Create' }} Contract</h2>
      <form @submit.prevent="submitContract">
        <!-- Job Application ID -->
        <div class="mb-4">
          <label for="jobApplyId" class="block text-gray-700">Job Application ID</label>
          <input v-model="formData.job_apply_id" type="number" id="jobApplyId" class="w-full mt-1 p-2 border rounded" placeholder="Enter Job Application ID" />
        </div>
  
        <!-- Job Post ID -->
        <div class="mb-4">
          <label for="jobPostId" class="block text-gray-700">Job Post ID</label>
          <input v-model="formData.job_post_id" type="number" id="jobPostId" class="w-full mt-1 p-2 border rounded" placeholder="Enter Job Post ID" />
        </div>
  
        <!-- Client ID -->
        <div class="mb-4">
          <label for="clientId" class="block text-gray-700">Client ID</label>
          <input v-model="formData.client_id" type="number" id="clientId" class="w-full mt-1 p-2 border rounded" placeholder="Enter Client ID" />
        </div>
  
        <!-- Freelancer ID -->
        <div class="mb-4">
          <label for="freelancerId" class="block text-gray-700">Freelancer ID</label>
          <input v-model="formData.freelancer_id" type="number" id="freelancerId" class="w-full mt-1 p-2 border rounded" placeholder="Enter Freelancer ID" />
        </div>
  
        <!-- Start Date -->
        <div class="mb-4">
          <label for="startDate" class="block text-gray-700">Start Date</label>
          <input v-model="formData.start_date" type="date" id="startDate" class="w-full mt-1 p-2 border rounded" />
        </div>
  
        <!-- End Date -->
        <div class="mb-4">
          <label for="endDate" class="block text-gray-700">End Date</label>
          <input v-model="formData.end_date" type="date" id="endDate" class="w-full mt-1 p-2 border rounded" />
        </div>
  
        <!-- Terms -->
        <div class="mb-4">
          <label for="terms" class="block text-gray-700">Terms</label>
          <textarea v-model="formData.terms" id="terms" class="w-full mt-1 p-2 border rounded" placeholder="Enter contract terms"></textarea>
        </div>
  
        <!-- Service Fee -->
        <div class="mb-4">
          <label for="serviceFee" class="block text-gray-700">Service Fee</label>
          <input v-model="formData.service_fee" type="number" id="serviceFee" class="w-full mt-1 p-2 border rounded" placeholder="Enter service fee" />
        </div>
  
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          {{ isEditing ? 'Update Contract' : 'Create Contract' }}
        </button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import axios from 'axios';
  
  const formData = ref({
    job_apply_id: '',
    job_post_id: '',
    client_id: '',
    freelancer_id: '',
    start_date: '',
    end_date: '',
    terms: '',
    service_fee: null,
  });
  
  const isEditing = ref(false);
  const route = useRoute();
  const router = useRouter();
  
  // Check if editing mode is enabled
  onMounted(() => {
    if (route.params.id) {
      isEditing.value = true;
      fetchContractDetails();
    }
  });
  
  // Fetch contract details for editing
  const fetchContractDetails = async () => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/contracts/${route.params.id}`, {
        headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
      });
      formData.value = response.data;
    } catch (error) {
      console.error("Failed to load contract details:", error);
      router.push('/contracts');
    }
  };
  
  // Submit the form data for creating or updating a contract
  const submitContract = async () => {
    try {
      const url = isEditing.value
        ? `http://127.0.0.1:8000/api/contracts/${route.params.id}`
        : 'http://127.0.0.1:8000/api/contracts';
  
      await axios.post(url, formData.value, {
        headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
      });
      alert(`${isEditing.value ? 'Contract updated' : 'Contract created'} successfully!`);
      router.push('/contracts');
    } catch (error) {
      console.error("Error submitting contract:", error);
      alert('Failed to submit contract. Please check your input and try again.');
    }
  };
  </script>
  
  <style scoped>
  /* Add additional styling if needed */
  </style>
  