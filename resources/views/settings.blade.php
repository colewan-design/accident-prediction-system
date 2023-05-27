<style>
    /* Toggle A */
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }

    /* Toggle B */
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-gray-200 bg-opacity-25">
                    <div class="p-6">
                        <div class="flex">
                            <div class="w-1/2">
                                Google Map API
                                <p class="text-sm text-slate-500">When disabled, users will not be able to search for location.</p>
                            </div>
                            <div class="w-1/2 flex py-2">
                                <div class="flex gap-x-4 w-full mb-12">
                                    <div class="w-fit">
                                        <label for="toggleGoogleMap" class="flex items-center cursor-pointer">
                                            <!-- toggle -->
                                            <div class="relative">
                                                <!-- input -->
                                                <input type="checkbox" id="toggleGoogleMap" class="sr-only" @if($googleMapApi) checked @endif>
                                                <!-- line -->
                                                <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                                                <!-- dot -->
                                                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                                            </div>
                                           
                                        </label>
                                    </div>
                                    <div class="1/2 py-1">
                                        <span class="text-brightRed text-sm font-semibold" id="google_map_result"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-1/2">
                                TAPS API <span class="text-xs text-brightRed italic mx-2">Feature is not yet ready</span>
                                <p class="text-sm text-slate-500">When disabled, TAPS website will not be able to get accident prediction data.</p>
                            </div>
                            <div class="w-1/2 flex py-2">
                                <div class="flex gap-x-4 w-full mb-12">
                                    <div class="w-fit">
                                       <button id="sync" class="px-5 py-2 text-sm bg-brightRed text-white hover:bg-brightRedLight rounded">Sync</button>
                                    </div>
                                    <div class="1/2 py-1">
                                        <span class="text-brightRed text-sm font-semibold" id="taps_api_result"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-1/2">
                                Update Geolocation <span class="text-xs text-brightRed italic mx-2">Manual</span>
                                <p class="text-sm text-slate-500">Update manually your database map coordinates.</p>
                            </div>
                            <div class="w-1/2 flex">
                                <div class="flex gap-x-4 w-full mb-12">
                                    <div class="w-fit">
                                        <form action="{{ route('upload.location') }}" method="post" enctype="multipart/form-data" id="uploadLocation">
                                            @csrf
                                            @method('POST')
                                            <div class="flex justify-center gap-x-4">
                                                <div class="mb-3 w-sm">
                                                <input class="form-control
                                                block
                                                w-full
                                                px-3
                                                py-1.5
                                                text-base
                                                font-normal
                                                text-gray-700
                                                bg-white bg-clip-padding
                                                border border-solid border-gray-300
                                                rounded
                                                transition
                                                ease-in-out
                                                m-0
                                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none cursor-pointer" name="file" type="file" id="formFile">
                                                <span class="text-brightRed text-sm error-text file_error"></span>
                                                
                                                </div>
                                                <button type="submit" id="upload_btn" class="bg-brightRed h-fit text-white rounded p-3 text-xs hover:bg-brightRedLight">Upload</button>
                                            
                                            </div>
                                        </form>
                                    </div>
                                    <div class="1/2" id="download">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   {{--  <form action="{{ route('taps.sync') }}" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit">SUbmit</button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $('#toggleGoogleMap').on('change',function(e){
        e.preventDefault();
        var token = Math.random().toString(36).substr(2)
        var dataId = 0;

        if ($(this).is(':checked')) {
            var dataId = 1;
        }else{
            var dataId = 0;
        }
 
        $('#session-id-edit').val(Math.random().toString(36).substr(2))

        var getUrl = "{{route('googlemap.enable')}}";

        $.ajax({
            type: "PUT",
            url: getUrl,
            data:{
                _token:$("input[name=_token]").val(),
                google_map: dataId,
            },
            success: function(data) {
                if(data.status == 0){
                   
                }else{
                    $("#google_map_result").text(data.message).delay().fadeIn();
                    $("#google_map_result").text(data.message).delay(2000).fadeOut();
                    //$('#google_map_result').text(data.message)
                }
            }
        })
    });

    $(function(){
        $("#uploadLocation").on('submit', function(e){
            e.preventDefault();
            $('#upload_btn').prop('disabled', true);
            $('#upload_btn').addClass('cursor-not-allowed');
            $.ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.status == 0){
                        $.each(data.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                            $("input[name="+prefix+"]").addClass('is-invalid');
                
                        });
                    }else{
                            $('#formFile').val('')
                            $('#download').html(data.html)
                            alert('File has been uploaded successfully!')
                    }
                }
                }).done(function(data) {
                    $('#upload_btn').prop('disabled', false);
                    $('#upload_btn').removeClass('cursor-not-allowed');
                }).fail(function(data) {
                    alert(data.statusText + ": " + data.responseText);
                });
        });

        $('#sync').on('click',function(e){
            e.preventDefault();

            $(this).prop('disabled', true);
            $(this).addClass('cursor-not-allowed');

            var getUrl = "{{route('taps.sync')}}";
            
            $.ajax({
                type: "POST",
                url: getUrl,
                data:{
                    _token:$("input[name=_token]").val(),
                },
                success: function(data) {
                    if(data.status == 0){
                        
                    }else{
                        console.log(data);
                        $("#taps_api_result").text(data.message).delay().fadeIn();
                        $("#taps_api_result").text(data.message).delay(2000).fadeOut();
                    }
                }
            }).done(function(data){
                $('#sync').prop('disabled', false);
                $('#sync').removeClass('cursor-not-allowed');
            });
        });
    });
    
</script>
