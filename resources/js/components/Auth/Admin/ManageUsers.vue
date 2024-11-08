<template>
    <div class="p-6 max-w-7xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Manage Users</h2>
  
      <table class="w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border p-4 text-left">Name</th>
            <th class="border p-4 text-left">Email</th>
            <th class="border p-4 text-left">Role</th>
            <th class="border p-4 text-left">Status</th>
            <th class="border p-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td class="border p-4">{{ user.name }}</td>
            <td class="border p-4">{{ user.email }}</td>
            <td class="border p-4">{{ user.role_name }}</td>
            <td class="border p-4">
              <span :class="statusClasses(user.status)">{{ user.status }}</span>
            </td>
            <td class="border p-4">
              <button @click="editUser(user)" class="bg-blue-500 text-white px-4 py-1 rounded mr-2">Edit</button>
              <button @click="toggleStatus(user)" class="bg-red-500 text-white px-4 py-1 rounded">
                {{ user.status === 'active' ? 'Deactivate' : 'Activate' }}
              </button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Modal for Editing User Role -->
      <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-md w-1/3">
          <h3 class="text-lg font-semibold mb-4">Edit User Role</h3>
          <label class="block mb-2">Role:</label>
          <select v-model="selectedUser.role_id" class="w-full px-4 py-2 border rounded">
            <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
          </select>
          <div class="mt-6 flex justify-end">
            <button @click="updateUserRole" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Save</button>
            <button @click="closeModal" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  
  const users = ref([]);
  const roles = ref([]);
  const showModal = ref(false);
  const selectedUser = ref({});
  const router = useRouter();
  
  const fetchUsers = async () => {
    try {
      const response = await axios.get('/api/admin/users');
      users.value = response.data;
    } catch (error) {
      console.error("Failed to load users:", error);
    }
  };
  
  const fetchRoles = async () => {
    try {
      const response = await axios.get('/api/roles');
      roles.value = response.data;
    } catch (error) {
      console.error("Failed to load roles:", error);
    }
  };
  
  const editUser = (user) => {
    selectedUser.value = { ...user }; // Copy user data
    showModal.value = true;
  };
  
  const updateUserRole = async () => {
    try {
      await axios.put(`/api/admin/users/${selectedUser.value.id}/role`, { role_id: selectedUser.value.role_id });
      await fetchUsers(); // Refresh the user list
      closeModal();
    } catch (error) {
      console.error("Failed to update user role:", error);
    }
  };
  
  const toggleStatus = async (user) => {
    try {
      const newStatus = user.status === 'active' ? 'inactive' : 'active';
      await axios.patch(`/api/admin/users/${user.id}/status`, { status: newStatus });
      user.status = newStatus; // Update status locally
    } catch (error) {
      console.error("Failed to toggle user status:", error);
    }
  };
  
  const closeModal = () => {
    showModal.value = false;
  };
  
  const statusClasses = (status) => {
    return status === 'active' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold';
  };
  
  onMounted(() => {
    fetchUsers();
    fetchRoles();
  });
  </script>
  
  <style scoped>
  /* Additional styles if needed */
  </style>
  