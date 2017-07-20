
<div class="row il-search clearfix">
    <div class="container">
        {!! Form::open(array('route' => 'search','method' => 'GET', 'class' =>'form search-form', 'role' => 'search')) !!}
            <div class="col-md-2"></div>
            <div class="col-md-6 col-xs-12 col-sm-4">
                <div class="input-group {{ $errors->has('search') ? 'has-error' : '' }}">
                  <input name="search" type="text" class="form-control"  value = "@if(isset($inputText)){{$inputText}} @endif" placeholder="Nhập từ bạn muốn tra" maxlength="50" required="">    
                    <span class="input-group-btn">
                      <button type="submit" value="Search" class="btn btn-danger" type="button">Tra từ&nbsp;</button>
                    </span>
                </div>
                @if ($errors->has('search'))
                     <p class="alert--fail"><span class="glyphicon glyphicon-warning-sign"></span>
                        {!! $errors->first('search') !!}
                    </p>
                @endif
                
                @if(isset($status))
                    <div class="alert alert-" role="alert">
                        {{ $status}}
                    </div>
                @endif
            </div>
            <div class="col-md-3 col-xs-12 col-sm-4">
                <div class="input-group ">
                    <select class="form-control" name="lagFrom" id="sel1">
                        @foreach ($languages as $languageOut)
                            @foreach ($languages as $languageIn)
                                @if ($languageOut->name_language != $languageIn->name_language) 
                                    <option name = "{!! $languageIn->id !!}{!! $languageOut->id !!}" value = "{!! $languageIn->id !!}{!! $languageOut->id !!}">{!! $languageIn->name_language !!} - {!! $languageOut->name_language !!}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<hr>
