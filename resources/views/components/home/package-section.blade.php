<div
    class="relative px-5 pt-10 text-[#273240] dark:text-[#EAEFFB]"
>
    {{-- Emerald background --}}
    <livewire:emerald />
    
    {{-- Categories & Packages list --}}
    <div class="fade-in relative flex items-start gap-5">
        <x-packages.category-list />
        <x-packages.package-list />
    </div>
</div>
