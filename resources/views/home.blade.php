@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif   
                    <div id="errorDiv" class="alert alert-danger" style="display:none">This field is required!</div>
                    <textarea id="note" name="note" class="w-100 mt-1" rows="3"></textarea>           
                    <input id="createNote" name="createNote" type="button" class="btn btn-primary" value="Create Note">

                    <div>
                        <details open class="w-100 mt-3">
                            <summary>Notes</summary>
                            @foreach ($notes as $note)
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <h5 class="card-title"> {{ $note->created_at}} </h5>
                                        <h6 class="card-subtitle mb-2 text-muted"> {{ $note->user->name}} </h6>
                                        <p class="card-text">{{ $note->note }}</p>
                                    </div>
                                    <input data-note-id='{{$note->id}}' name="deleteNote" type="button" class="btn btn-primary  m-3 bg-warning text-dark border border-warning" value="Delete Note">
                                </div>
                            @endforeach
                        </details>
                    </div>
                    
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">Logs</div>
                    <div class="card-body">
                        <details class="w-100 mt-3">
                            <summary>Logs</summary>
                            @foreach ($logs as $log)
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <h5 class="card-title"> Note #{{ $log->id}} has been {{$log->action}}d </h5>
                                        <h6 class="card-subtitle mb-2 text-muted"> By {{$log->user->name}}  </h6>
                                    </div>
                                </div>
                            @endforeach
                        </details>
                        
                    </div>
                </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

    <script >        
        $(document).ready(function() {
            console.log( "ready!" );
            $("#createNote").click(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "/createNote",
                    data: {
                        note:$("#note").val()
                    },
                    success: function (response) {
                        location.reload()
                    },
                    error: function (response) {
                        $("#errorDiv").show();
                    }
                });
            });
            $("input[name='deleteNote']").click(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "/deleteNote",
                    data: {
                        note:$(this).data('note-id')
                    },
                    success: function (response) {
                        location.reload()
                    }
                });
            });
        });

    </script>

@endsection