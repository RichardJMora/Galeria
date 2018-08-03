@extends('layouts.app')
@section('css')
    <link href="{{ asset('/css/dropzone.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                
                <div class="panel-body">
                    @if ($message = Session::get('success'))
    
                    <div class="alert alert-success alert-block">
    
                        <button type="button" class="close" data-dismiss="alert">×</button>
    
                        <strong>{{ $message }}</strong>
    
                    </div>
    
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Mi foto de perfil</h4>
                    <a href="#" class="thumbnail">
                        <img src="{{ asset('/storage/'. Auth::user()->avatar) }}" alt="...">
                    </a>
                                        
                    <form action="{{ url('profile') }}" method="POST" role="form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Cambiar perfil</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" placeholder="avatar">
                        </div>
                    
                        
                    
                        <button type="submit" class="btn btn-primary">Cambiar</button>
                    </form>
                    <hr>
                    <h3>Mi Galeria 
                    <a href="/home" type="button" class="btn btn-default">Actualizar galeria</a>
                    </h3>
                    
                    <div class="row">
                        @foreach(Auth::user()->files as $file)
                        <div class="col-xs-6 col-md-3">
                            <a href="#" class="thumbnail">
                            <img src="{{ asset('/storage/'. $file->filename ) }}" alt="...">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                  <div class="panel-heading">
                        <h3 class="panel-title">Subir fotos a galeria</h3>
                  </div>
                  <div class="panel-body">
                        
                         <form action="{{ url('files') }}"  id="my-dropzone" class="dropzone" method="POST" role="form" enctype="multipart/form-data">  
                            {{ csrf_field() }}
                            <div class="dz-message" style="height:200px;">
                                suelta tus archivos aqui.
                            </div>
                            
                            <div class="dropzone-previews"></div>
                            <button type="submit" class="btn btn-primary" id="submit">Subir</button>
                        </form>

                        
                  </div>
            </div>

        </div>
        
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('/js/dropzone.min.js') }}"></script>
    <script>
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 10,
            
            init: function() {
                var submitBtn = document.querySelector("#submit");
                myDropzone = this;
                
                submitBtn.addEventListener("click", function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on("addedfile", function(file) {
                    alert("Archivo cargado");
                });
                
                this.on("complete", function(file) {
                    myDropzone.removeFile(file);
                });
 
                this.on("success", 
                    myDropzone.processQueue.bind(myDropzone)
                );
            }
        };
    </script>
@endsection