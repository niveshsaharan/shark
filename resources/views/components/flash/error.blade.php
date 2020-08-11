@props([
    'type' => 'simple',
    'dismiss' => false,
    'class' => '',
    'title' => '',
    'messages' => [],
])
{{-- With dismiss button --}}
@if($type === 'simple')
<div class="rounded-md bg-red-50 p-4 {{$class}}">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="ml-3">
            @if($title)
                <h3 class="text-sm leading-5 font-medium text-red-800">
                    {{$title}}
                </h3>
            @endif
            <div class="@if($title) mt-2 @endif text-sm leading-5 text-red-700">
                <p>
                    {{$slot}}
                </p>
            </div>
        </div>
        @if($dismiss)
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:bg-red-100 transition ease-in-out duration-150">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif
    </div>
</div>
@endif
{{-- END With dismiss button --}}

{{-- With link on right --}}
@if($type === 'link-on-right')
<div class="rounded-md bg-red-50 p-4 {{$class}}">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="ml-3 flex-1 md:flex md:justify-between">
            <p class="text-sm leading-5 text-red-700">
                {{$slot}}
            </p>

            @isset($href)
            <p class="mt-3 text-sm leading-5 md:mt-0 md:ml-6">
                <a href="{{$href}}" class="whitespace-no-wrap font-medium text-red-700 hover:text-red-600 transition ease-in-out duration-150">
                    Details &rarr;
                </a>
            </p>
            @endisset
        </div>
    </div>
</div>
@endif

{{-- With accent border --}}
@if($type === 'accent-border')
<div class="bg-red-50 border-l-4 border-red-400 p-4 {{$class}}">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="ml-3">
            @if($title)
                <h3 class="text-sm leading-5 font-medium text-red-800">
                    {{$title}}
                </h3>
            @endif
            <div class="@if($title) mt-2 @endif text-sm leading-5 text-red-700">
                <p>
                    {{$slot}}
                </p>
            </div>
        </div>
    </div>
</div>
@endif

{{-- With description --}}
@if($type === 'description')
<div class="rounded-md bg-red-50 p-4 {{$class}}">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="ml-3">
            @if($title)
            <h3 class="text-sm leading-5 font-medium text-red-800">
                {{$title}}
            </h3>
            @endif
            <div class="@if($title) mt-2 @endif text-sm leading-5 text-red-700">
                <p>
                    {{$slot}}
                </p>
            </div>
        </div>
    </div>
</div>
@endif

{{-- with list --}}
@if($type === 'list')
<div class="rounded-md bg-red-50 p-4 {{$class}}">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="ml-3">
            @if($title)
            <h3 class="text-sm leading-5 font-medium text-red-800">
                {{$title}}
            </h3>
            @endif

            @if($messages && is_array($messages))
            <div class="@if($title) mt-2 @endif text-sm leading-5 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach($messages as $message)
                    <li class="{{$loop->first ? '' : 'mt-1'}}">
                        {{$message}}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
@endif
