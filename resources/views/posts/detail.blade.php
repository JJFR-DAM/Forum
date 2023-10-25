@extends('layouts.app')

@section('content')
    <div class="row bg-dark text-light">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-center text-mute"> {{ __('Respuestas al debate :name', ['name' => $post->title]) }} </h1>

            <h4>{{ __('Autor del debate') }}: {{ $post->owner->name }}</h4>

            <a href="../forums/{{ $post->forum->id }}" class="btn btn-info pull-right">
                {{ __('Volver al foro :name', ['name' => $post->forum->name]) }}
            </a>

            <div class="clearfix"></div>

            <br />


            @forelse($replies as $reply)
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-reply">
                        <p>{{ __('Respuesta de') }}: {{ $reply->owner->name }}</p>
                    </div>

                    <div class="panel-body">
                        {{ $reply->reply }}
                    </div>
                </div>
                @if ($reply->isAuthor())
                    <div class="panel-footer">
                        <form method="POST" action="../replies/{{ $reply->id }}">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" name="deleteReply" class="btn btn-danger">
                                {{ __('Eliminar respuesta') }}
                            </button>
                        </form>

                        <form method="GET" action="../replies/{{ $reply->id }}/edit">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="reply" class="col-md-12 control-label">{{ __('Respuesta:') }}</label>
                                <textarea id="reply" class="form-control" name="reply">{{ old('reply') }}</textarea>
                            </div>

                            <button type="submit" name="editReply"
                                class="btn btn-default">{{ __('Editar respuesta') }}</button>
                        </form>

                    </div>
                @endif


            @empty

                <div class="alert alert-danger">
                    {{ __('No hay ninguna respuesta en este momento') }}
                </div>
            @endforelse

            @if ($replies->count())
                <div class="mt-3">
                    {{ $replies->links() }}
                </div>
            @endif

            @Logged()
                <h3 class="mb-3">{{ __('Añadir una nueva respuesta al post :name', ['name' => $post->name]) }}</h3>
                @include('partials.errors')

                <form method="POST" action="../replies">
                    {{ csrf_field() }}
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />

                    <div class="form-group mb-3">
                        <label for="reply" class="col-md-12 control-label">{{ __('Respuesta:') }}</label>
                        <textarea id="reply" class="form-control" name="reply">{{ old('reply') }}</textarea>
                    </div>

                    <button type="submit" name="addReply" class="btn btn-warning mb-3">{{ __('Añadir respuesta') }}</button>
                </form>
            @else
                @include('partials.login_link', [
                    'message' => __('Inicia sesión para crear una respuesta'),
                ])
            @endLogged

        </div>
    </div>
@endsection
