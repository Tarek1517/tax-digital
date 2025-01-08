import { useAuthStore } from '@/stores/useAuthStore.js';

export default (to, from, next) => {
    const authStore = useAuthStore();
    if (authStore.token || authStore.type == 'admin') {
        next({ name: 'adminLogin' });
    } else {
        next();
    }
};
