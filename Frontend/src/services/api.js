import axios from 'axios'

const apiClient = axios.create({
  baseURL: '/api/v1',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  },
  timeout: 10000,
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

  // Admin Endpoints
  createProject(data) {
    return apiClient.post('/admin/projects', data)
  },
  updateProject(id, data) {
    return apiClient.put(`/admin/projects/${id}`, data)
  },
  deleteProject(id) {
    return apiClient.delete(`/admin/projects/${id}`)
  },
  getMessages() {
    return apiClient.get('/admin/messages')
  },
  markMessageRead(id) {
    return apiClient.put(`/admin/messages/${id}/read`)
  },
  deleteMessage(id) {
    return apiClient.delete(`/admin/messages/${id}`)
  },
  updateProfile(data) {
    return apiClient.put('/admin/profile', data)
  },
}

export default apiClient
