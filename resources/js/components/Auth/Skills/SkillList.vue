<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-4">Skills</h2>
  
      <ul>
        <li v-for="skill in skills" :key="skill.id" class="border-b py-4">
          <div class="flex justify-between items-center">
            <span>{{ skill.name }}</span>
            <!-- View jobs by skill button -->
            <button @click="goToSkillJobs(skill.id)" class="text-indigo-600 hover:underline">
              View Jobs
            </button>
          </div>
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  
  const skills = ref([]);
  const router = useRouter();
  
  const fetchSkills = async () => {
    try {
      const response = await this.$axios.get('/skills');
      skills.value = response.data;
    } catch (error) {
      console.error("Failed to load skills:", error);
    }
  };
  
  // Function to navigate to jobs list filtered by skill
  const goToSkillJobs = (skillId) => {
    router.push({ name: 'JobList', query: { skill_id: skillId } });
  };
  
  onMounted(fetchSkills);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  