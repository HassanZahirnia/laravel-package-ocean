import semver from 'semver'
import { z } from 'zod'

export const laravelSchema = z.object({
    active_versions: z.array(z
        .string()
        .refine((value) => {
            if (value)
                return semver.valid(value) !== null

            return true
        }, {
            message: 'Must be a valid semver version',
        }),
    )
        .refine(
            items => new Set(items).size === items.length, {
                message: 'Must be an array of unique strings',
            },
        ),
})