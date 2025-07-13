import { onMounted, ref } from 'vue';

const isOpenLeftPanel = ref<number>(1);

const setCookie = (name: string, value: string, days = 365) => {
    if (typeof document === 'undefined') {
        return;
    }

    const maxAge = days * 24 * 60 * 60;

    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
};

export function useLeftPanel() {
    onMounted(() => {
        const savedIsOpenLeftPanel = localStorage.getItem('isOpenLeftPanel') as string | null;

        if (savedIsOpenLeftPanel) {
            isOpenLeftPanel.value = savedIsOpenLeftPanel == 'open' ? 1 : -1;
        }
    });

    function toggleLeftPanel() {
        isOpenLeftPanel.value *= -1;

        // Store in localStorage for client-side persistence...
        localStorage.setItem('isOpenLeftPanel', isOpenLeftPanel.value == 1 ? 'open' : 'close');

        // Store in cookie for SSR...
        setCookie('isOpenLeftPanel', isOpenLeftPanel.value == 1 ? 'open' : 'close');

    }
    return {
        isOpenLeftPanel,
        toggleLeftPanel
    }
}