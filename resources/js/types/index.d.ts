import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
    compas: {
        projectItems: ProjectItem[]
    }
};

export interface User {
    id: string;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface ProjectLink {
    id: string;
    name: string;
    key: string;
    type: string;
    href: string;
    icon: LucideIcon;
}

export interface NavItemProject {
    id: string;
    name: string;
    key: string;
    href: string;
}

export interface Project {
    name: string;
    key: string;
    icon_color: string;
    type: string;
    tasks?: Task[];
    workflows: Workflow[];
}

export interface Workflow {
    id: string;
    name: string;
    category: string;
}

export interface Task {
    id: string;
    key: string;
    summary: string;
    point: number;
    status_id: string;
    status_name: string;
    status_category: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface QueseraKeyboardEvent {
    isComposing: boolean,
    code: string,
    key: string,
    location: number,
    altKey: boolean,
    ctrlKey: boolean,
    metaKey: boolean,
    shiftKey: boolean,
    repeat: boolean
}