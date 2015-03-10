@extends('layout.master')
@section('title')
   Settings
@stop
@section('content')
	 <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                  
                      <h4><i class="fa fa-angle-right"></i> Settings</h4>
                      <section id="unseen">
                      {{ Form::open(array('url' => 'savesettings', 'method' => 'post','class' => 'form-horizontal style-form', 'id' => 'collection_form', 'files'=> true)) }}
                          <div class="form-group">
                          @foreach($settings as $config )
                          @if($config->param == "logo")
                              <label class="col-sm-2 col-sm-2 control-label">
                                  {{ucfirst(str_replace("_"," ",$config->param))}}
                              </label>
                               <div class="col-sm-10">
                                  <input type="file" class="form-control" id="logo" name="logo">
                                  <input type="hidden" id="hidden_logo" name="hidden_logo">
                                  <br>
                                  <div id="dvPreview">
                                      <img src="{{ "assets/img/custom/".$logo}}" height="50px" width="50px" />
                                  </div>
                              </div>
                           @else
                               <label class="col-sm-2 col-sm-2 control-label">
                                  {{ucfirst(str_replace("_"," ",$config->param))}}
                              </label>
                               <div class="col-sm-10">
                                  <input type="text" class="form-control" id="sid" name="{{ $config->param }}" required="required" autocomplete="off"  value="{{ $config->value }}" requried>
                              </div>
                            @endif
                              <br><br>
                           @endforeach
                           <br><br>
                           <div align="center">
                            <button type="submit" id="show" class="btn btn-info">Save</button>
                           </div> 
                          </div>
                        </form>
                       </div>
                       </section>
                  </div>
          <script>
            $(document).ready(function(){
              $("#logo").on('change',function(){
                $("#hidden_logo").val($("#logo").val());
              });
            });

            //Image output

            $(function () {
            $("#logo").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#dvPreview");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:100px;width: 100px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });
          </script>
          @stop