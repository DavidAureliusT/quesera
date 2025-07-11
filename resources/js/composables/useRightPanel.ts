import { onMounted, ref } from 'vue';

const isOpenRightPanel = ref<number>(1);

const setCookie = (name: string, value: string, days = 365) => {
    if (typeof document === 'undefined') {
        return;
    }

    const maxAge = days * 24 * 60 * 60;

    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
};

export function useRightPanel() {
    onMounted(() => {
        const savedIsOpenRightPanel = localStorage.getItem('isOpenRightPanel') as string | null;

        if (savedIsOpenRightPanel) {
            isOpenRightPanel.value = savedIsOpenRightPanel == 'open' ? 1 : -1;
        }
    });

    function toggleRightPanel() {
        isOpenRightPanel.value *= -1;

        // Store in localStorage for client-side persistence...
        localStorage.setItem('isOpenRightPanel', isOpenRightPanel.value == 1 ? 'open' : 'close');

        // Store in cookie for SSR...
        setCookie('isOpenRightPanel', isOpenRightPanel.value == 1 ? 'open' : 'close');

    }
    return {
        isOpenRightPanel,
        toggleRightPanel
    }
}