<template>
  <div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Freelancer Profile</h2>

    <!-- Profile Form -->
    <form @submit.prevent="updateProfile" class="mb-6">
      <input
        v-model="freelancer.full_name"
        type="text"
        placeholder="Full Name"
        class="mb-4 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
      />
      <input
        v-model="freelancer.email"
        type="email"
        placeholder="Email"
        class="mb-4 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
      />
      <input
        v-model="freelancer.experience"
        type="text"
        placeholder="Experience"
        class="mb-4 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
      />
      <select
        v-model="freelancer.educational_status_id"
        class="mb-4 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
      >
        <option v-for="status in educationalStatuses" :key="status.id" :value="status.id">
          {{ status.name }}
        </option>
      </select>
      <button
        type="submit"
        class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition-colors"
      >
        Update Profile
      </button>
    </form>

    <!-- Skills Management -->
    <div class="mb-6">
      <h3 class="text-lg font-semibold mb-2">Manage Skills</h3>
      <ul>
        <li v-for="skill in freelancerSkills" :key="skill.id" class="flex justify-between items-center py-2 border-b">
          <span>{{ skill.name }}</span>
          <button @click="removeSkill(skill.id)" class="text-red-500">Remove</button>
        </li>
      </ul>

      <select v-model="selectedSkill" class="mt-4 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option disabled value="">Select a Skill to Add</option>
        <option v-for="skill in availableSkills" :key="skill.id" :value="skill.id">
          {{ skill.name }}
        </option>
      </select>
      <button
        @click="addSkill"
        class="mt-2 w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition-colors"
      >
        Add Skill
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from '../api';

const freelancer = ref({});
const freelancerSkills = ref([]);
const availableSkills = ref([]);
const educationalStatuses = ref([]);
const selectedSkill = ref(null);

const fetchFreelancerProfile = async () => {
  try {
    const response = await axios.get('/api/freelancer/profile');
    freelancer.value = response.data;
  } catch (error) {
    console.error("Failed to load freelancer profile:", error);
  }
};

const fetchFreelancerSkills = async () => {
  try {
    const response = await axios.get(`/api/freelancers/${freelancer.value.id}/skills`);
    freelancerSkills.value = response.data;
  } catch (error) {
    console.error("Failed to load freelancer skills:", error);
  }
};

const fetchAvailableSkills = async () => {
  try {
    const response = await axios.get('/api/skills');
    availableSkills.value = response.data;
  } catch (error) {
    console.error("Failed to load available skills:", error);
  }
};

const fetchEducationalStatuses = async () => {
  try {
    const response = await axios.get('/api/educational-status');
    educationalStatuses.value = response.data;
  } catch (error) {
    console.error("Failed to load educational statuses:", error);
  }
};

const updateProfile = async () => {
  try {
    await axios.put('/api/freelancer/profile', freelancer.value);
    alert('Profile updated successfully');
  } catch (error) {
    console.error("Failed to update profile:", error);
    alert('Failed to update profile');
    router.push('/login');
  }
};

const addSkill = async () => {
  if (!selectedSkill.value) return;

  try {
    await axios.post(`/api/freelancers/${freelancer.value.id}/skills`, {
      skill_ids: [selectedSkill.value]
    });
    alert('Skill added successfully');
    fetchFreelancerSkills(); // Refresh the freelancer's skills
  } catch (error) {
    console.error("Failed to add skill:", error);
    alert('Failed to add skill');
  }
};

const removeSkill = async (skillId) => {
  try {
    await axios.delete(`/api/freelancers/${freelancer.value.id}/skills/${skillId}`);
    alert('Skill removed successfully');
    fetchFreelancerSkills(); // Refresh the freelancer's skills
  } catch (error) {
    console.error("Failed to remove skill:", error);
    alert('Failed to remove skill');
  }
};

onMounted(() => {
  fetchFreelancerProfile();
  fetchFreelancerSkills();
  fetchAvailableSkills();
  fetchEducationalStatuses();
});
</script>

<style scoped>
/* Additional styles if needed */
</style>
