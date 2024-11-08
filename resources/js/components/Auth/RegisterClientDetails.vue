<template>
<div style="background-image: url('/images/hero/bg3.jpg');" class="relative w-full h-screen bg-cover bg-center">
    <div class="absolute inset-0 bg-black opacity-60 backdrop-blur-sm"></div>

    <div class="relative flex items-start justify-start h-full z-10 pl-20 pt-28">
      <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center justify-center mb-4">
          <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-500 text-white">
            <span class="text-lg font-bold">F</span>
          </div>
          <h2 class="ml-2 text-2xl font-semibold">Freelance-Hub</h2>
        </div>
        <h2 class="text-2xl font-semibold mb-4 text-center">Complete Your Client Details</h2>
        <form @submit.prevent="submitClientDetails">
          <!-- Phone Number -->
          <div class="mb-4">
            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input
              v-model="phone_number"
              type="text"
              id="phone_number"
              placeholder="Enter phone number"
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              required
            />
          </div>
   <!-- Status Dropdown -->
   <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select
              v-model="status"
              id="status"
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              required
            >
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          <!-- Address Dropdown -->
          <div class="mb-4">
            <label for="address_id" class="block text-sm font-medium text-gray-700">Address</label>
            <select
              v-model="address_id"
              id="address_id"
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              required
            >
              <option value="" disabled>Select your city</option>
              <option v-for="address in addresses" :key="address.id" :value="address.id">{{ address.name }}</option>
            </select>
          </div>
  
         
  
          <!-- Submit Button -->
          <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200"
          >
            Submit
          </button>
        </form>
      </div>
    </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const phone_number = ref('');
  const address_id = ref('');
  const status = ref(1); // Default to "Active"
  const addresses = ref([]);
  const userId = localStorage.getItem('user_id'); // Replace with proper auth handling in production
  const router = useRouter();
  
  // Fetch addresses from the backend
  const fetchAddresses = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/addresses');
      addresses.value = response.data;
    } catch (error) {
      console.error('Error fetching addresses:', error);
    }
  };
  
  // Call fetchAddresses when the component is mounted
  onMounted(() => {
    fetchAddresses();
  });
  
  // Submit client details to the backend
  const submitClientDetails = async () => {
    try {
      await axios.put(`http://localhost:8000/api/update-client-details/${userId}`, 
 {
        phone_number: phone_number.value,
        address_id: address_id.value,
        status: status.value,
      });
      alert('Client details submitted successfully!');
      router.push('/client-dashboard'); // Redirect to client dashboard
    }
    catch (error) {
  console.error('Error submitting client details:', error.response?.data || error.message);
  alert(error.response?.data?.message || 'An error occurred while submitting client details.');
}
  };
  </script>
  
  <style scoped>
  /* Add custom styles here if needed */
  </style>
  