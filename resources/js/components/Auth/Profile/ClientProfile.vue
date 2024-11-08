<template>
  <div class="p-6 max-w-lg mx-auto bg-white rounded shadow-md">
    <h2 class="text-2xl font-semibold mb-6">Client Profile</h2>
    <form @submit.prevent="updateProfile">
      <input
        v-model="profile.full_name"
        type="text"
        placeholder="Full Name"
        class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required
      />
      <input
        v-model="profile.email"
        type="email"
        placeholder="Email"
        class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
        required
      />
      <input
        v-model="profile.phone_number"
        type="text"
        placeholder="Phone Number"
        class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
      />
      <select
        v-model="profile.address_id"
        class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
      >
        <option value="">Select Address</option>
        <option v-for="address in addresses" :key="address.id" :value="address.id">
          {{ address.name }}
        </option>
      </select>

      <!-- Status Field -->
      <select
        v-model="profile.status"
        class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
      >
        <option value="">Select Status</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>

      <button
        type="submit"
        :disabled="isLoading"
        class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed"
      >
        <span v-if="isLoading">Saving...</span>
        <span v-else>Save Changes</span>
      </button>
      <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
      <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
    </form>
    <router-link to="/client/change-password" class="block mt-6 text-indigo-600">
      Change Password
    </router-link>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';

const profile = ref({
  full_name: '',
  email: '',
  phone_number: '',
  address_id: '',
  status: ''
});
const addresses = ref([]);
const errorMessage = ref('');
const successMessage = ref('');
const isLoading = ref(false);
const router = useRouter();

const fetchProfile = async () => {
  try {
    const response = await this.$axios.get('/client/profile');
    Object.assign(profile.value, response.data);
  } catch (error) {
    console.error("Failed to load profile:", error);
    router.push('/login');
  }
};

const fetchAddresses = async () => {
  try {
    const response = await this.$axios.get('/addresses');
    addresses.value = response.data;
  } catch (error) {
    console.error("Failed to load addresses:", error);
  }
};

const updateProfile = async () => {
  isLoading.value = true;
  errorMessage.value = '';
  successMessage.value = '';

  try {
    await this.$axios.put('/client/profile', profile.value);
    successMessage.value = 'Profile updated successfully!';
  } catch (error) {
    console.error("Failed to update profile:", error);
    errorMessage.value = error.response?.data?.message || 'Failed to update profile.';
  } finally {
    isLoading.value = false;
  }
};

onMounted(() => {
  fetchProfile();
  fetchAddresses();
});
</script>

<style scoped>
/* Additional styling if needed */
</style>
