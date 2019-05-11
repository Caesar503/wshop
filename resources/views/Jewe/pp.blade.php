
        <select class="che" name="city" id="city">
        <option value="0">--请选择--</option>
         @foreach($res as $v)
         <option value="{{$v->id}}">{{$v->name}}</option>
         @endforeach
        </select>