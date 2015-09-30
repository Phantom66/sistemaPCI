@extends('master')

@section('content')
    <div class="container">
        <h1>
            Almacen {{$depot->number}}

            @include(
                'partials.buttons.edit-delete',
                ['resource' => 'depots', 'id' => $depot->id]
            )
        </h1>

        <h2>
            Administrador por
            <a href="{{route('users.show', $depot->owner->name)}}">
                {{$depot->owner->name}},
            </a>
            {!! Html::mailto($depot->owner->email) !!}
        </h2>

        <h3>
            Anaquel {{$depot->rack}}, Alacena {{$depot->shelf}}
        </h3>
    </div>

    @if(isset($items))
        @include('partials.genericTable', [
            'data' => $items,
            'title' => trans('models.items.plural')
        ])
    @endif
@stop
