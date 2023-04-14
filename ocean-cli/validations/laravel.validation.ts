import { z } from 'zod'

export const laravelSchema = z.object({
    active_versions: z.array(z
        .string()
        .regex(/^[0-9]+$/))
        .refine(
            items => new Set(items).size === items.length, {
                message: 'Must be an array of unique strings',
            },
        ),
})