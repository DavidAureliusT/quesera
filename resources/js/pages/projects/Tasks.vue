<script setup lang="ts">
import { Task } from '@/types';

import { Badge } from '@/components/ui/badge';

import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';

interface Props {
    tasks: Task[]
}

defineProps<Props>()


</script>

<template>
    <Table>
        <TableCaption>A list of your tasks.</TableCaption>
        <TableHeader>
            <TableRow>
                <TableHead class="w-[100px]">
                    Key
                </TableHead>
                <TableHead>Summary</TableHead>
                <TableHead class="text-right">
                    Point
                </TableHead>
                <TableHead>Status</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="task in tasks" :key="task.key">
                <TableCell class="font-medium">
                    {{ task.key }}
                </TableCell>
                <TableCell>{{ task.summary }}</TableCell>
                <TableCell class="text-right">
                    {{ task.point }}
                </TableCell>
                <TableCell>
                    <Badge v-if="task.status_category == 'To do'" variant="secondary">{{ task.status_name }}</Badge>
                    <Badge v-if="task.status_category == 'In Progress'" variant="secondary" class="bg-blue-800">{{ task.status_name }}</Badge>
                    <Badge v-if="task.status_category == 'Done'" variant="secondary" class="bg-green-800">{{ task.status_name }}</Badge>
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>