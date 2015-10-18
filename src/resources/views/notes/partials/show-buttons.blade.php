@if(auth()->user()->isAdmin())
    <span style="float: right">
        {!!

        Button::withValue('Descargar PDF')
            ->asLinkTo('#')
            ->withAttributes([
                'id'        => 'note-pdf',
                'data-url'  => route('api.notes.pdf', $note->id),
            ])->withIcon(Icon::create('file-pdf-o'))

        !!}

        @if (!is_null($note->status))
            @include(
                'partials.buttons.edit-delete',
                ['resource' => 'petitions', 'id' => $note->id]
            )
        @endif
    </span>
@endif
