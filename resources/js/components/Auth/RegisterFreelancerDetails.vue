<template>
  <div style="background-image: url('/images/hero/bg3.jpg');" class="relative w-full h-screen bg-cover bg-center">
    <div class="absolute inset-0 bg-black opacity-60 backdrop-blur-sm"></div>
    <div class="relative flex items-start justify-start h-full z-10 pl-24 pt-10">
      <div class="w-full max-w-sm bg-white p-2 rounded-lg shadow-lg">
        <div class="flex items-center justify-center mb-2">
          <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-500 text-white">
            <span class="text-md font-bold">F</span>
          </div>
          <h2 class="ml-1 text-xl font-semibold">Freelance-Hub</h2>
        </div>
        <h2 class="text-lg font-medium mb-3 text-center">Complete Your Freelancer Details</h2>
        <form @submit.prevent="submitFreelancerDetails" enctype="multipart/form-data">
          <!-- Experience -->
          <div class="mb-2">
            <label for="experience" class="block text-md font-medium text-gray-700">Experience</label>
            <input 
              v-model="experience"
              type="text"
              id="experience"
              placeholder="Enter experience"
              class="mt-1 text-sm block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              required
            />
          </div>

          <!-- Skills Multiselect -->
          <div class="mb-2">
            <label for="skills" class="block text-md font-medium text-gray-700">Skills</label>
            <select
              v-model="selectedSkills"
              id="skills"
              class="mt-1 text-gray-800 text-sm block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              multiple
              required
            >
              <option v-for="skill in skills" :key="skill.id" :value="skill.id">{{ skill.name }}</option>
            </select>
          </div>

          <!-- Address Dropdown -->
          <div class="mb-2">
            <label for="address_id" class="block text-md font-medium text-gray-700">Address</label>
            <select
              v-model="address_id"
              id="address_id"
              class="mt-1 text-sm block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              required
            >
              <option value="" disabled>Select your city</option>
              <option v-for="address in addresses" :key="address.id" :value="address.id">{{ address.name }}</option>
            </select>
          </div>

          <!-- Educational Status Dropdown -->
          <div class="mb-2">
            <label for="educational_status_id" class="block text-md font-medium text-gray-700">Educational Status</label>
            <select
              v-model="educational_status_id"
              id="educational_status_id"
              class="mt-1 text-sm block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              required
            >
              <option value="" disabled>Select your educational status</option>
              <option v-for="status in educationalStatuses" :key="status.id" :value="status.id">{{ status.name }}</option>
            </select>
          </div>

          <!-- Status Dropdown -->
          <div class="mb-2">
            <label for="status" class="block text-md font-medium text-gray-700">Status</label>
            <select
              v-model="status"
              id="status"
              class="mt-1 text-sm block w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              required
            >
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>

          <!-- Portfolio File Upload -->
          <div class="mb-2">
            <label for="portfolio" class="block text-md font-medium text-gray-700">Portfolio</label>
            <input
              ref="portfolio"
              type="file"
              id="portfolio"
              class="mt-1 block text-sm w-full px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
              @change="handleFileUpload"
            />
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            class="w-full text-md bg-blue-600 text-white py-1 rounded-md hover:bg-blue-700 transition duration-200"
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

// Form fields
const experience = ref('');
const selectedSkills = ref([]);
const address_id = ref('');
const educational_status_id = ref('');
const status = ref(1); // Default to "Active"
const portfolioFile = ref(null);
const addresses = ref([]);
const educationalStatuses = ref([]);
const skills = ref([]);
const userId = localStorage.getItem('user_id'); // Replace with proper auth handling in production
const router = useRouter();

// Set up Axios to include the token globally
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;

// Fetch data from the backend
const fetchData = async () => {
  try {
    const addressResponse = await axios.get('http://127.0.0.1:8000/api/addresses');
    addresses.value = addressResponse.data;

    const educationalStatusResponse = await axios.get('http://127.0.0.1:8000/api/educational-status');
    educationalStatuses.value = educationalStatusResponse.data;

    const skillsResponse = await axios.get('http://127.0.0.1:8000/api/skills');
    skills.value = skillsResponse.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};

// Call fetchData when the component is mounted
onMounted(() => {
  fetchData();
});

// Handle file upload
const handleFileUpload = (event) => {
  portfolioFile.value = event.target.files[0];
};

// Submit freelancer details to the backend
const submitFreelancerDetails = async () => {
  try {
    const formData = new FormData();
    formData.append('experience', experience.value);
    formData.append('skills', JSON.stringify(selectedSkills.value)); // Sending as JSON string
    formData.append('address_id', address_id.value);
    formData.append('educational_status_id', educational_status_id.value || '');
    formData.append('status', status.value);
    if (portfolioFile.value) {
      formData.append('portfolio', portfolioFile.value);
    }

    // Log the FormData content to check what is being sent
    for (let pair of formData.entries()) {
      console.log(`${pair[0]}: ${pair[1]}`);
    }

    await axios.put(`http://localhost:8000/api/update-freelancer-details/${userId}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });

    alert('Freelancer details submitted successfully!');
    router.push('/freelancer-dashboard');
  } catch (error) {
    console.error('Error submitting freelancer details:', error.response?.data || error.message);

    // Handle backend validation errors
    if (error.response && error.response.data && error.response.data.errors) {
      const errorMessages = Object.values(error.response.data.errors).flat();
      alert(`Errors:\n${errorMessages.join('\n')}`);
    } else {
      alert('An error occurred while submitting freelancer details.');
    }
  }
};



</script>

<style scoped>
/* Add custom styles here if needed */
</style>
