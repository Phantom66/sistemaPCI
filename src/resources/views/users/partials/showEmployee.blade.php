@if($user->employee)
<section class="employee.show">
    <h2>
        {{$user->employee->formattedNames(true)}}
    </h2>

    <h2>
        @if(Auth::user()->isOwnerOrAdmin($user->id))
            @if($user->employee->nationality)
                <small>{{$user->employee->nationality->desc}}</small>
            @endif

                @if($user->employee->ci)
                    <small>C.I. {{$user->employee->ci}}</small>

                    <br/>
                @endif
        @endif

        @if($user->employee->gender)
            <small>Genero {{$user->employee->gender->desc}}</small>
        @endif
    </h2>

    <hr/>

    <h3>
        Telefonos: <br/>

        {{$phoneParser->parseNumber($user->employee->phone)}}

        <br/>

        {{$phoneParser->parseNumber($user->employee->cellphone)}}
    </h3>

    @if(Auth::user()->isOwnerOrAdmin($user->id))
        @if($user->address)
            <h2>
                Direccion
            </h2>
            <h3>
                {{$user->address->formattedDetails}}

                <br/>

                Parroquia {{$user->address->parish->desc}}
            </h3>
        @endif

            <hr/>

        @if(Auth::user()->isAdmin())
            <h4>
                Usuario creado
                {{$user->created_at->diffForHumans()}}
                <small>
                    por
                    <a href="{{route('users.show', $user->createdBy()->name)}}">
                        {{$user->createdBy()->name}}
                    </a>
                </small>
            </h4>

            <h4>
                Usuario actualizado
                {{$user->created_at->diffForHumans()}}
                <small>
                    por
                    <a href="{{route('users.show', $user->updatedBy()->name)}}">
                        {{$user->updatedBy()->name}}
                    </a>
                </small>
            </h4>
        @endif
    @endif
</section>
@endif
