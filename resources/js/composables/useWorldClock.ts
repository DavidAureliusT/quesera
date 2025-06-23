// useWorldClock.ts
import { ref, onMounted, onUnmounted, Ref } from 'vue';

export function useWorldClock(timezone: string): { currentTime: Ref<string> } {
  const currentTime = ref<string>('');
  let intervalId: number | undefined;

  const updateTime = (): void => {
    const options: Intl.DateTimeFormatOptions = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false,
      timeZone: timezone,
    };
    currentTime.value = new Date().toLocaleTimeString('en-US', options);
  };

  onMounted(() => {
    updateTime(); // Initial update
    intervalId = window.setInterval(updateTime, 1000); // Update every second
  });

  onUnmounted(() => {
    if (intervalId !== undefined) {
      clearInterval(intervalId); // Clear interval on component unmount
    }
  });

  return {
    currentTime,
  };
}
