// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router'; 
import Home from './components/Auth/Home.vue';
import About from './components/Auth/About.vue';
import Contact from './components/Auth/Contact.vue';

import RoleSelection from './components/Auth/RoleSelection.vue';
import Register from './components/Auth/Register.vue';
import RegisterClientDetails from './components/Auth/RegisterClientDetails.vue';
import RegisterFreelancerDetails from './components/Auth/RegisterFreelancerDetails.vue';
import Login from './components/Auth/Login.vue';
import ClientDashboard from './components/Auth/Dashboard/ClientDashboard.vue';
import FreelancerDashboard from './components/Auth/Dashboard/FreelancerDashboard.vue';
import ClientProfile from './components/Auth/Profile/ClientProfile.vue';
//import FreelancerProfile from './components/Auth/Profile/FreelancerProfile.vue';



//import JobLists from './components/Auth/Jobs/JobListClient.vue';
import JobList from './components/Auth/Jobs/JobListFreelancer.vue';
import JobDetails from './components/Auth/Jobs/JobDetailspost.vue';
//import JobDetails from './components/Auth/Jobs/JobDetailsfreelancer.vue';
//import JobDetails from  './components/Auth/Jobs/ApplicationDetails.vue';
import JobApply from './components/Auth/Jobs/JobApply.vue';
import JobCreate from './components/Auth/Jobs/JobCreate.vue';
import JobApplication from './components/Auth/Jobs/FreelancerApplications.vue';
//import JobApply from './components/Auth/Jobs/JobApply.vue';
import Notifications from './components/Auth/Notifications.vue';
import Chat from './components/Auth/Chat.vue';
import ContractList from './components/Auth/Contracts/ContractList.vue';
import ContractDetails from './components/Auth/Contracts/ContractDetails.vue';
import ContractDashboard from './components/Auth/Contracts/ContractDashboard.vue';
import PaymentList from './components/Auth/Payments/PaymentList.vue';
import PaymentDetails from './components/Auth/Payments/PaymentDetails.vue';
import RatingForm from './components/Auth/Ratings/RatingForm.vue';
import RatingList from './components/Auth/Ratings/RatingList.vue';
import SkillList from './components/Auth/Skills/SkillList.vue';
//import SkillManage from './components/Auth/Skills/SkillManage.vue';
import CategoryList from './components/Auth/Categories/CategoryList.vue';
import EducationalStatus from './components/Auth/EducationalStatus.vue';


// Admin Components
import AdminDashboard from './components/Auth/admin/AdminDashboard.vue';
import ManageUsers from './components/Auth/admin/ManageUsers.vue';
import ManageJobs from './components/Auth/admin/ManageJobs.vue';
import ManageContracts from './components/Auth/admin/ManageContracts.vue';
import ManagePayments from './components/Auth/admin/ManagePayments.vue';
import ManageCategories from './components/Auth/admin/ManageCategories.vue';

const routes = [
  // Home Route
  { path: '/', component: Home, name: 'Home' },
  { path: '/about', component: About, name: 'About'},
  { path: '/Contact', component: Contact, name: 'Contact'},

  // Admin Routes
  { path: '/admin', component: AdminDashboard, name: 'AdminDashboard', meta: { requiresAuth: true, requiresAdmin: true } },
  { path: '/admin/users', component: ManageUsers, name: 'ManageUsers', meta: { requiresAuth: true, requiresAdmin: true } },
  { path: '/admin/jobs', component: ManageJobs, name: 'ManageJobs', meta: { requiresAuth: true, requiresAdmin: true } },
  { path: '/admin/contracts', component: ManageContracts, name: 'ManageContracts', meta: { requiresAuth: true, requiresAdmin: true } },
  { path: '/admin/payments', component: ManagePayments, name: 'ManagePayments', meta: { requiresAuth: true, requiresAdmin: true } },
  { path: '/admin/categories', component: ManageCategories, name: 'ManageCategories', meta: { requiresAuth: true, requiresAdmin: true } },

  // Role Selection and Auth Routes
  { path: '/role-selection', component: RoleSelection, name: 'RoleSelection' },
  { path: '/register', component: Register, name: 'Register' },
  { path: '/login', component: Login, name: 'Login' },

  //Client and Freelancer details
  {path: '/RegisterClientDetails', component: RegisterClientDetails, name: 'RegisterClientDetails'},
  {path: '/RegisterFreelancerDetails', component: RegisterFreelancerDetails, name: 'RegisterFreelancerDetails'},

  // Dashboard Routes
  { path: '/client-dashboard', component: ClientDashboard, name: 'ClientDashboard', meta: { requiresAuth: true } },
  { path: '/freelancer-dashboard', component: FreelancerDashboard, name: 'FreelancerDashboard', meta: { requiresAuth: true } },

  // Profile Routes
  { path: '/client-profile', component: ClientProfile, name: 'ClientProfile', meta: { requiresAuth: true } },
  //{ path: '/freelancer-profile', component: FreelancerProfile, name: 'FreelancerProfile', meta: { requiresAuth: true } },

  // Job Routes
  //{ path: '/jobs', component: JobListClient, name: 'JobListClient', meta: { requiresAuth: true } },
  { path: '/jobs/:id', component: JobDetails, name: 'JobDetails', props: true, meta: { requiresAuth: true } },
  { path: '/jobs/:id/apply', component: JobApply, name: 'JobApply', props: true, meta: { requiresAuth: true } },
  //{ path: '/applications/:id', component: ApplicationDetails, name: 'ApplicationDetails', props: true, meta: { requiresAuth: true } },

  // Freelancer Job Routes
  //{ path: '/freelancer-jobs', component: JobListFreelancer, name: 'JobListFreelancer', meta: { requiresAuth: true } },
  //{ path: '/freelancer-jobs/:id', component: JobDetailsFreelancer, name: 'JobDetailsFreelancer', props: true, meta: { requiresAuth: true } },
  { path: '/freelancer-applications', component: JobApplication, name: 'JobApplication', meta: { requiresAuth: true } },
  //{ path: '/freelancer-applications/:id', component: ApplicationDetails, name: 'ApplicationDetails', props: true, meta: { requiresAuth: true } },

  // Create Job Route
  { path: '/create-job', component: JobCreate, name: 'JobCreate', meta: { requiresAuth: true } },
  // Notification and Chat Routes
  { path: '/notifications', component: Notifications, name: 'Notifications', meta: { requiresAuth: true } },
  { path: '/chat', component: Chat, name: 'Chat', meta: { requiresAuth: true } },

  // Contract Routes
  // { path: '/contracts', component: ContractList, name: 'ContractList', meta: { requiresAuth: true } },
  { path: '/contracts/:id', component: ContractDetails, name: 'ContractDetails', props: true, meta: { requiresAuth: true } },
   { path: '/contracts , component: ContractDashboard', name: 'ContractDashboard',},

  // Payment Routes
  { path: '/payments', component: PaymentList, name: 'PaymentList', meta: { requiresAuth: true } },
  { path: '/payments/:id', component: PaymentDetails, name: 'PaymentDetails', props: true, meta: { requiresAuth: true } },

  // Rating Routes
  { path: '/ratings/new', component: RatingForm, name: 'RatingForm', meta: { requiresAuth: true } },
  { path: '/ratings', component: RatingList, name: 'RatingList', meta: { requiresAuth: true } },

  // Skill Routes
  { path: '/skills', component: SkillList, name: 'SkillList', meta: { requiresAuth: true } },
  // { path: '/manage-skills', component: SkillManage, name: 'SkillManage', meta: { requiresAuth: true } },

  // Category Route
  { path: '/categories', component: CategoryList, name: 'CategoryList', meta: { requiresAuth: true } },

  // Educational Status Route
  { path: '/educational-status', component: EducationalStatus, name: 'EducationalStatus', meta: { requiresAuth: true } },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Route Guard for Authentication and Role-Based Access Control
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  const role = localStorage.getItem('role');

  if (to.meta.requiresAuth && !token) {
    return next({ name: 'Login' });
  }

  if (to.meta.requiresAdmin && role !== 'admin') {
    return next({ name: 'Home' });
  }

  if (role === 'client' && to.path.includes('freelancer')) {
    return next({ name: 'ClientDashboard' });
  } else if (role === 'freelancer' && to.path.includes('client')) {
    return next({ name: 'FreelancerDashboard' });
  }

  next();
});

export default router;
