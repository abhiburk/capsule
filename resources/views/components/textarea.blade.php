@props(['disabled' => false, 'name' => ''])

<textarea @disabled($disabled)
    {{ $attributes->merge(['class' => 'rounded-md border resize-none border-gray-200 focus:border-gray-400 focus:ring-2 focus:ring-gray-300 focus:outline-none p-3 text-sm dark:border-gray-800 dark:bg-gray-950 dark:focus:border-gray-700 dark:focus:ring-gray-700']) }}>
{{ old($name) }}
</textarea>
