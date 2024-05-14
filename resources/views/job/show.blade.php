<x-layout>

    <x-job-card :$job>
        <p class="mb-4 text-sm text-salte-500">{!! nl2br(e($job->description)) !!}</p>
    </x-job-card>
</x-layout>
