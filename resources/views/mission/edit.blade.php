@extends('layout')

@section('content')

    
    <form action="{{ route($mission->id ? 'mission.update' : 'mission.store', $mission->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @if ($mission->id) @method('put') @endif

        <div class="form-group">
            <label for="">Name</label><br>
            <input type="text" name="name" value="{{ old('name', $mission->name) }}">
        </div>

        <div class="form-group">
            <label for="">Year</label><br>
            <input type="text" name="year" value="{{ old('year', $mission->year) }}">
        </div>

        <div class="form-group">
            <label for="">Agent</label><br>
            {!! Form::select('agent_id', $agents, old('agent_id', $mission->agent_id), [
                'placeholder' => 'Choose an agent'
            ]) !!}
        </div>

        <div class="form-group">
            <input type="file" name="image">
        </div>

        @if ($mission->image)

            <img src="{{ asset($mission->image->path) }}" alt="">

        @endif

        <div id="image_dropzone" class="dropzone"></div>

        <script src="{{ asset('js/vendor/dropzone.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/vendor/dropzone.css') }}">
        <script>
            Dropzone.autoDiscover = false;
            let DropZone = new Dropzone('#image_dropzone', {
                url: '/mission/{{ $mission->id }}/file_upload',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
        </script>

        <div class="form-group">
            <input type="submit" value="save">
        </div>

    </form>


@endsection