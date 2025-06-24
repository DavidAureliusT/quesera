// useWorldClock.ts
import { ref, onMounted, onUnmounted, Ref } from 'vue';

export function useWorldClock(timezone: string): {
  currentTime: Ref<Date>,
  timeZoneAbbr: Ref<string>
} {
  const currentTime = ref<Date>(new Date());
  const timeZoneAbbr = ref<string>('');

  let intervalId: number | undefined;

  const updateTime = (): void => {
    // Create a new Date object for the current moment
    const now = new Date();

    // Get the time in the specified timezone by using toLocaleString
    // and then parsing it back to create a proper Date object
    const timeString = now.toLocaleString('en-CA', {
      timeZone: timezone,
      year: 'numeric',
      month: '2-digit',
      day: '2-digit',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false,
    });

    // Parse the formatted string back to a Date object
    currentTime.value = new Date(timeString);

    const formatter = new Intl.DateTimeFormat('en-US', {
      timeZone: timezone,
      timeZoneName: 'short'
    });

    const parts = formatter.formatToParts(now);
    const timeZonePart = parts.find(part => part.type === 'timeZoneName');
    timeZoneAbbr.value = timeZonePart ? timeZonePart.value : '';
  };

  onMounted(() => {
    updateTime();
    intervalId = window.setInterval(updateTime, 1000);
  });

  onUnmounted(() => {
    if (intervalId !== undefined) clearInterval(intervalId);
  });

  return {
    currentTime,
    timeZoneAbbr,
  };
}