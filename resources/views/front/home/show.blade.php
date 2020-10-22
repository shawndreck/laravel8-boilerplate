<x-front.app
title=""
description=""
keywords=""
>
    {{ Route::currentRouteName() }}
    <div>
        {{ url()->current() }}
    </div>
</x-front.app>