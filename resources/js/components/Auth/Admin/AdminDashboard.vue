<template>
  <div class="p-6 max-w-7xl mx-auto bg-gray-50 rounded shadow-md">
    <h2 class="text-3xl font-semibold mb-6">Admin Dashboard</h2>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="section in dashboardSections"
        :key="section.name"
        class="p-4 bg-white border rounded shadow hover:bg-gray-100 transition cursor-pointer"
        @click="navigateTo(section.routeName)"
      >
        <h3 class="text-xl font-semibold">{{ section.title }}</h3>
        <p class="text-gray-600">{{ section.description }}</p>
      </div>
    </div>

    <!-- Data Display -->
    <div v-if="selectedData.length" class="mt-8">
      <h3 class="text-2xl font-semibold mb-4">{{ selectedSectionTitle }}</h3>
      <table class="min-w-full border-collapse border border-gray-200">
        <thead>
          <tr>
            <th v-for="column in columns" :key="column" class="border px-4 py-2">{{ column }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in selectedData" :key="index">
            <td v-for="(value, key) in item" :key="key" class="border px-4 py-2">{{ value }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <p v-else-if="selectedSectionTitle" class="text-gray-600 mt-4">No data available for {{ selectedSectionTitle }}.</p>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const selectedData = ref([]);
const selectedSectionTitle = ref('');
const columns = ref([]);

const dashboardSections = [
  { name: 'users', title: 'Manage Users', description: 'View, edit, and manage all users.', routeName: 'listUsers' },
  { name: 'jobs', title: 'Manage Jobs', description: 'Review and manage job postings.', routeName: 'listJobs' },
  { name: 'contracts', title: 'Manage Contracts', description: 'Monitor and review contracts.', routeName: 'listContracts' },
  { name: 'payments', title: 'Manage Payments', description: 'Review payments and refund requests.', routeName: 'listPayments' },
  { name: 'categories', title: 'Manage Categories', description: 'Organize and edit job categories.', routeName: 'listCategories' },
];

const navigateTo = async (routeName) => {
  try {
    const response = await axios.get(`/api/admin/${routeName}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    });
    selectedData.value = response.data;
    selectedSectionTitle.value = dashboardSections.find(section => section.routeName === routeName)?.title || '';
    columns.value = selectedData.value.length ? Object.keys(selectedData.value[0]) : [];
  } catch (error) {
    console.error(`Failed to load data for ${routeName}:`, error);
    selectedData.value = [];
    selectedSectionTitle.value = `Error loading ${routeName}`;
  }
};
</script>

<style scoped>
/* Add custom styling if needed */
</style>
