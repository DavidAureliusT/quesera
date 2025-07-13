import { onMounted, ref } from "vue";

type BottomPanelStatus = 'open' | 'close';

const bottomPanelStatus = ref<BottomPanelStatus>('open');

export function useBottomPanelStatus() {
    onMounted(() => {
        const savedBottomPanelStatus = localStorage.getItem('bottomPanelStatus') as BottomPanelStatus | null;

        if (savedBottomPanelStatus) {
            bottomPanelStatus.value = savedBottomPanelStatus;
        }
    });

    function updateBottomPanelStatus(value: BottomPanelStatus) {
        bottomPanelStatus.value = value;

        localStorage.setItem('bottomPanelStatus', value);

    }

    return{
        bottomPanelStatus,
        updateBottomPanelStatus,
    };
}