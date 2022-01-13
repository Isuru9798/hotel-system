@extends('layouts.app')

@section('css')

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />

<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{ route('item.add') }}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Name</label>
                    <input type="text" class="form-control" name="itm_item_name" id="itm_item_name" placeholder="Jone Doe" value="{{ old('itm_item_name') }}">
                    @error('itm_item_name')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Image</label>
                    <input type="hidden" name="itm_img" id="itm_img">
                    <input type="file" class="form-control-file image" name="image">
                    @error('itm_img')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Discription</label>
                    <textarea class="form-control" name="itm_description" id="itm_description" rows="3" placeholder="Discription" value="{{ old('itm_description') }}"></textarea>
                    @error('itm_description')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Item Code</label>
                    <input type="text" class="form-control" name="itm_item_code" id="itm_item_code" placeholder="Item Code" value="{{ old('itm_item_code') }}">
                    @error('itm_item_code')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Item Category</label>
                    <input type="text" class="form-control" name="itm_category" id="itm_category" placeholder="Item Category" value="{{ old('itm_category') }}">
                    @error('itm_category')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Price</label>
                    <input type="text" class="form-control" name="itm_item_price" id="itm_item_price" placeholder="Price" value="{{ old('itm_item_price') }}">
                    @error('itm_item_price')
                    <code>{{ $message }}</code>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>


<!-- <form action="{{ route('item.add') }}" method="post">
    @csrf
    name
    <input type="text" name="itm_item_name" id="itm_item_name">
    <br>
    image
    <input type="hidden" name="itm_img" id="itm_img">
    <input type="file" name="image" class="image">
    <br>
    description
    <textarea name="itm_description" id="itm_description" cols="30" rows="10"></textarea>
    <br>
    code
    <input type="text" name="itm_item_code" id="itm_item_code">
    <br>
    itm_category
    <input type="text" name="itm_category" id="itm_category">
    <br>
    price
    <input type="text" name="itm_item_price" id="itm_item_price">
    <br>
    <button type="submit">submit</button>
</form> -->

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover" id="emp_list">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>Item Code</th>
                    <th>Description</th>
                    <th>Item Category</th>
                    <th>Item Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>
                        <img src="{{ asset('upload/'.$item->itm_img) }}" alt="" srcset="" style="width: 40px;">
                    </td>
                    <td>{{$item->itm_item_name }}</td>
                    <td>{{$item->itm_item_code }}</td>
                    <td>{{$item->itm_description }}</td>
                    <td>{{$item->itm_category }}</td>
                    <td>{{$item->itm_item_price }}</td>
                    <td>
                        <a href="{{ route('item.delete',$item->id) }}">delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- <div class="row">
    <table>
        <tr>
            <th>itm_img</th>
            <th>itm_item_name</th>
            <th>itm_item_code</th>
            <th>itm_description</th>
            <th>itm_category</th>
            <th>itm_item_price</th>
            <th>action</th>
        </tr>
        @foreach($items as $item)
        <tr>
            <td>
                <img src="{{ asset('upload/'.$item->itm_img) }}" alt="" srcset="" style="width: 40px;">
            </td>
            <td>{{$item->itm_item_name }}</td>
            <td>{{$item->itm_item_code }}</td>
            <td>{{$item->itm_description }}</td>
            <td>{{$item->itm_category }}</td>
            <td>{{$item->itm_item_price }}</td>
            <td>
                <a href="{{ route('item.delete',$item->id) }}">delete</a>
            </td>
        </tr>
        @endforeach
    </table>
</div> -->

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

<script>
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;
    $("body").on("change", ".image", function(e) {
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });
    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });
    $("#crop").click(function() {
        let _token = $('meta[name="csrf-token"]').attr('content');
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "crop-image-upload",
                    data: {
                        '_token': _token,
                        'image': base64data
                    },
                    success: function(data) {
                        console.log(data);
                        $('#image').val("");
                        $('#itm_img').val(data.image);
                        $modal.modal('hide');
                        alert("Crop image successfully uploaded");
                    }
                });
            }
        });
    })
</script>
@endsection