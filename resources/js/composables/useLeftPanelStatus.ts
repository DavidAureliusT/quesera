import { onMounted, ref } from "vue";

type LeftPanelStatus = 'open' | 'close';

const leftPanelStatus = ref<LeftPanelStatus>('open');

export function useLeftPanelStatus() {
    onMounted(() => {
        const savedLeftPanelStatus = localStorage.getItem('leftPanelStatus') as LeftPanelStatus | null;

        if (savedLeftPanelStatus) {
            leftPanelStatus.value = savedLeftPanelStatus;
        }
    });

    function updateLeftPanelStatus(value: LeftPanelStatus) {
        leftPanelStatus.value = value;

        localStorage.setItem('leftPanelStatus', value);

    }

    return{
        leftPanelStatus,
        updateLeftPanelStatus,
    };
}