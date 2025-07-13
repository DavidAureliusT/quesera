import { onMounted, ref } from "vue";

type RightPanelStatus = 'open' | 'close';

const rightPanelStatus = ref<RightPanelStatus>('open');

export function useRightPanelStatus() {
    onMounted(() => {
        const savedRightPanelStatus = localStorage.getItem('rightPanelStatus') as RightPanelStatus | null;

        if (savedRightPanelStatus) {
            rightPanelStatus.value = savedRightPanelStatus;
        }
    });

    function updateRightPanelStatus(value: RightPanelStatus) {
        rightPanelStatus.value = value;

        localStorage.setItem('rightPanelStatus', value);

    }

    return{
        rightPanelStatus,
        updateRightPanelStatus,
    };
}