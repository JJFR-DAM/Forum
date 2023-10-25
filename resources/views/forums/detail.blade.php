@extends('layouts.app')

@section('content')
    <div class="row bg-dark text-light">
        <div class="col-md-8 col-md-offset-2 text-light">
            <h1 class="text-center">
                {{ __('Posts del foro :name', ['name' => $forum->name]) }}
            </h1>

            <a href="/" class="btn btn-info pull-right">
                {{ __('Volver al listado de los foros') }}
            </a>

            <div class="clearfix"></div>

            <br />


            @forelse($posts as $post)
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-post">
                        <a href="../posts/{{ $post->id }}"> {{ $post->title }} </a>
                        <span class="pull-right">
                            {{ __('Owner') }}: {{ $post->owner->name }}
                        </span>
                        <span class="pull-right">
                            {{ __('Replies') }}: {{ $post->replies->count() }}
                        </span>
                    </div>

                    <div class="panel-body mb-3">
                        {{ $post->description }}
                    </div>

                    @if ($post->isOwner())
                        <div class="panel-footer">
                            <form method="POST" action="../posts/{{ $post->id }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" name="deletePost" class="btn btn-danger mb-3">
                                    {{ __('Eliminar post') }}
                                </button>
                            </form>

                            <form method="GET" action="../posts/{{ $post->id }}/edit">
                                {{ csrf_field() }}

                                <input type="hidden" name="forum_id" value="{{ $forum->id }}" />

                                <div class="form-group mb-3">
                                    <label for="title" class="col-md-12 control-label">{{ __('Título') }}</label>
                                    <input id="title" class="form-control" name="title"
                                        value="{{ old('title') }}" />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description"
                                        class="col-md-12 control-label">{{ __('Descripción') }}</label>
                                    <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                                </div>

                                <button type="submit" name="editPost"
                                    class="btn btn-warning mb-3">{{ __('Editar post') }}</button>
                            </form>
                        </div>
                    @endif

                </div>
            @empty
                <div class="alert alert-danger">
                    {{ __('No hay ningún post en este momento') }}
                </div>
            @endforelse

            @if ($posts->count())
            <div class="mt-3">
                {{ $posts->links() }}
            </div>
            @endif

            @Logged()
                <h3 class="mb-3">{{ __('Añadir un nuevo post al foro :name', ['name' => $forum->name]) }}</h3>
                @include('partials.errors')

                <form method="POST" action="../posts">
                    {{ csrf_field() }}
                    <input type="hidden" name="forum_id" value="{{ $forum->id }}" />

                    <div class="form-group mb-3">
                        <label for="title" class="col-md-12 control-label">{{ __('Título') }}</label>
                        <input id="title" class="form-control" name="title" value="{{ old('title') }}" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="col-md-12 control-label">{{ __('Descripción') }}</label>
                        <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" name="addPost" class="btn btn-warning mb-3">{{ __('Añadir post') }}</button>
                </form>
            @else
                @include('partials.login_link', ['message' => __('Inicia sesión para crear un post')])
            @endLogged

        </div>
    </div>
@endsection
