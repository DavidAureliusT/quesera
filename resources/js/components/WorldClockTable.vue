<template>
    <table class="table border border-gray-400 w-full border-collapse">
        <thead>
            <tr>
                <th class="px-[1em] border border-gray-300 text-left">Country Code</th>
                <th class="px-[1em] border border-gray-300 text-left">TZ Identifier</th>
                <th class="px-[1em] border border-gray-300 text-right">Current Time</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(timeZone, index) in databaseTimeZones" :key="index">
                <td class="px-[1em] border border-gray-300">{{ timeZone['cc'] }}</td>
                <td class="px-[1em] border border-gray-300">{{ timeZone['id_tz'] }}</td>
                <WorldClockTableRow :time-zone="timeZone['id_tz']"></WorldClockTableRow>
            </tr>
        </tbody>
    </table>
</template>

<script setup lang="ts">
import WorldClockTableRow from './WorldClockTableRow.vue';

const databaseTimeZones = [
    { "cc": ["YE"], "id_tz": "Asia/Aden" },
    { "cc": ["KZ"], "id_tz": "Asia/Almaty" },
    { "cc": ["JO"], "id_tz": "Asia/Amman" },
    { "cc": ["AM", "AZ"], "id_tz": "Asia/Baku" },
    { "cc": ["KH"], "id_tz": "Asia/Phnom_Penh" },
    { "cc": ["BD"], "id_tz": "Asia/Dhaka" },
    { "cc": ["LK"], "id_tz": "Asia/Colombo" },
    { "cc": ["CN"], "id_tz": "Asia/Chongqing" },
    { "cc": ["CN"], "id_tz": "Asia/Shanghai" },
    { "cc": ["CN"], "id_tz": "Asia/Urumqi" },
    { "cc": ["KR"], "id_tz": "Asia/Seoul" },
    { "cc": ["JP"], "id_tz": "Asia/Tokyo" },
    { "cc": ["TH"], "id_tz": "Asia/Bangkok" },
    { "cc": ["ID", "MY", "SG", "PH"], "id_tz": "Asia/Kuala_Lumpur" },
    { "cc": ["AU", "ID"], "id_tz": "Asia/Jakarta" },
    { "cc": ["AU"], "id_tz": "Australia/Adelaide" },
    { "cc": ["AU"], "id_tz": "Australia/Brisbane" },
    { "cc": ["AU"], "id_tz": "Australia/Darwin" },
    { "cc": ["AU"], "id_tz": "Australia/Perth" },
    { "cc": ["AU"], "id_tz": "Australia/Sydney" },
    { "cc": ["US", "CA"], "id_tz": "America/Los_Angeles" },
    { "cc": ["US", "CA"], "id_tz": "America/Vancouver" },
    { "cc": ["US", "CA"], "id_tz": "America/Phoenix" },
    { "cc": ["US", "CA"], "id_tz": "America/Denver" },
    { "cc": ["US", "CA"], "id_tz": "America/Chicago" },
    { "cc": ["US", "CA"], "id_tz": "America/New_York" },
    { "cc": ["US", "CA"], "id_tz": "America/Toronto" },
    { "cc": ["BR"], "id_tz": "America/Sao_Paulo" },
    { "cc": ["AR", "BR", "UY"], "id_tz": "America/Argentina/Buenos_Aires" },
    { "cc": ["CL"], "id_tz": "America/Santiago" },
    { "cc": ["MX"], "id_tz": "America/Mexico_City" },
    { "cc": ["CU"], "id_tz": "America/Havana" },
    { "cc": ["PA", "CO"], "id_tz": "America/Panama" },
    { "cc": ["EC", "PE", "CO"], "id_tz": "America/Bogota" },
    { "cc": ["VE"], "id_tz": "America/Caracas" },
    { "cc": ["GB", "IE"], "id_tz": "Europe/London" },
    { "cc": ["FR"], "id_tz": "Europe/Paris" },
    { "cc": ["DE"], "id_tz": "Europe/Berlin" },
    { "cc": ["ES"], "id_tz": "Europe/Madrid" },
    { "cc": ["IT"], "id_tz": "Europe/Rome" },
    { "cc": ["RU"], "id_tz": "Europe/Moscow" },
    { "cc": ["UA"], "id_tz": "Europe/Kiev" },
    { "cc": ["PL"], "id_tz": "Europe/Warsaw" },
    { "cc": ["SE"], "id_tz": "Europe/Stockholm" },
    { "cc": ["CH"], "id_tz": "Europe/Zurich" },
    { "cc": ["NL"], "id_tz": "Europe/Amsterdam" },
    { "cc": ["BE"], "id_tz": "Europe/Brussels" },
    { "cc": ["AT"], "id_tz": "Europe/Vienna" },
    { "cc": ["PT"], "id_tz": "Europe/Lisbon" },
    { "cc": ["GR"], "id_tz": "Europe/Athens" },
    { "cc": ["FI"], "id_tz": "Europe/Helsinki" },
    { "cc": ["NO"], "id_tz": "Europe/Oslo" },
    { "cc": ["DK"], "id_tz": "Europe/Copenhagen" },
    { "cc": ["TR"], "id_tz": "Europe/Istanbul" }
];
</script>