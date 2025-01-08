import { defineStore } from "pinia";
import { ref, computed } from "vue";
import useAxios from "@/composables/useAxios";
import { useRouter } from "vue-router";
import axios from 'axios';

export const useAuthStore = defineStore("auth", () => {
  const router = useRouter();
  const user = ref(JSON.parse(localStorage.getItem("user")) || null);
  const admin = ref(JSON.parse(localStorage.getItem("admin")) || null);
  const type = ref(localStorage.getItem("type") || null);

  const isLoggedIn = computed(() => !!user.value);
  const isAdminLoggedIn = computed(() => !!admin.value);

  const { loading, error, sendRequest } = useAxios();

  function setLocalStorage(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
  }

  async function fetchUser() {
    const storedUser = JSON.parse(localStorage.getItem("user"));
    if (storedUser) {
      try {
        const { data } = await sendRequest({
          method: "get",
          url: "/user",
          headers: {
            Authorization: `Bearer ${storedUser.token}`,
          },
        });
        if (data) {
          user.value = data; // Update user data if valid
        } else {
          clearLocalStorage();
        }
      } catch (err) {
        clearLocalStorage();
      }
    } else {
      clearLocalStorage();
    }
  }

  async function login(credential) {
    try {

      axios.get(`${import.meta.env.VITE_APP_URL}/sanctum/csrf-cookie`);

      const loginResponse = await sendRequest({
        method: "post",
        url: "/login",
        data: credential,
      });
      if (loginResponse.data) {
        setLocalStorage("user", loginResponse.data);
        user.value = loginResponse.data;
        return loginResponse;
      }
    } catch (err) {
      throw err;
    }
  }

  async function adminLogin(credential) {
    try {
      // Ensure CSRF token is set
      await axios.get(`${import.meta.env.VITE_APP_URL}/sanctum/csrf-cookie`);

      const loginResponse = await sendRequest({
        method: "post",
        url: "/admin/login",
        data: credential,
      });

      if (loginResponse.data) {
        const { token, user, type: userType } = loginResponse.data;

        // Save admin and type in localStorage
        setLocalStorage("admin", { token, user });
        localStorage.setItem("type", userType);

        // Update reactive state
        admin.value = { token, user };
        type.value = userType;

        return loginResponse;
      }
    } catch (err) {
      console.error("Admin login failed:", err);
      throw err;
    }
  }

  async function register(signupData) {
    try {
      const response = await sendRequest({
        method: "post",
        url: "/customer/register",
        data: signupData,
      });

      if (response?.data) {
        setLocalStorage("user", response.data);
        user.value = response.data;
        return response;
      }
    } catch (err) {
      throw err;
    }
  }

  async function logout() {
    try {
      await sendRequest({
        url: "/api/logout",
        method: "get",
      });
      user.value = null;
      clearLocalStorage("user");
      router.push({ name: "Home" });
    } catch (err) {
      console.error("Logout failed", err);
    }
  }

  async function adminLogout() {
    try {
      await sendRequest({
        url: "/api/logout",
        method: "get",
      });
      admin.value = null;
      clearLocalStorage("admin");
      router.push({ name: "adminLogin" });
    } catch (err) {
      console.error("Logout failed", err);
    }
  }

  function setLocalStorage(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
  }

  function clearLocalStorage(key) {
    localStorage.removeItem(key);
  }

  function getToken() {
    return JSON.parse(localStorage.getItem("user"))?.token || null;
  }

  return {
    user,
    admin,
    login,
    adminLogin,
    register,
    fetchUser,
    logout,
    isLoggedIn,
    isAdminLoggedIn,
    loading,
    error,
    getToken,
    adminLogout,
  };
});
