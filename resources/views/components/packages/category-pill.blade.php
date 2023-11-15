@props([
    'category',
])

<div
    wire:click.prevent="selectCategory('{{ $category->name }}')"
    @class([
        'rounded-full px-3.5 py-1 text-xs font-semibold transition duration-300 hover:opacity-80',
        'bg-fuchsia-100 text-fuchsia-500 dark:bg-fuchsia-400/20' => $category->name === 'File Management',
        'bg-cyan-100 text-cyan-500 dark:bg-cyan-400/20' => $category->name === 'Auth & Permissions',
        'bg-rose-100 text-rose-500 dark:bg-rose-400/20' => $category->name === 'Database & Eloquent',
        'bg-blue-100/70 text-blue-500 dark:bg-blue-500/20' => $category->name === 'Debugging & Dev Tools',
        'bg-purple-100 text-purple-500 dark:bg-purple-500/20' => $category->name === 'Dev Ops',
        'bg-lime-100 text-lime-500 dark:bg-lime-400/20' => $category->name === 'Localization',
        'bg-orange-200/70 text-orange-500 dark:bg-orange-500/20 dark:text-orange-400' => $category->name === 'API',
        'bg-teal-100 text-teal-500 dark:bg-teal-500/20' => $category->name === 'SEO',
        'bg-amber-100 text-amber-600 dark:bg-yellow-400/20' => $category->name === 'Testing',
        'bg-pink-100 text-pink-500 dark:bg-pink-500/20' => $category->name === 'Payment',
        'bg-indigo-100 text-indigo-500 dark:bg-indigo-500/20' => $category->name === 'Security',
        'bg-green-100 text-green-500 dark:bg-[#4EAC5C]/20' => $category->name === 'Mail',
        'bg-emerald-100 text-emerald-500 dark:bg-emerald-500/20' => $category->name === 'E-Commerce',
        'bg-red-100 text-red-500 dark:bg-red-500/20' => $category->name === 'CMS & Admin Panels',
        'bg-sky-100 text-sky-500 dark:bg-sky-500/20' => $category->name === 'Code Architecture',
        'bg-[#CBEAFE] text-[#3182CE] dark:bg-[#55a4ff]/20' => $category->name === 'Notifications',
        'bg-violet-100 text-violet-500 dark:bg-violet-500/20' => $category->name === 'UI & Blade Components',
        'bg-zinc-200/50 text-zinc-500 dark:bg-zinc-500/20 dark:text-zinc-400' => $category->name === 'Utilities & Helpers',
    ])
>
    {{ $category->name }}
</div>
