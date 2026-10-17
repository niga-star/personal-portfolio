import axios from 'axios'

const apiClient = axios.create({
  baseURL: '/api/v1',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  },
  timeout: 15000,
})

// Attach Bearer token for protected Admin endpoints
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem('portfolio_token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
}, (error) => {
  return Promise.reject(error)
})

// Response interceptor to handle session expiration (401 Unauthorized)
apiClient.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 401) {
      localStorage.removeItem('portfolio_token')
      window.dispatchEvent(new CustomEvent('auth:unauthorized'))
    }
    return Promise.reject(error)
  }
)

export const api = {
  // Public Endpoints
  getProfile() {
    return apiClient.get('/profile')
  },
  getProjects(params = {}) {
    return apiClient.get('/projects', { params })
  },
  getProject(slug) {
    return apiClient.get(`/projects/${slug}`)
  },
  getSkills() {
    return apiClient.get('/skills')
  },
  sendContact(payload) {
    return apiClient.post('/contact', payload)
  },
  getDownloadCvUrl() {
    return '/api/v1/download-cv'
  },

  // Auth Endpoints
  login(credentials) {
    return apiClient.post('/auth/login', credentials)
  },
  logout() {
    return apiClient.post('/auth/logout')
  },
  getCurrentUser() {
    return apiClient.get('/auth/user')
  },
  changePassword(data) {
    return apiClient.post('/admin/change-password', data)
  },

  // Admin Projects
  createProject(data) {
    return apiClient.post('/admin/projects', data)
  },
  updateProject(id, data) {
    return apiClient.put(`/admin/projects/${id}`, data)
  },
  deleteProject(id) {
    return apiClient.delete(`/admin/projects/${id}`)
  },

  // Admin Skills
  createSkill(data) {
    return apiClient.post('/admin/skills', data)
  },
  updateSkill(id, data) {
    return apiClient.put(`/admin/skills/${id}`, data)
  },
  deleteSkill(id) {
    return apiClient.delete(`/admin/skills/${id}`)
  },

  // Admin Experiences & Education
  createExperience(data) {
    return apiClient.post('/admin/experiences', data)
  },
  updateExperience(id, data) {
    return apiClient.put(`/admin/experiences/${id}`, data)
  },
  deleteExperience(id) {
    return apiClient.delete(`/admin/experiences/${id}`)
  },

  // Admin Messages
  getMessages() {
    return apiClient.get('/admin/messages')
  },
  markMessageRead(id) {
    return apiClient.put(`/admin/messages/${id}/read`)
  },
  deleteMessage(id) {
    return apiClient.delete(`/admin/messages/${id}`)
  },

  // Admin Profile Settings
  updateProfile(data) {
    return apiClient.put('/admin/profile', data)
  },
}

export default apiClient
