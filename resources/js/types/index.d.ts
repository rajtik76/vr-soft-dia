export interface User {
    id: number;
    name: string;
    admin: boolean;
    email: string;
    email_verified_at: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    locale: string,
    auth: {
        user: User;
    },
    alerts: {
        success: string | null
    }
};
